<?php
session_start();
require "db_connect.php";

// Allow only admins
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

// Handle delete action
if (isset($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);
  if ($delete_id !== $_SESSION['user_id']) { // prevent deleting self
    $conn->query("DELETE FROM users WHERE id=$delete_id");
  }
  header("Location: view-users.php");
  exit();
}

// Handle update action (Name, Email, Country only)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_user'])) {
  $user_id = intval($_POST['user_id']);
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $country = $conn->real_escape_string($_POST['country']);

  if ($user_id !== $_SESSION['user_id']) { // prevent editing self
    $conn->query("UPDATE users SET name='$name', email='$email', country='$country' WHERE id=$user_id");
  }
  header("Location: view-users.php");
  exit();
}

// Fetch all users
$result = $conn->query("SELECT id, name, email, country, role, created_at FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="view-users.css?v=6">
</head>
<body>
    <h2>👥 Manage Users</h2>

    <!-- Back to dashboard link -->
    <div class="back-wrap">
        <a class="back-btn" href="admin-dashboard.php">⬅ Back to Admin Dashboard</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <?php if ($row['id'] !== $_SESSION['user_id']): ?>
                            <form method="POST" class="edit-form">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                        <?php else: ?>
                            <?php echo htmlspecialchars($row['name']); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($row['id'] !== $_SESSION['user_id']): ?>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                        <?php else: ?>
                            <?php echo htmlspecialchars($row['email']); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($row['id'] !== $_SESSION['user_id']): ?>
                                <input type="text" name="country" value="<?php echo htmlspecialchars($row['country']); ?>" required>
                        <?php else: ?>
                            <?php echo htmlspecialchars($row['country']); ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <?php if ($row['id'] !== $_SESSION['user_id']): ?>
                                <button type="submit" name="update_user">Update</button>
                            </form>
                            <a class="delete-btn" href="view-users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        <?php else: ?>
                            <span class="self-note">Your Account</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>