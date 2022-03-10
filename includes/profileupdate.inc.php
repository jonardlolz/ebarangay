<?php
    session_start();
    include 'dbh.inc.php';
    extract($_POST);
    if(isset($_POST["submit"]))
    {
        $id=$_GET["id"];
        $sql = "UPDATE users SET Firstname=?, Middlename=?, Lastname=?, userGender=?, 
        dateofbirth=?, userPurok=?, userBarangay=?, userCity=?, 
        phoneNum=?, teleNum=?, emailAdd=?, userAddress=?, userHouseNum=? WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../profile.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $Firstname, $Middlename, $Lastname, $userGender,
        $userDOB, $userPurok, $userBrgy, $userCity, $phoneNum, $teleNum, $emailAdd, $userAddress, $userHouseNum, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        $_SESSION["Firstname"] = $Firstname;
        $_SESSION["Middlename"] = $Middlename;
        $_SESSION["Lastname"] = $Lastname;
        $_SESSION["userGender"] = $userGender;
        $_SESSION["dateofbirth"] = $userDOB;
        $_SESSION["currentAdd"] = $currentAdd;
        $_SESSION["userPurok"] = $userPurok;
        $_SESSION["userBarangay"] = $userBrgy;
        $_SESSION["userCity"] = $userCity;
        $_SESSION["phoneNum"] = $phoneNum;
        $_SESSION["teleNum"] = $teleNum;
        $_SESSION["emailAdd"] = $emailAdd;
        $_SESSION['userAddress'] = $userAddress;
        $_SESSION['userHouseNum'] = $userHouseNum;




        header("location: ../profile.php?error=none");
        exit();
    }


?>