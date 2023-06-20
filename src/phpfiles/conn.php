<?php
$host = "localhost"; // Replace with your MySQL server host
$user = "root"; // Replace with your MySQL username
$password = "root"; // Replace with your MySQL password
$database = "tea_management_db"; // Replace with your MySQL database name

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";
?>