<?php
    session_start();
    include 'dbh.inc.php';

    $id = NULL; 
    extract($_POST);
    if(isset($_POST['id'])){
    $sql = "DELETE FROM post WHERE PostID = $id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailedcreatepost");
        exit();
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none"); //no errors were made
    exit();
    }

?>