<?php include 'includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
<!-- Include Sidebar -->
<?php include('includes/sidebar.php'); ?>

<div class="flex-1 p-6 rounded-full">
    <?php
    // Include database connection
    include 'includes/db_connect.php';

    // Get client ID from URL
    $clientId = $_GET['id'];

    // Fetch client details
    $query = "
        SELECT gym_registrations.*, plans.name AS plan_name
        FROM gym_registrations
        LEFT JOIN plans ON gym_registrations.plan_id = plans.id
        WHERE gym_registrations.id = '$clientId'
    ";
    $result = mysqli_query($conn, $query);
    $client = mysqli_fetch_assoc($result);

    // Fetch available plans
    $plans_query = "SELECT id, name FROM plans";
    $plans_result = mysqli_query($conn, $plans_query);

    // Close the connection
    mysqli_close($conn);
    ?>

    <div class="bg-white p-6 rounded-3xl shadow-lg">
        <h1 class="text-2xl font-semibold mb-4 text-center">CUSTOMER DETAILS</h1>
       
        <form action="update_user.php" method="POST" class="flex flex-col space-y-4 rounded-lg">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">

            <div class="flex flex-col ">
                <label class="text-gray-700 font-medium">Full Name:</label>
                <input type="text" value="<?php echo htmlspecialchars($client['full_name']); ?>" class="border-blue-700 p-2 border-1 rounded-lg " readonly>
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Email:</label>
                <input type="email" value="<?php echo htmlspecialchars($client['email']); ?>" class="border-blue-700 p-2 border-1 rounded-lg " readonly>
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Phone:</label>
                <input type="text" value="<?php echo htmlspecialchars($client['contact_number']); ?>" class="border-blue-700 p-2 border-1 rounded-lg " readonly>
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Plan:</label>
                <select name="plan_id" class="border-blue-700 p-2 border-1 rounded-lg ">
                    <?php
                    while ($plan = mysqli_fetch_assoc($plans_result)) {
                        $selected = $client['plan_id'] == $plan['id'] ? 'selected' : '';
                        echo "<option value='{$plan['id']}' {$selected}>{$plan['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 font-medium">Status:</label>
                <select name="status" class="border-blue-700 p-2 border-1 rounded-lg ">
                    <option value="Unpaid" <?php echo $client['status'] == 'Unpaid' ? 'selected' : ''; ?>>Unpaid</option>
                    <option value="Paid" <?php echo $client['status'] == 'Paid' ? 'selected' : ''; ?>>Paid</option>
                </select>
            </div>

            <!-- Update Button -->
            <div class="text-center">
                <button type="submit" class="font-medium bg-green-500 text-white px-6 py-3 rounded-full w-full">Update</button>
            </div>

            
        </form>
         <!-- Delete Button -->
         <div class="text-center mt-4 flex">
                <a href="delete_user.php?id=<?php echo $client['id']; ?>"
                   class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 w-full"
                   onclick="return confirm('Are you sure you want to delete this user?');">
                   Delete User
                </a>
            </div>
    </div>
</div>

</body>
</html>
