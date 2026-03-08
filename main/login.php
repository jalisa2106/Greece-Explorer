<?php
session_start();
$logout_msg = "";

// If logout message exists
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $logout_msg = "✅ You have successfully logged out.";
}

// Redirect logged-in users to home
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

include "db_connect.php";

// Initialize message variables
$signup_msg = "";
$login_msg  = "";

// ------------------- SIGNUP -------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["signup"])) {
    $name     = $conn->real_escape_string($_POST["name"]);
    $email    = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $country  = $conn->real_escape_string($_POST["country"]);
    $role     = "user"; // default role

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $signup_msg = "Email already registered. Try logging in.";
    } else {
        $sql = "INSERT INTO users (name, email, password, country, role)
                VALUES ('$name', '$email', '$password', '$country', '$role')";
        if ($conn->query($sql)) {
            $signup_msg = "Registration successful! Please log in.";
        } else {
            $signup_msg = "Error: " . $conn->error;
        }
    }
}

// ------------------- LOGIN -------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $email    = $conn->real_escape_string($_POST["email"]);
    $password = $_POST["password"];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"]   = $row["id"];
            $_SESSION["user_name"] = $row["name"];
            $_SESSION["user_role"] = $row["role"];
            $_SESSION['email']     = $row['email'];

            // // Redirect based on role
            // if ($row["role"] === "admin") {
            //     header("Location: admin-dashboard.php");
            // } else {
            //     header("Location: home.php");
            // }
            header("Location: home.php");
            exit();
        } else {
            $login_msg = "Invalid password.";
        }
    } else {
        $login_msg = "Email not registered.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Login / Signup</title>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <header>
    <h1>🔐 Login / Signup</h1>
  </header>

  <main>
    <!-- Messages -->
    <?php
    if (!empty($signup_msg)) {
      echo "<p class='message success'>$signup_msg</p>";
    } elseif (!empty($logout_msg)) {
      echo "<p class='message success'>$logout_msg</p>";
    } elseif (!empty($login_msg)) {
      echo "<p class='message error'>$login_msg</p>";
    }
    ?>

    <p>Welcome! Create your account or log in to start planning your perfect trip to Greece.</p>
    <hr />

    <!-- Signup Section -->
    <h2>🧭 New User? Sign Up</h2>
    <form id="signupForm" method="POST" onsubmit="return validateSignUp()">
      <input type="hidden" name="signup" value="1" />
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required />

      <label for="email_signup">Email Address:</label>
      <input type="email" id="email_signup" name="email" required />

      <label for="password_signup">Password:</label>
      <div class="password-wrapper">
        <input type="password" id="password_signup" name="password" required />
        <span class="toggle-password" onclick="toggleVisibility('password_signup', this)">👁️</span>
      </div>

      <label for="country">Country (Optional):</label>
      <input type="text" id="country" name="country" />

      <input type="submit" value="Sign Up" />
    </form>

    <hr />

    <!-- Login Section -->
    <h2>🔓 Already Have an Account? Login</h2>
    <form id="loginForm" method="POST" onsubmit="return validateLogin()">
      <input type="hidden" name="login" value="1" />

      <label for="email_login">Email Address:</label>
      <input type="email" id="email_login" name="email" required />

      <label for="password_login">Password:</label>
      <div class="password-wrapper">
        <input type="password" id="password_login" name="password" required />
        <span class="toggle-password" onclick="toggleVisibility('password_login', this)">👁️</span>
      </div>

      <input type="submit" value="Login" />
    </form>

    <p><a href="#">Forgot Password?</a></p>

    <hr />
    <p><i>We follow strict data protection guidelines. Your login details are encrypted, and your personal information is never shared without your permission.</i></p>
  </main>

  <footer>
    <p>&copy; 2025 Greece Explorer. All rights reserved.</p>
  </footer>

  <script src="login.js"></script>
</body>

</html>