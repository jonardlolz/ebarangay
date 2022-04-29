<!-- handles the connection to database -->

<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ebarangaydb";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

