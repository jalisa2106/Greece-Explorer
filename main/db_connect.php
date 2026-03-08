<?php
$host = "localhost";
$user = "root";   // default in XAMPP
$password = "";   // default in XAMPP
$dbname = "greece_explorer";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>