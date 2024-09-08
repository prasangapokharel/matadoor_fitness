<?php
// delete_event.php

include 'includes/session.php';
include 'includes/db_connect.php';

// Initialize variables
$errorMessage = "";
$successMessage = "";

// Check if an event ID is provided
if (isset($_GET['id'])) {
    $eventId = intval($_GET['id']);

    // Fetch the event data to get the image path
    $sql = "SELECT image_path FROM events WHERE id = $eventId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc();
        $imagePath = $event['image_path'];

        // Delete the event record from the database
        $sql = "DELETE FROM events WHERE id = $eventId";
        if ($conn->query($sql) === TRUE) {
            // Remove the image file from the server
            if (!empty($imagePath)) {
                $fileToDelete = "../uploads/" . $imagePath;
                if (file_exists($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }
            $successMessage = "Event deleted successfully.";
                        // Redirect back to users page with success message
                        header('Location: manage_events.php');
                        exit;
        } else {
            $errorMessage = "Error deleting event: " . $conn->error;
        }
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
    <title>Delete Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
<?php include('includes/sidebar.php'); ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10 mb-10">
    <h2 class="text-2xl font-bold mb-6">Delete Event</h2>

    <?php if (!empty($errorMessage)) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php } ?>
    <?php if (!empty($successMessage)) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo htmlspecialchars($successMessage); ?></div>
        <a href="manage_events.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back to Events</a>
    <?php } ?>
</div>

</body>
</html>
