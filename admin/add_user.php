<?php
// Include database connection
include 'includes/db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $plan = mysqli_real_escape_string($conn, $_POST['plan']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Calculate end_date based on the selected plan
    switch ($plan) {
        case 'Monthly':
            $end_date = date('Y-m-d', strtotime('+1 month'));
            break;
        case '6 Month':
            $end_date = date('Y-m-d', strtotime('+6 months'));
            break;
        case 'Yearly':
            $end_date = date('Y-m-d', strtotime('+1 year'));
            break;
        default:
            $end_date = date('Y-m-d');
            break;
    }

    // Insert user into the database
    $query = "INSERT INTO gym_registrations (full_name, email, contact_number, plan, status, end_date) 
              VALUES ('$full_name', '$email', '$contact_number', '$plan', '$status', '$end_date')";

    if (mysqli_query($conn, $query)) {
        // Redirect back to users page with success message
        header('Location: users.php?message=User added successfully');
        exit;
    } else {
        // Display error message
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold mb-4">Add New User</h2>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="full_name" class="block text-gray-700">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="contact_number" class="block text-gray-700">Phone</label>
            <input type="text" id="contact_number" name="contact_number" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="plan" class="block text-gray-700">Plan</label>
            <select id="plan" name="plan" class="w-full p-2 border rounded" required>
                <option value="Monthly">Monthly - 1,500 Rs</option>
                <option value="6 Month">6 Month - 5,000 Rs</option>
                <option value="Yearly">Yearly - 10,000 Rs</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select id="status" name="status" class="w-full p-2 border rounded">
                <option value="Unpaid">Unpaid</option>
                <option value="Paid">Paid</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add User</button>
        </div>
    </form>
</div>

</body>
</html>
