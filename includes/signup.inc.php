<!-- handles the script for signups  -->
<?php

if(isset($_POST["submit"])){

    //inputs from signup.php
    $Firstname = $_POST["userFirstname"];
    $Middlename = $_POST["userMiddlename"];
    $Lastname = $_POST["userLastname"];
    $dateofbirth = $_POST["userDOB"];
    $civilStat = $_POST["userCivilStat"];
    $gender = $_POST["userGender"];
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $pwd = $_POST["userPwd"];
    $pwdRpt = $_POST["userRptPwd"];
    $userPurok = $_POST["userPurok"];
    $userBrgy = $_POST["userBarangay"];
    $landlordName = $_POST["landlordName"];
    $landlordContact = $_POST["landlordContact"];


    //linking php files for reference
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handling
    if(emptyInputSignup($userName, $userEmail, $pwd, $pwdRpt) !== false){ //check if all inputs aren't empty
        header("location: ../signup.php?error=emptyinput"); //return to signup.php with an error msg
        exit();    //stop the script
    }

    if(invalidUser($userName) !== false){ //checks if username is valid
        header("location: ../signup.php?error=invalidUser"); //return to signup.php with an error msg
        exit();    //stop the script
    }

    if(invalidEmail($userEmail) !== false){ //checks if email is valid
        header("location: ../signup.php?error=invalidEmail"); //return to signup.php with an error msg
        exit();    //stop the script
    }

    if(pwdMatch($pwd, $pwdRpt) !== false){ //checks if pwd and pwdRpt is the same
        header("location: ../signup.php?error=invpwd"); //return to signup.php with an error msg
        exit();    //stop the script
    }

    if(userExists($conn, $userName, $userEmail) !== false){ //checks if user already exists in db
        header("location: ../signup.php?error=userExists"); //return to signup.php with an error msg
        exit();    //stop the script
    }
    // if(natIDexists($conn, $natID) !== false){ //checks if user already exists in db
    //     header("location: ../signup.php?error=natIDexists"); //return to signup.php with an error msg
    //     exit();    //stop the script
    // }


    if(emptyBrgy($userBrgy) !== false){ //checks if user already exists in db
        header("location: ../signup.php?error=invbrgy"); //return to signup.php with an error msg
        exit();    //stop the script
    }

    if(emptyPurok($userPurok) !== false){ //checks if user already exists in db
        header("location: ../signup.php?error=invPurok"); //return to signup.php with an error msg
        exit();    //stop the script
    }

    if(isset($_POST['isRenting'])){
        createRenterUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok, $landlordName, $landlordContact);
    }
    else{
        createUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok);
    }


    //createUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok); //create user if no more errors

}
else{
    header("location: ../signup.php");//return to signup.php if error
    exit();     //stop the script
}
