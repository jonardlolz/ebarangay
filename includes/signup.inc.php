<!-- handles the script for signups  -->
<?php
include 'dbh.inc.php';
extract($_POST);
    
if(isset($_GET['register'])){
    $hashedpwd = password_hash($userPwd, PASSWORD_DEFAULT); //hashes password to deter hackers

    mysqli_begin_transaction($conn);

    $secretQuestion = addslashes($secretQuestion);

    $a1 = mysqli_query($conn, "INSERT INTO users(Firstname, Middlename, Lastname, userSuffix, dateofbirth, civilStat, userGender, IsVoter, profile_pic, userBarangay, userPurok, userHouseNum, isRenting, startedLiving, username, usersPwd, emailAdd, userType, secretQuestion, secretAnswer) VALUES('$userFirstname', '$userMiddlename', '$userLastname', '$userSuffix', '$userDOB', '$userCivilStat', '$userGender', '$isvoter', 'profile_picture.jpg', '$userBarangay', '$userPurok', '$userHouseNum', '$islessee', '$userDateReside', '$userName', '$hashedpwd', '$userEmail', 'Resident', '$secretQuestion', '$secretAnswer');");

    if($a1){
        $id = mysqli_insert_id($conn);
        if(isset($_FILES['userPicture']) && $_FILES['userPicture']['tmp_name'] != ''){
            mkdir('../img/users/'.$id);
            mkdir('../img/users/'.$id.'/profile_pic');
            mkdir('../img/users/'.$id.'/verification');
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['userPicture']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['userPicture']['tmp_name'],'../img/users/'.$id.'/profile_pic/'. $fnamep); //uploads file to the directory
            $a2 = mysqli_query($conn, "UPDATE users SET profile_pic='$fnamep' WHERE UsersID=$id");
        }
        if(isset($_FILES['uservalidid']) && $_FILES['uservalidid']['tmp_name'] != ''){
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['uservalidid']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['uservalidid']['tmp_name'],'../img/users/'.$id.'/verification/'. $fnamep); //uploads file to the directory
        }
        if(isset($_FILES['userlessornote']) && $_FILES['userlessornote']['tmp_name'] != ''){
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['userlessornote']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['userlessornote']['tmp_name'],'../img/users/'.$id.'/verification/'. $fnamep); //uploads file to the directory
        }
        if(isset($_FILES['uservoterid']) && $_FILES['uservoterid']['tmp_name'] != ''){
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['uservoterid']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['uservoterid']['tmp_name'],'../img/users/'.$id.'/verification/'. $fnamep); //uploads file to the directory
        }
        if($a2){
            mysqli_commit($conn);
            header("location: ../login.php?error=none"); 
            exit();
        }
        
    }
    else{
        echo("Error description: " . mysqli_error($conn));
        mysqli_rollback($conn);
        exit();
        // header("location: ../login.php?error=error"); 
        // exit();
    }
}
elseif(isset($_GET['update'])){

    mysqli_begin_transaction($conn);

    $a1 = mysqli_query($conn, "UPDATE users SET Firstname='$userFirstname', Middlename='$userMiddlename', Lastname='$userLastname', userSuffix='$userSuffix', dateofbirth='$userDOB', civilStat='$userCivilStat', userGender='$userGender', IsVoter='$isvoter', userBarangay='$userBarangay', userPurok='$userPurok', userHouseNum='$userHouseNum', isRenting='$islessee', startedLiving='$userDateReside', VerifyStatus='Reverify', updated_on=CURRENT_TIMESTAMP WHERE UsersID={$_GET['UsersID']}");

    if($a1){
        $id = $_GET['UsersID'];
        if(isset($_FILES['userPicture']) && $_FILES['userPicture']['tmp_name'] != ''){
            if(file_exists('../img/users/'.$id)){
                rmdir('../img/users/'.$id);
            }
            mkdir('../img/users/'.$id);
            mkdir('../img/users/'.$id.'/profile_pic');
            mkdir('../img/users/'.$id.'/verification');
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['userPicture']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['userPicture']['tmp_name'],'../img/users/'.$id.'/profile_pic/'. $fnamep); //uploads file to the directory
            $a2 = mysqli_query($conn, "UPDATE users SET profile_pic='$fnamep' WHERE UsersID=$id");
        }
        if(isset($_FILES['uservalidid']) && $_FILES['uservalidid']['tmp_name'] != ''){
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['uservalidid']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['uservalidid']['tmp_name'],'../img/users/'.$id.'/verification/'. $fnamep); //uploads file to the directory
        }
        if(isset($_FILES['userlessornote']) && $_FILES['userlessornote']['tmp_name'] != ''){
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['userlessornote']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['userlessornote']['tmp_name'],'../img/users/'.$id.'/verification/'. $fnamep); //uploads file to the directory
        }
        if(isset($_FILES['uservoterid']) && $_FILES['uservoterid']['tmp_name'] != ''){
            $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['uservoterid']['name']; //creates a unique filename to avoid duplications/conflicts with filename
            $move = move_uploaded_file($_FILES['uservoterid']['tmp_name'],'../img/users/'.$id.'/verification/'. $fnamep); //uploads file to the directory
        }
        if($a2){
            mysqli_commit($conn);
            header("location: ../login.php?error=reverified"); 
            exit();
        }
    }
    else{
        echo("Error description: " . mysqli_error($conn));
        mysqli_rollback($conn);
        exit();
        // header("location: ../login.php?error=error"); 
        // exit();
    }
}
// //inputs from signup.php
// $Firstname = $_POST["userFirstname"];
// $Middlename = $_POST["userMiddlename"];
// $Lastname = $_POST["userLastname"];
// $dateofbirth = $_POST["userDOB"];
// $civilStat = $_POST["userCivilStat"];
// $gender = $_POST["userGender"];
// $userName = $_POST["userName"];
// $userEmail = $_POST["userEmail"];
// $pwd = $_POST["userPwd"];
// $pwdRpt = $_POST["userRptPwd"];
// $userPurok = $_POST["userPurok"];
// $userBrgy = $_POST["userBarangay"];
// $userAddress = $_POST["userAddress"];
// $userHouseNum = $_POST["userHouseNum"]; 
// $landlordName = $_POST["landlordName"];
// $landlordContact = $_POST["landlordContact"];
// $secretQuestion = $_POST["secretQuestion"];
// $secretAnswer = $_POST["secretAnswer"];


// //linking php files for reference
// require_once 'dbh.inc.php';
// require_once 'functions.inc.php';

// //error handling
// if(emptyInputSignup($userName, $userEmail, $pwd, $pwdRpt) !== false){ //check if all inputs aren't empty
//     header("location: ../signup.php?error=emptyinput"); //return to signup.php with an error msg
//     exit();    //stop the script
// }

// if(invalidUser($userName) !== false){ //checks if username is valid
//     header("location: ../signup.php?error=invalidUser"); //return to signup.php with an error msg
//     exit();    //stop the script
// }

// if(invalidEmail($userEmail) !== false){ //checks if email is valid
//     header("location: ../signup.php?error=invalidEmail"); //return to signup.php with an error msg
//     exit();    //stop the script
// }

// if(pwdMatch($pwd, $pwdRpt) !== false){ //checks if pwd and pwdRpt is the same
//     header("location: ../signup.php?error=invpwd"); //return to signup.php with an error msg
//     exit();    //stop the script
// }

// if(userExists($conn, $userName, $userEmail) !== false){ //checks if user already exists in db
//     header("location: ../signup.php?error=userExists"); //return to signup.php with an error msg
//     exit();    //stop the script
// }
// // if(natIDexists($conn, $natID) !== false){ //checks if user already exists in db
// //     header("location: ../signup.php?error=natIDexists"); //return to signup.php with an error msg
// //     exit();    //stop the script
// // }


// if(emptyBrgy($userBrgy) !== false){ //checks if user already exists in db
//     header("location: ../signup.php?error=invbrgy"); //return to signup.php with an error msg
//     exit();    //stop the script
// }

// if(emptyPurok($userPurok) !== false){ //checks if user already exists in db
//     header("location: ../signup.php?error=invPurok"); //return to signup.php with an error msg
//     exit();    //stop the script
// }

// if(isset($_POST['isRenting'])){
//     createRenterUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok, $landlordName, $landlordContact, $userAddress, $userHouseNum);
// }
// else{
//     createUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok, $userAddress, $userHouseNum, $secretQuestion, $secretAnswer);
// }


//createUser($conn, $Firstname, $Middlename, $Lastname, $dateofbirth, $civilStat, $userEmail, $userName, $pwd, $gender, $userBrgy, $userPurok); //create user if no more errors



