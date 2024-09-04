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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/scroll.css">

</head>
<body class="bg-gray-100 scroll-smooth overflow-x-scroll whitespace-nowrap h-screen w-screen">


    <!-- Navbar -->
    <?php include('includes/navbar.php'); ?>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-12 mb-12">
        <!-- Error or Success Message -->
        <?php if (!empty($errorMessage)) { ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?php echo $errorMessage; ?>
            </div>
        <?php } else if ($event) { ?>
            <!-- Event Title -->
            <h1 class="text-4xl font-extrabold mb-6 text-gray-800"><?php echo htmlspecialchars($event['description']); ?></h1>
            
            <!-- Event Image -->
            <?php if (!empty($event['image_path'])) { ?>
                <div class="mb-6">
                    <img src="./uploads/<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image" class="w-full h-auto rounded-lg shadow-md">
                </div>
            <?php } ?>

            <!-- Event Description -->
            <div class="text-gray-700 text-lg leading-relaxed">
                <?php echo $event['description']; ?>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="/matadoor-fitness/event.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back to Events</a>
            </div>
        <?php } else { ?>
            <p class="text-gray-700 text-lg">No event data available.</p>
        <?php } ?>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

</body>
</html>
