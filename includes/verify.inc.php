<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    mysqli_begin_transaction($conn);

    $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Verified' WHERE UsersID=$id");
    $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account has been verified!', 'Resident', $id);");

    if($a1 && $a2){
        mysqli_commit($conn);
    }
    else{
        mysqli_rollback($conn);
    }

    /*$sql = "UPDATE users SET VerifyStatus='Verified' WHERE UsersID=$id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailedcreatepost");
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none"); //no errors were made
    exit();*/

?>