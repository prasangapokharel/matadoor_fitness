<?php
include 'includes/db_connect.php';

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['plan'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    $plan_id = intval($_POST['plan']);
    $startDate = null; // Will only set if 'Paid'
    $endDate = null;

    // Fetch the plan details from the database
    $planQuery = "SELECT name FROM plans WHERE id = ?";
    $stmt = mysqli_prepare($conn, $planQuery);
    mysqli_stmt_bind_param($stmt, 'i', $plan_id);
    mysqli_stmt_execute($stmt);
    $planResult = mysqli_stmt_get_result($stmt);
    $plan = mysqli_fetch_assoc($planResult)['name'];
    mysqli_stmt_close($stmt);

    if (!$plan) {
        // Handle invalid plan selection
        echo "Invalid plan selected.";
        exit();
    }

    // Log for debugging
    error_log("Plan selected: $plan");

    // Set start and end dates if status is 'Paid'
    if ($status === 'Paid') {
        $startDate = date('Y-m-d'); // Set start date to today

        // Calculate the end date based on the selected plan
        switch ($plan) {
            case 'Monthly':
                $endDate = date('Y-m-d', strtotime('+1 month', strtotime($startDate)));
                break;
            case '6 Months':
                $endDate = date('Y-m-d', strtotime('+6 months', strtotime($startDate)));
                break;
            case 'Yearly':
                $endDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate)));
                break;
            default:
                $endDate = null;
        }

        // Log the start and end date for debugging
        error_log("Start Date: $startDate");
        error_log("End Date: $endDate");
    }

    // Update user status, plan, start_date, and end_date
    $updateQuery = "UPDATE gym_registrations SET status = ?, plan = ?, start_date = ?, end_date = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'ssssi', $status, $plan, $startDate, $endDate, $id);
    mysqli_stmt_execute($stmt);

    // Calculate days left (only if the user is marked as 'Paid' and the end_date is valid)
    $daysLeft = 'N/A';
    if ($status === 'Paid' && $endDate) {
        $currentDate = new DateTime();
        $endDateObj = new DateTime($endDate);
        $interval = $currentDate->diff($endDateObj);
        $daysLeft = $interval->days;

        if ($currentDate > $endDateObj) {
            $daysLeft = 0; // If the end date is in the past, set days left to 0
        }

        // Log the days left for debugging
        error_log("Days Left: $daysLeft");
    }

    // Update the days_left in the database
    $updateDaysLeftQuery = "UPDATE gym_registrations SET days_left = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateDaysLeftQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $daysLeft, $id);
    mysqli_stmt_execute($stmt);

    // Close the statement and redirect to the users list
    mysqli_stmt_close($stmt);
    header('Location: users.php');
    exit();
}

mysqli_close($conn);
?>
