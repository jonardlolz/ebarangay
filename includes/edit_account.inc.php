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
        emailAdd=?, phoneNum=?, userType=?, userAddress=?, userHouseNum=?, usersPwd=? WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        $hashedpwd = password_hash($userPwd, PASSWORD_DEFAULT); //hashes password to deter hackers

        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $Firstname, $Middlename, $Lastname, $userDOB, $userCivilStat, $userPurok, $userBrgy, $emailAdd, $phoneNum, $userType, $userAddress, $userHouseNum, $hashedpwd, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if($_SESSION['userType'] == "Admin"){
            header("location: ../account.php?error=none");
            exit();
        }
        else{
            header("location: ../residents.php?error=none");
            exit();
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

        if(natIDexists($conn, $natID) !== false){ //checks if user already exists in db
            header("location: ../account.php?error=natIDexists"); //return to signup.php with an error msg
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