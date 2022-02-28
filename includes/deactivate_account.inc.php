<?php

session_start();
include 'dbh.inc.php';
extract($_POST);

$sql = "UPDATE users SET Status='Inactive' WHERE UsersID=$id";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../account.php?error=stmtfailedcreatepost");
    exit();
}

if(!mysqli_stmt_execute($stmt)){
    header("location: ../account.php?error=sqlErr");
    exit();
}
mysqli_stmt_close($stmt);

header("location: ../account.php?error=none");
exit();
?>