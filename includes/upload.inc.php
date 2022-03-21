<?php

//handles the uploading of profile pictures of users

include 'dbh.inc.php';
session_start();

if(isset($_FILES['pp']) && $_FILES['pp']['tmp_name'] != ''){//checks if their are files submitted from the form
    $fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['pp']['name']; //creates a unique filename to avoid duplications/conflicts with filename
    $move = move_uploaded_file($_FILES['pp']['tmp_name'],'../img/'. $fnamep); //uploads file to the directory
    $data = "profile_pic = '$fnamep' "; //saves filename to $data
    $usersID = $_SESSION['UsersID']; //$_SESSION value for UsersID (prmry key) held to $usersID
}

if(isset($data)){//checks if the previous if statement was successful
    $sql = "UPDATE users set $data where UsersID = $usersID";           //sql statement 
    $stmt = mysqli_stmt_init($conn);                                    //connects to database
    if(!mysqli_stmt_prepare($stmt, $sql)){                              //if it fails, send back to profile.php to error msg
        header("location: ../profile.php?error=stmtfailedupdateprofile");
        exit();
    }

    if(mysqli_stmt_execute($stmt)){                                     //
        if(isset($_FILES['pp']) && $_FILES['pp']['tmp_name'] != ''){
            $_SESSION['profile_pic'] = $fnamep;
        }
    }
    else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);

    header("location: ../profile.php?error=none"); //no errors were made
    exit();
}
?>