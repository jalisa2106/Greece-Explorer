<?php
session_start();
require 'db_connect.php';

// Protect route → only logged-in admins
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Greece Explorer</title>
    <link rel="stylesheet" href="dashboard.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Dashboard -->
    <main class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <i class="fas fa-user-shield"></i>
            <h1>Admin Dashboard</h1>
        </div>

        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h3>

        <!-- Manage Users -->
        <div class="section-card">
            <h3><i class="fas fa-users"></i> Manage Users</h3>
            <p>View and manage registered users.</p>
            <a href="view-users.php">Go to Users</a>
        </div>

        <!-- Manage Bookings -->
        <div class="section-card">
            <h3><i class="fas fa-suitcase-rolling"></i> Manage Bookings</h3>
            <p>View and manage all trip requests.</p>
            <a href="view-bookings.php">Go to Bookings</a>
        </div>

        <!-- Logout -->
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </main>

</body>
</html>