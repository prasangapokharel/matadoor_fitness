<?php
// event/view.php

// Include database connection
include 'admin/includes/db_connect.php';

// Initialize variables
$errorMessage = "";
$event = null;

// Check if an event ID is provided in the URL
if (isset($_GET['id'])) {
    $eventId = intval($_GET['id']);  // Convert the ID to an integer for safety

    // Fetch the event data from the database
    $sql = "SELECT * FROM events WHERE id = $eventId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        $errorMessage = "Event not found.";
    }
} else {
    $errorMessage = "No event ID provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <style>
        .footer {
            background-color: #f9fafb;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <?php include('includes/navbar.php'); ?>

    <!-- Main content wrapper using Flexbox -->
    <div class="flex-grow container mx-auto p-4">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <!-- Error or Success Message -->
            <?php if (!empty($errorMessage)) { ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php } else if ($event) { ?>

                <!-- Event Image -->
                <?php if (!empty($event['image_path'])) { ?>
                    <div class="mb-6">
                        <img src="./uploads/<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                <?php } ?>

                <!-- Event Description -->
                <div class="text-lg text-gray-700 mb-6">
                    <?php echo $event['description']; ?>
                </div>

                <!-- Back Button -->
                <div class="flex justify-center">
                    <a href="/matadoor-fitness/event.php" class="inline-block px-6 py-3 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition duration-300">Back to Events</a>
                </div>
            <?php } else { ?>
                <p class="text-gray-700 text-lg text-center">No event data available.</p>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer py-4 text-center">
        <?php include('includes/footer.php'); ?>
    </footer>

</body>
</html>
