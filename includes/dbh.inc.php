<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "789632145";
$dbName = "ebarangaydb";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

