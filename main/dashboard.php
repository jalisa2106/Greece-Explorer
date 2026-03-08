<?php
session_start();
require 'db_connect.php';

// Protect route → only logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['user_role'] === 'admin') {
    header("Location: admin-dashboard.php"); // redirect admins
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT name, email, country, created_at FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Greece Explorer</title>
    <link rel="stylesheet" href="dashboard.css">
    <!-- <link rel="stylesheet" href="style.css"> to reuse site nav/footer styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Dashboard -->
    <main class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <i class="fas fa-user-circle"></i>
            <h1>User Dashboard</h1>
        </div>

        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h3>

        <!-- Profile Section -->
        <section class="profile-section">
            <h2>My Profile</h2>
            <div class="profile-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
                <p><strong>Member Since:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
            </div>
        </section>

        <!-- My Bookings Card -->
        <div class="section-card">
            <h3><i class="fas fa-book-open"></i> My Bookings</h3>
            <p>View your submitted trip requests.</p>
            <a href="view-bookings.php">Go to My Bookings</a>
        </div>

        <!-- New Booking Card -->
        <div class="section-card">
            <h3><i class="fas fa-plus-circle"></i> New Booking</h3>
            <p>Plan your next trip to Greece.</p>
            <a href="booking.php">Book Now</a>
        </div>

        <!-- Logout -->
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </main>

</body>

</html>