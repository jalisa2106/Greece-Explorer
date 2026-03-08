<?php
session_start();
$success = false;
$error = "";

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = intval($_SESSION['user_id']); // get user_id from session

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "db_connect.php";

  // Sanitize inputs
  $name = $conn->real_escape_string($_POST['name'] ?? '');
  $email = $conn->real_escape_string($_POST['email'] ?? '');
  $phone = $conn->real_escape_string($_POST['phone'] ?? '');
  $country = $conn->real_escape_string($_POST['country'] ?? '');
  $duration = $conn->real_escape_string($_POST['duration'] ?? '');
  $preferences = $conn->real_escape_string($_POST['preferences'] ?? '');
  $places = isset($_POST['places']) ? implode(", ", $_POST['places']) : '';

  // Insert into database with session user_id
  $sql = "INSERT INTO trip_requests (user_id, name, email, phone, country, duration, places, preferences) 
            VALUES ($user_id, '$name', '$email', '$phone', '$country', '$duration', '$places', '$preferences')";

  if ($conn->query($sql) === TRUE) {
    $success = true;
  } else {
    $error = "Error: " . $conn->error;
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Booking / Itinerary Planning</title>
  <link rel="stylesheet" href="booking.css" />
  <script defer src="booking.js"></script>
</head>

<body>
  <header>
    <h1>Booking Trip / Itinerary Planning</h1>
  </header>

  <div class="back-wrap">
    <a class="back-btn" href="dashboard.php">⬅ Back to Dashboard</a>
  </div>



  <main>
    <?php if ($success): ?>
      <p class="success-msg">Thank you! Your trip request has been submitted successfully.</p>
    <?php elseif ($error !== ""): ?>
      <p class="error-msg"><?= $error ?></p>
    <?php endif; ?>

    <p>Let us help you plan your dream trip to Greece!</p>

    <p>
      Fill in the form below, and our expert team will create a custom
      itinerary just for you — including flights, hotels, island ferries,
      local tips, and budget optimization.
    </p>

    <h2>Trip Planner Form</h2>
    <form id="tripForm" method="POST" onsubmit="return validateTripForm()">
      <!-- Form Inputs -->
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required />

      <label for="phone">Phone Number (Optional):</label>
      <input type="tel" id="phone" name="phone" />

      <label for="country">Your Country:</label>
      <input type="text" id="country" name="country" required />

      <label for="duration">Trip Duration:</label>
      <select name="duration" id="duration">
        <option value="3-5">3–5 days</option>
        <option value="6-9">6–9 days</option>
        <option value="10+">10+ days</option>
      </select>

      <label for="places">Places you're interested in:</label>
      <input type="checkbox" name="places[]" value="Athens" /> Athens<br />
      <input type="checkbox" name="places[]" value="Santorini" /> Santorini<br />
      <input type="checkbox" name="places[]" value="Mykonos" /> Mykonos<br />
      <input type="checkbox" name="places[]" value="Crete" /> Crete<br />
      <input type="checkbox" name="places[]" value="Delphi" /> Delphi<br />

      <label for="preferences">Any special preferences or activities?</label>
      <textarea
        name="preferences"
        id="preferences"
        rows="5"
        placeholder="e.g., honeymoon, family travel, beach time, hiking, historic sites..."></textarea>

      <input type="submit" value="Submit Request" />
    </form>

    <!-- FAQ Section -->
    <section class="faq-help">
      <button class="faq-toggle">❓ Need help with the form?</button>
      <div class="faq-content">
        <ul>
          <li><strong>Name:</strong> Use your full name as per ID/passport.</li>
          <li><strong>Email:</strong> Double check your email address for typos.</li>
          <li><strong>Preferences:</strong> Mention your purpose clearly (family, couples, solo, etc.).</li>
          <li><strong>Trip Duration:</strong> Choose based on how much you want to explore.</li>
        </ul>
      </div>
    </section>

    <p><strong>Once submitted, our trip planner will contact you soon with a personalized itinerary!</strong></p>
  </main>

  <footer>
    <p>&copy; 2025 Greece Explorer. All rights reserved.</p>
  </footer>
</body>

</html>