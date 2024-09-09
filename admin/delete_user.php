<?php
include 'includes/db_connect.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Convert the id to an integer to prevent SQL injection

    // Prepare the DELETE query
    $sql = "DELETE FROM gym_registrations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId); // Bind the id as an integer

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect to the clients list page after successful deletion
        header("Location: users.php?message=UserDeleted");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the clients list page if no id is provided
    header("Location: users.php?error=NoUserID");
}
?>
