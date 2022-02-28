<?php
    session_start();
    include 'dbh.inc.php';

    extract($_POST);
    $sql = "DELETE FROM candidates WHERE candidateID = $id";
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

    header("location: ../election.php?error=none"); //no errors were made
    exit();

?>