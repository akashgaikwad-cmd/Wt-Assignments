<?php
$host = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "employee_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
