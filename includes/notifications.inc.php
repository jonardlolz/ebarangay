<?php

include 'dbh.inc.php';

session_start();
extract($_POST);

if(isset($_GET['read'])){
    $sql = "UPDATE notifications SET status='Read' WHERE UsersID={$_SESSION['UsersID']} OR position='{$_SESSION['userType']}'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
}