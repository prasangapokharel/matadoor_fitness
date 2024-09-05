<?php
// Include database connection
include 'includes/db_connect.php';

$error_message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $plan_id = mysqli_real_escape_string($conn, $_POST['plan']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Fetch plan details from the database
    $planQuery = "SELECT name FROM plans WHERE id = ?";
    $stmt = $conn->prepare($planQuery);
    $stmt->bind_param("i", $plan_id);
    $stmt->execute();
    $planResult = $stmt->get_result();
    $plan = $planResult->fetch_assoc();
    $stmt->close();

    if ($plan) {
        $plan_name = $plan['name'];

        // Calculate end_date based on the selected plan
        switch ($plan_name) {
            case 'Monthly':
                $end_date = date('Y-m-d', strtotime('+1 month'));
                break;
            case '6 Months':
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
                  VALUES ('$full_name', '$email', '$contact_number', '$plan_name', '$status', '$end_date')";

        if (mysqli_query($conn, $query)) {
            // Redirect back to users page with success message
            header('Location: users.php?message=User added successfully');
            exit;
        } else {
            // Display error message
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Invalid plan selected.";
    }
}

// Fetch plans for the form
$plansQuery = "SELECT id, name FROM plans";
$plansResult = mysqli_query($conn, $plansQuery);
?>
<!-- admin/add_user.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <!-- Include Sidebar -->
    <?php include('includes/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="flex-1 p-6 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-semibold mb-4">Add New User</h2>
            
            <?php if ($error_message): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
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
                        <?php while ($row = mysqli_fetch_assoc($plansResult)): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
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
    </div>

</body>
</html>
