<?php
// create-admin.php  (run this once, then delete or protect the file)
include 'db_connect.php'; // must set $conn (MySQLi) reliably

$name  = "Ananya Rao";
$email = "ananya25.rao@example.com";
$plain_password = "GreeceAdmin#2025";
$role  = "admin";

// Hash the password securely
$hashed = password_hash($plain_password, PASSWORD_DEFAULT);

// Prepare and execute insert (adjust table/column names if different)
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssss", $name, $email, $hashed, $role);

if ($stmt->execute()) {
    echo "Admin user created successfully. Email: {$email}  (delete this script now)";
} else {
    echo "Insert failed: " . $stmt->error;
}

$stmt->close();
$conn->close();