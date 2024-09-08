<?php include 'includes/cookies.php'; ?>

<!-- contact.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/site.php'; ?>
    <!-- Include this in the <head> section of your HTML files -->
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="contact-form">
            <span class="heading">Contact Us</span>
            <form action="" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required="">
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required="">
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" required=""></textarea>
                
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'matadoor_fitness');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        echo "Message Sent Successfully!";
        $stmt->close();
        $conn->close();
    }
}
?>
