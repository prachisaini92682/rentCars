<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "rentCars";

$servername = "sql310.infinityfree.com";
$username = "if0_36142496";
$password = "Zqf7JRbSubSum";
$dbname = "if0_36142496_rentcars";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$dbStatus = "Connected successfully";
?>

