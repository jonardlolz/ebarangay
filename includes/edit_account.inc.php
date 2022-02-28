<?php
    session_start();
    extract($_POST);
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "UPDATE users SET Firstname=?, Middlename=?, Lastname=?, 
        dateofbirth=?, civilStat=?, userPurok=?, userBarangay=?,
        emailAdd=?, phoneNum=?, userType=? WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssssssss", $Firstname, $Middlename, $Lastname, $userDOB, $userCivilStat, $userPurok, $userBrgy, $emailAdd, $phoneNum, $userType, $id); 
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