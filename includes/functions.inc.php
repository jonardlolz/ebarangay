<?php

function emptyInputSignup($userName, $userEmail, $pwd, $pwdRpt){
    $result; //variable to store the result
    //checks if any of the inputs are empty, empty() is built unto PHP
    if(empty($userName) || empty($userEmail) || empty($pwd) || empty($pwdRpt)){
        $result = true; //return true if input is empty
    }
    else{
        $result = false; //false if not
    }
    return $result; //sent back to signup.inc.php
}

function emptyBrgy($userBrgy){
    $result;

    if(empty($userBrgy)){
        $result = true; //return true if input is empty
    }
    else{
        $result = false; //false if not
    }
    return $result; //sent back to signup.inc.php
}

function emptyPurok($userPurok){
    $result;

    if(empty($userPurok)){
        $result = true; //return true if input is empty
    }
    else{
        $result = false; //false if not
    }
    return $result; //sent back to signup.inc.php
}

function emptyInputLogin($username, $password){
    $result; //variable to store the result
    //checks if any of the inputs are empty, empty() is built unto PHP
    if(empty($username) || empty($password)){
        $result = true; //return true if input is empty
    }
    else{
        $result = false; //false if not
    }
    return $result; //sent back to signup.inc.php
}

function invalidUser($userName){
    $result;

    //checks if userName input is ALPHANUMERICAL
    //preg_match() is a search parameter, if it does not match up, then it will throw an error
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($userEmail){
    $result;
    //checks if the email inputted is a valid email
    //FILTER_VALIDATE_EMAIL is built-in
    if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
} 

function pwdMatch($pwd, $pwdRpt){
    $result;
    //checks if passwords match
    if($pwd !== $pwdRpt){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function userExists($conn, $userName, $userEmail){
    $sql = "SELECT * FROM users WHERE username = ? OR emailAdd = ?;"; //sql statement, searches if username or useremail exists in db
    $stmt = mysqli_stmt_init($conn); //initialize connection to database
    if(!mysqli_stmt_prepare($stmt, $sql)){ //checks if connection and statement are valid
        header("location: ../signup.php?error=stmtfaileduserexists"); //returns an error msg if not
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $userEmail); //binds the values into sql statement
    mysqli_stmt_execute($stmt); //executes the query to acquire the data from db

    $resultData = mysqli_stmt_get_result($stmt); //gets the result and saves it into $resultData

    if($row = mysqli_fetch_assoc($resultData)){
        return $row; //if the user exists, return the data
    }
    else{
        $result = false;
        return $result; //if the user does not exist, return false
    }

    mysqli_stmt_close($stmt); //closes the connection
}

// function natIDexists($conn, $natID){
//     $sql = "SELECT * FROM users WHERE NationalID = ?;"; //sql statement, searches if username or useremail exists in db
//     $stmt = mysqli_stmt_init($conn); //initialize connection to database
//     if(!mysqli_stmt_prepare($stmt, $sql)){ //checks if connection and statement are valid
//         header("location: ../account.php?error=stmtfaileduserexists"); //returns an error msg if not
//         exit();
//     }

//     mysqli_stmt_bind_param($stmt, "s", $natID); //binds the values into sql statement
//     mysqli_stmt_execute($stmt); //executes the query to acquire the data from db

//     $resultData = mysqli_stmt_get_result($stmt); //gets the result and saves it into $resultData

//     if($row = mysqli_fetch_assoc($resultData)){
//         return $row; //if the user exists, return the data
//     }
//     else{
//         $result = false;
//         return $result; //if the user does not exist, return false
//     }

//     mysqli_stmt_close($stmt); //closes the connection
// }

function editUser($conn, $Firstname, $Middlename, $Lastname, $UserAge, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok){
    $sql = "INSERT INTO users(Firstname, Middlename, Lastname, UserAge, dateofbirth, civilStat, 
    emailAdd, username, usersPwd, userGender, userType, profile_pic, userBarangay, userPurok) 
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"; //sql statement, insert data into users table
    $profile_pic = "profile_picture.jpg";
    $userType = "Resident";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailedcreateuser");
        exit();
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT); //hashes password to deter hackers

    mysqli_stmt_bind_param($stmt, "sssssssssssssss", $Firstname, $Middlename, $Lastname, $UserAge, $dateofbirth, $civilStat, $userEmail, $userName, $hashedpwd, $gender, $userType, $profile_pic, $userBrgy, $userPurok); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none"); //no errors were made
    exit();
}

function createUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok, $userAddress, $userHouseNum){
    $sql = "INSERT INTO users(Firstname, Middlename, Lastname, dateofbirth, civilStat, 
    emailAdd, username, usersPwd, userGender, userType, profile_pic, userBarangay, userPurok, userCity, userAddress, userHouseNum) 
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"; //sql statement, insert data into users table
    $profile_pic = "profile_picture.jpg";
    $userType = "Resident";
    $userCity = "Mandaue";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailedcreateuser");
        exit();
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT); //hashes password to deter hackers

    mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $hashedpwd, $gender, $userType, $profile_pic, $userBrgy, $userPurok, $userCity, $userAddress, $userHouseNum); 
    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none"); //no errors were made
    exit();
}

function createRenterUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok, $landlordName, $landlordContact, $userAddress, $userHouseNum){
    $sql = "INSERT INTO users(Firstname, Middlename, Lastname, dateofbirth, civilStat, 
    emailAdd, username, usersPwd, userGender, userType, profile_pic, userBarangay, userPurok, userCity, isRenting, landlordName, landlordContact, userAddress, userHouseNum) 
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"; //sql statement, insert data into users table
    $profile_pic = "profile_picture.jpg";
    $userType = "Resident";
    $userCity = "Mandaue";
    $true = "True";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailedcreateuser");
        exit();
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT); //hashes password to deter hackers

    mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $hashedpwd, $gender, $userType, $profile_pic, $userBrgy, $userPurok, $userCity, $true, $landlordName, $landlordContact, $userAddress, $userHouseNum); 
    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none"); //no errors were made
    exit();
}

function loginUser($conn, $username, $password){ //logs in the user
    $userExists = userExists($conn, $username, $username); //calls the function userExists and saved into $userExists

    if($userExists === false){
        header("location: ../login.php?error=wronglogin"); //redirects page to login.php?error=wronglogin
        exit();
    }

    $pwdHashed = $userExists["usersPwd"]; //saves the 'usersPwd' data to $pwdHashed
    $checkPwd = password_verify($password, $pwdHashed); //verifies if $password and $pwdHashed is a match; returns true if it is
    if($checkPwd === false){
        header("location: ../login.php?error=wrongpassword"); //if wrong password, redirect user to login.php
        exit();
    }
    else if($checkPwd === true){
        session_start(); //creates a session
        $_SESSION["UsersID"] = $userExists["UsersID"]; //saves data on session for later use
        $_SESSION["profile_pic"] = $userExists["profile_pic"];
        $_SESSION["username"] = $userExists["username"]; 
        $_SESSION["userType"] = $userExists["userType"]; 
        $_SESSION["Firstname"] = $userExists["Firstname"];
        $_SESSION["Middlename"] = $userExists["Middlename"];
        $_SESSION["Lastname"] = $userExists["Lastname"];
        $_SESSION["dateofbirth"] = $userExists["dateofbirth"];
        $_SESSION["civilStat"] = $userExists["civilStat"];
        $_SESSION["userGender"] = $userExists["userGender"];
        $_SESSION["userBarangay"] = $userExists["userBarangay"];
        $_SESSION["userPurok"] = $userExists["userPurok"];
        $_SESSION["emailAdd"] = $userExists["emailAdd"];
        $_SESSION["teleNum"] = $userExists["teleNum"];
        $_SESSION["phoneNum"] = $userExists["phoneNum"];
        $_SESSION["userCity"] = $userExists["userCity"];
        $_SESSION["barangayPos"] = $userExists["barangayPos"];
        $_SESSION['userAddress'] = $userExists['userAddress'];
        $_SESSION['userHouseNum'] = $userExists['userHouseNum'];
        if($_SESSION["userType"] == "Admin"){
            header("location: ../account.php"); //redirects to main page after successful login
            exit();
        }
        else{
            header("location: ../index.php"); //redirects to main page after successful login
            exit();
        }
        
    }
}

function emptyInputPost($userName, $postContent, $userType, $usersID){
    $result; //variable to store the result
    //checks if any of the inputs are empty, empty() is built unto PHP
    if(empty($userName) || empty($postContent) || empty($userType) || empty($usersID)){
        $result = true; //return true if input is empty
    }
    else{
        $result = false; //false if not
    }
    return $result; //sent back to post.inc.php
}

function postContent($conn, $username, $postContent, $userType, $usersID){
    $sql = "INSERT INTO post(UsersID, username, userType, postMessage) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailedcreatepost");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $usersID, $username, $userType, $postContent); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none"); //no errors were made
    exit();
}

function editContent($conn, $id, $postContent){
    $sql = "UPDATE post SET postMessage=? WHERE PostID=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailedcreatepost");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $postContent, $id); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none"); //no errors were made
    exit();
}