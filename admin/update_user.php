<?php
// Include database connection
include 'includes/db_connect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $userId = $_POST['id'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $plan = $_POST['plan'];
    $status = $_POST['status'];

    // Calculate the start and end date based on the selected plan
    $startDate = date('Y-m-d'); // Current date as the start date
    $endDate = ''; // Initialize end date variable

    switch ($plan) {
        case 'monthly':
            $endDate = date('Y-m-d', strtotime('+1 month', strtotime($startDate))); // Add 1 month to the start date
            break;
        case '6 months':
            $endDate = date('Y-m-d', strtotime('+6 months', strtotime($startDate))); // Add 6 months to the start date
            break;
        case 'yearly':
            $endDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate))); // Add 1 year to the start date
            break;
        default:
            // If no valid plan is selected, set end date to null
            $endDate = null;
    }

    // Calculate days left
    $daysLeft = $endDate ? (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24) : 0;

    // Update user details in the database
    $query = "UPDATE gym_registrations SET full_name = ?, email = ?, plan = ?, status = ?, start_date = ?, end_date = ?, days_left = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssii", $fullName, $email, $plan, $status, $startDate, $endDate, $daysLeft, $userId);

    // Execute the statement and check if the update was successful
    if ($stmt->execute()) {
        echo "User details updated successfully.";
    } else {
        echo "Error updating user details: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back to the admin page if the request method is not POST
    header('Location: admin/users.php');
    exit();
}
?>
