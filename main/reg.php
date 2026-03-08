<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $data = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message\n";
    file_put_contents("registrations.txt", $data, FILE_APPEND);

    echo "<!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>Thank You - Greece Explorer</title>
                <link rel='stylesheet' href='thankyou.css'>
            </head>
            <body>
                <h1>Thank You <strong>$name</strong> for Registering!</h1>
                <p>We’ve received your registration and will be in touch soon.  
                Your journey into the beauty of Greece begins now!</p>
                <a href='home.php'>Back to Home</a>
            </body>
            </html>";

    // header("Location: thankyou.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Community Registration - Greece Explorer</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <div class="reg-container">
        <!-- Left Side Image -->
        <div class="reg-image">
            <div class="image-text">
                <h1>Join the Greece Explorer Community</h1>
                <p>Be part of our travel family and explore the beauty of Greece.</p>
            </div>
        </div>

        <!-- Right Side Form -->
        <div class="reg-form">
            <h2>Register Now</h2>
            <form method="post" action="">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>

                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" required>

                <label for="message">Message</label>
                <textarea name="message" id="message" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>