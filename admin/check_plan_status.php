<?php
// check_plan_status.php

include 'includes/db_connect.php';

// Get the current date
$currentDate = date('Y-m-d');

// Update status to 'expired' where the end date has passed
$query = "UPDATE gym_registrations SET status = 'expired' WHERE end_date < ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $currentDate);

if ($stmt->execute()) {
    echo "User plans checked and updated successfully.";
} else {
    echo "Error updating user plans: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
