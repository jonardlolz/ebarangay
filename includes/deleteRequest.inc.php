<?php
    session_start();
    include 'dbh.inc.php';

    extract($_POST);
    $sql = "UPDATE request SET status='Cancelled' WHERE RequestID = $id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../profile.php?error=stmtfailedcreatepost");
        exit();
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../profile.php?error=none"); //no errors were made
    exit();
?>