<?php
require "db_connect.php";

// Fetch all bookings
$bookings = $conn->query("SELECT id, email FROM trip_requests");

if (!$bookings) {
    die("Query failed: " . $conn->error);
}

$updated = 0;

while ($row = $bookings->fetch_assoc()) {
    $booking_id = $row['id'];
    $email = strtolower(trim($row['email']));

    // Find matching user by email only
    $user_result = $conn->query("SELECT id FROM users WHERE LOWER(email)='$email' LIMIT 1");

    if ($user_result && $user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        $user_id = $user['id'];

        // Update trip_requests.user_id
        $conn->query("UPDATE trip_requests SET user_id=$user_id WHERE id=$booking_id");
        $updated++;
    }
}

echo "Updated $updated bookings successfully.";