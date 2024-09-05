<?php
// admin/delete_event.php

// Include database connection
include '../includes/db_connect.php';

// Check if an event ID is provided
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Fetch event details to delete the image file
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if ($event) {
        // Delete the event from the database
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $eventId);
        if ($stmt->execute()) {
            // Delete the image file from the server
            $imagePath = "../uploads/" . $event['image_path'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Redirect to the post.php with a success message
            header("Location: ../post.php?message=Event successfully deleted");
            exit();
        } else {
            // Redirect with an error message
            header("Location: ../post.php?error=Error deleting event: " . $conn->error);
            exit();
        }
    } else {
        // Redirect with an error message
        header("Location: ../post.php?error=Event not found.");
        exit();
    }
} else {
    // Redirect with an error message
    header("Location: ../post.php?error=Invalid request.");
    exit();
}
?>
