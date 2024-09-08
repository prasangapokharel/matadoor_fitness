<?php
// update_duration.php

// Include database connection
include 'includes/db_connect.php';

// Get current date
$current_date = date('Y-m-d');

// Update plan end dates based on the duration
$query = "
    UPDATE gym_registrations
    SET plan_end_date = DATE_SUB(plan_end_date, INTERVAL 1 DAY)
    WHERE plan_end_date IS NOT NULL AND plan_end_date < '$current_date'
";

if (mysqli_query($conn, $query)) {
    echo "Durations updated successfully.";
} else {
    echo "Error updating durations: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
