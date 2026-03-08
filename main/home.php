<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <link rel="stylesheet" href="home.css" />
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a target="_blank" href="about.html">About us</a></li>
        <li><a target="_blank" href="greece.html">About Greece</a></li>
        <li><a target="_blank" href="spots.html">Tourist Spots</a></li>
        <li><a target="_blank" href="tips.html">Travel Tips</a></li>
        <li><a target="_blank" href="budget.html">Budget</a></li>
        <li><a target="_blank" href="culture.html">Culture</a></li>
        <li><a target="_blank" href="contact.html">Contact us</a></li>
        <li><a target="_blank" href="feedback.html">Feedback</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
          <?php if ($_SESSION['user_role'] === 'admin'): ?>
            <li><a href="admin-dashboard.php">Admin Dashboard</a></li>
          <?php else: ?>
            <li><a href="dashboard.php">Dashboard</a></li>
          <?php endif; ?>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php">Login / Signup</a></li>
        <?php endif; ?>

      </ul>
    </nav>
  </header>

  <main>
    <div class="slider-container">
      <div class="slider">
        <div class="slide active" style="background-image: url('https://handluggageonly.co.uk/wp-content/uploads/2015/05/Hand-Luggage-Only-7.jpg');"></div>
        <div class="slide" style="background-image: url('https://cdn.tourradar.com/s3/serp/1536x1552/2147_iyMRxiWm.jpg');"></div>
        <div class="slide" style="background-image: url('https://media.timeout.com/images/105211701/image.jpg');"></div>
      </div>
      <div class="slider-text">
        <h1>Welcome to GREECE EXPLORER!</h1>
      </div>
    </div>

    <p>
      Experience the charm of whitewashed villages, ancient ruins, sparkling
      blue seas, and unforgettable sunsets...
    </p>

    <h2>Why Travel to GREECE?</h2>
    <ul>
      <li><b>Timeless History:</b> Walk in the footsteps of philosophers...</li>
      <li><b>Breathtaking Islands:</b> From the romantic cliffs of Santorini...</li>
      <li><b>Warm Hospitality:</b> Known for philoxenia (love for strangers)...</li>
      <li><b>Delicious Cuisine:</b> Taste fresh Mediterranean flavors...</li>
      <li><b>Adventure Awaits:</b> Hike, dive, or relax in a seaside village.</li>
    </ul>

    <h2>What You’ll Find on Our Website</h2>
    <ul>
      <li><b>Top Tourist Spots:</b> Guides to must-visit locations</li>
      <li><b>Budget Tips:</b> Plan a trip that fits your wallet</li>
      <li><b>Travel Advice:</b> Packing lists, health & safety</li>
      <li><b>Cultural Insights:</b> Local food, festivals, traditions</li>
      <li><b>Custom Itineraries:</b> Create or book your ideal vacation</li>
      <li><b>Contact & Support:</b> We’re here to help!</li>
    </ul>

    <h2>Featured Destinations</h2>
    <ul>
      <li><b>Athens:</b> Ancient wonders meet modern lifestyle</li>
      <li><b>Santorini:</b> Romance, views, and volcanic history</li>
      <li><b>Crete:</b> Land of legends and landscapes</li>
      <li><b>Rhodes:</b> Medieval cities and golden beaches</li>
      <li><b>Delphi:</b> Home of the ancient oracle</li>
    </ul>

    <hr />
    <h2>Traveler Highlights</h2>
    <p>“We followed the Santorini itinerary...” – <i>Priya, India</i></p>
    <p>“Thanks to your tips, we explored Meteora...” – <i>James, UK</i></p>

    <h2>Top Travel Highlights</h2>
    <div id="highlight-events">
      <?php
      // Fetch top 3 upcoming events from database
      $sql = "SELECT event_name, location, event_date, description 
                FROM events 
                ORDER BY event_date ASC 
                LIMIT 3";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='highlight-card'>";
          echo "<h4>" . htmlspecialchars($row['event_name']) . "</h4>";
          echo "<p><b>📍 Location:</b> " . htmlspecialchars($row['location']) . "</p>";
          echo "<p><b>🗓 Date:</b> " . htmlspecialchars($row['event_date']) . "</p>";
          echo "<p>" . htmlspecialchars($row['description']) . "</p>";
          echo "</div>";
        }
      } else {
        echo "<p>No upcoming events. Check back soon!</p>";
      }
      ?>
    </div>
  </main>

  <footer class="content">
    <p>&copy; 2025 Greece Explorer. All rights reserved.</p>
    <br />
    <a href="reg.php">Join the Community</a>
  </footer>
  <script src="home.js"></script>
</body>

</html>