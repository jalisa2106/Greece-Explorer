<?php
session_start();
require "db_connect.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = intval($_SESSION['user_id']);
$user_role = $_SESSION['user_role'] ?? 'user';

// Admin sees all bookings (LEFT JOIN to handle missing users)
if ($user_role === 'admin') {
  $sql = "SELECT t.*, u.name AS user_name, u.email AS user_email
            FROM trip_requests t
            LEFT JOIN users u ON t.user_id = u.id
            ORDER BY t.created_at DESC";
} else {
  // Regular users see only their own bookings
  $sql = "SELECT * FROM trip_requests WHERE user_id = $user_id ORDER BY created_at DESC";
}

$result = $conn->query($sql);
if (!$result) {
  die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Bookings</title>
  <link rel="stylesheet" href="view-bookings.css?v=4">
</head>

<body>
  <h2>📅 Bookings</h2>

  <!-- Back button -->
  <div class="back-wrap">
    <a class="back-btn" href="<?php echo ($user_role === 'admin') ? 'admin-dashboard.php' : 'dashboard.php'; ?>">
      ⬅ Back to Dashboard
    </a>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <?php if ($user_role === 'admin'): ?>
            <th>User Name</th>
            <th>User Email</th>
          <?php endif; ?>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Country</th>
          <th>Destination</th>
          <th>Duration</th>
          <th>Preferences</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <?php if ($user_role === 'admin'): ?>
                <td><?php echo htmlspecialchars($row['user_name'] ?? 'Unknown User'); ?></td>
                <td><?php echo htmlspecialchars($row['user_email'] ?? '-'); ?></td>
              <?php endif; ?>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['phone']); ?></td>
              <td><?php echo htmlspecialchars($row['country']); ?></td>
              <td><?php echo htmlspecialchars($row['places']); ?></td>
              <td><?php echo htmlspecialchars($row['duration']); ?></td>
              <td><?php echo htmlspecialchars($row['preferences']); ?></td>
              <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="<?php echo ($user_role === 'admin') ? 10 : 8; ?>">No bookings found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>