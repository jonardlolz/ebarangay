<?php

$servername = "localhost";
$username = "root";
$password = "789632145";
$dbname = "ebarangaydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM schedule";  //This is where I specify what data to query
$result = mysqli_query($conn, $sql);
$query = doquery("SELECT * FROM schedule");

while(($result = mysqli_fetch_array($query))){
    
}


// $data = array();
// while($enr = mysqli_fetch_array($result)){
//     $a = array("scheduleDate" => $enr["scheduleDate"]);
//     array_push($data, $a);
// }

echo json_encode($data);


?>
