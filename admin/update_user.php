<?php
include 'includes/db_connect.php';

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['plan'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    $plan = $_POST['plan'];
    $startDate = null; // Will only set if 'Paid'
    $endDate = null;

    if ($status === 'Paid') {
        $startDate = date('Y-m-d'); // Set start date to today if 'Paid'
        
        // Calculate the end date based on the plan
        switch ($plan) {
            case 'Monthly':
                $endDate = date('Y-m-d', strtotime('+1 month', strtotime($startDate)));
                break;
            case '6 months':
                $endDate = date('Y-m-d', strtotime('+6 months', strtotime($startDate)));
                break;
            case 'Yearly':
                $endDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate)));
                break;
        }
    }

    // Update user status and plan
    $query = "UPDATE gym_registrations SET status = ?, plan = ?, start_date = ?, end_date = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssi', $status, $plan, $startDate, $endDate, $id);
    mysqli_stmt_execute($stmt);

    // Calculate days left (only if paid)
    $daysLeft = 'N/A';
    if ($status === 'Paid' && $endDate) {
        $daysLeft = max(0, (strtotime($endDate) - time()) / (60 * 60 * 24));
    }

    // Update days_left in the database
    $query = "UPDATE gym_registrations SET days_left = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $daysLeft, $id);
    mysqli_stmt_execute($stmt);

    // Redirect to the users list
    header('Location: users.php');
    exit();
}

mysqli_close($conn);
?>
