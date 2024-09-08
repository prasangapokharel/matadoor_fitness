<?php
// Include database connection
include 'includes/db_connect.php';

// Get POST data
$id = $_POST['id'];
$plan_id = $_POST['plan_id'];
$status = $_POST['status'];

// Update query
$update_query = "
    UPDATE gym_registrations
    SET plan_id = '$plan_id', status = '$status'
    WHERE id = '$id'
";

if (mysqli_query($conn, $update_query)) {
    // Redirect to users page with success message
    header("Location: users.php?message=Client updated successfully");
} else {
    // Redirect to users page with error message
    header("Location: users.php?error=Error updating client");
}

// Close the connection
mysqli_close($conn);
?>
