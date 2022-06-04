<?php
    session_start();
    $id = NULL;
    $brgy = NULL;
    extract($_POST);
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "UPDATE users SET Firstname=?, Middlename=?, Lastname=?, 
        dateofbirth=?, civilStat=?, userPurok=?, userBarangay=?,
        emailAdd=?, phoneNum=?, userAddress=?, userHouseNum=?, userSuffix=? WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssssssssss", $Firstname, $Middlename, $Lastname, $userDOB, $userCivilStat, $userPurok, $userBrgy, $emailAdd, $phoneNum, $userAddress, $userHouseNum, $suffixName, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if($_SESSION['userType'] == "Admin"){
            header("location: ../account.php?error=none");
            exit();
        }
        else{
            header("location: ../profile_alt.php?UsersID=$id");
            exit();
        }
    }
    elseif(isset($_GET['addAccount'])){
        if(userExists($conn, $username, $emailAdd) !== false){ //checks if user already exists in db
            if($_SESSION['userType'] == 'Admin'){
                header("location: ../account.php?error=userExists"); //return to signup.php with an error msg
                exit();    //stop the script
            }
            else{
                header("location: ../residents.php?error=userExists"); //return to signup.php with an error msg
                exit();    //stop the script
            }
        }

        $hashedpwd = password_hash($userPwd, PASSWORD_DEFAULT);

        mysqli_begin_transaction($conn);

        if($_SESSION['userType'] != 'Admin'){
            if($_SESSION['userType'] == 'Captain'){
                $barangay = $_SESSION['userBarangay'];
            }
            elseif($_SESSION['userType'] == 'Purok Leader'){
                $barangay = $_SESSION['userBarangay'];
                $userPurok = $_SESSION['userPurok'];
            }
        }
        
        $a1 = mysqli_query($conn, "INSERT INTO users(Firstname, Middlename, Lastname, dateofbirth, 
        civilStat, userGender, userBarangay, userPurok, userHouseNum, emailAdd, username, usersPwd, 
        profile_pic, userType) VALUES('$Firstname', '$Middlename', '$Lastname', '$userDOB', '$userCivilStat', '$userGender', '$barangay', '$userPurok', '$userHouseNum', '$emailAdd', '$username', '$hashedpwd', 'profile_picture.jpg', 'Resident')");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Account', 'Captain $name has added a new Resident', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../residents.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }  
    }
    elseif(isset($_GET['changeSecret'])){
        $sql = "UPDATE users SET secretQuestion=?, secretAnswer=? WHERE UsersID=?"; //sql statement, insert data into users table

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../profile_alt.php?error&UsersID=".$_GET['changeSecret']);
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $secretQuestion, $secretAnswer, $_GET['changeSecret']); 
        if(!mysqli_stmt_execute($stmt)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        mysqli_stmt_close($stmt);

        header("location: ../profile_alt.php?noerror&UsersID=".$_GET['changeSecret']);
        exit();
    }
    elseif(isset($_GET['addCapt'])){
        if(userExists($conn, $username, $emailAdd) !== false){ //checks if user already exists in db
            header("location: ../account.php?error=userExists"); //return to signup.php with an error msg
            exit();    //stop the script
        }

        $hashedpwd = password_hash($userPwd, PASSWORD_DEFAULT);

        mysqli_begin_transaction($conn);
        $a1 = mysqli_query($conn, "UPDATE users SET userType='Resident' WHERE UsersID=$existingCapt");
        $a2 = mysqli_query($conn, "INSERT INTO users(Firstname, Middlename, Lastname, dateofbirth, 
        civilStat, userGender, userBarangay, userPurok, userAddress, userHouseNum, emailAdd, username, usersPwd, 
        profile_pic, userType) VALUES('$Firstname', '$Middlename', '$Lastname', '$userDOB', '$userCivilStat', '$userGender', '$barangay', '$userPurok', '$userAddress', '$userHouseNum', '$emailAdd', '$username', '$hashedpwd', 'profile_picture.jpg', 'Captain')");

        if($a1 && $a2){
            if(mysqli_commit($conn)){
                $getCaptSql = $conn->query("SELECT * FROM users WHERE userType='Captain' ORDER BY UsersID DESC LIMIT 1;");
                $getCapt = $getCaptSql->fetch_assoc();
                $a3 = mysqli_query($conn, "UPDATE barangay SET brgyCaptain='{$getCapt['UsersID']}' WHERE BarangayName='{$getCapt['userBarangay']}'");

                mysqli_commit($conn);
                header("location: ../account.php?error=none");
                exit();
            }
            else{
                echo("Error description: ".mysqli_error($conn));
                mysqli_rollback($conn);
            }
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }  
    }
    elseif(isset($_GET["removeCaptain"])){
        mysqli_begin_transaction($conn);
        $a1 = mysqli_query($conn, "UPDATE users SET userType='Resident' WHERE UsersID=$id");
        $a2 = mysqli_query($conn, "UPDATE barangay SET brgyCaptain=NULL WHERE brgyCaptain=$id");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../captain.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }  
    }

    elseif(isset($_GET["removeLeader"])){
        extract($_POST);
        mysqli_begin_transaction($conn);
        $a1 = mysqli_query($conn, "UPDATE users SET userType='Resident' WHERE UsersID=$id");
        $a2 = mysqli_query($conn, "UPDATE purok SET purokLeader=NULL WHERE purokLeader=$id");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../residents.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }
            
    }

    elseif(isset($_GET["changePassPost"])){ 
        $id = $_GET["changePassPost"];
        if(pwdMatch($userPwd, $userRptPwd) !== false){ //checks if pwd and pwdRpt is the same
            header("location: ../profile_alt.php?UsersID=$id&error=invpwd"); //return to signup.php with an error msg
            exit();    //stop the script
        }
        $sql = "UPDATE users SET usersPwd=? WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        $hashedpwd = password_hash($userPwd, PASSWORD_DEFAULT); //hashes password to deter hackers

        mysqli_stmt_bind_param($stmt, "ss", $hashedpwd, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if($_SESSION['userType'] == "Admin"){
            header("location: ../account.php?error=none");
            exit();
        }
        else{
            header("location: ../profile_alt.php?UsersID=$id");
            exit();
        }
    }

    elseif(isset($_GET["changePosition"])){
        $id = $_GET["changePosition"];
        extract($_POST);
        mysqli_begin_transaction($conn);
        $a1 = mysqli_query($conn, "UPDATE users SET userType='$position' WHERE UsersID=$id");

        if($a1){
            mysqli_commit($conn);
            header("location: ../residents.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }
            
    }

    else{   
        if(userExists($conn, $username, $emailAdd) !== false){ //checks if user already exists in db
            header("location: ../account.php?error=userExists"); //return to signup.php with an error msg
            exit();    //stop the script
        }

        $default = "profile_picture.jpg";
        $sql = "INSERT INTO users(NationalID, Firstname, Middlename, Lastname, dateofbirth, 
        civilStat, userGender, userBarangay, userPurok, emailAdd, username, usersPwd, 
        profile_pic, userType) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }
        
        $hashedpwd = password_hash($userPw, PASSWORD_DEFAULT); //hashes password to deter hackers

        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $natID, $Firstname, $Middlename, $Lastname, 
        $userDOB, $userCivilStat, $userGender, $userBrgy, $userPurok, $emailAdd, $username, $hashedpwd, $default, $userType); 
        if(!mysqli_stmt_execute($stmt)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../account.php?error=none");
        exit();
    }
?>