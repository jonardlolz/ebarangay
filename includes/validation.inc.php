<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "789632145";
$dbName = "ebarangaydb";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(isset($_GET['emailExist'])){
    extract($_POST);
    $sql = $conn->query("SELECT * FROM users WHERE emailAdd='$userEmail'");
    $row_cnt = $sql->num_rows;
    if($row_cnt > 0){
        echo 'false';
    }
    else{
        echo 'true';
    }
}
if(isset($_GET['userExist'])){
    extract($_POST);
    $sql = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row_cnt = $sql->num_rows;
    if($row_cnt > 0){
        echo 'false';
    }
    else{
        echo 'true';
    }
}
if(isset($_GET['loginuserExist'])){
    extract($_POST);
    $sql = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row_cnt = $sql->num_rows;
    if($row_cnt == 0){
        echo 'false';
    }
}

?>