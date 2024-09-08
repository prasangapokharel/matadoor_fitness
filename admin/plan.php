<?php 
include 'includes/session.php'; 
include 'includes/db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $duration = $_POST['duration']; // in days

    // Basic validation
    if (!empty($name) && !empty($price) && !empty($duration)) {
        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO plans (name, price, duration) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $name, $price, $duration);

        if ($stmt->execute()) {
            $message = "Plan added successfully!";
        } else {
            $message = "Error adding plan: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "All fields are required!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Plan - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex">

<!-- Include sidebar -->
<?php include('includes/sidebar.php'); ?>

<!-- Main content -->
<div class="flex-1 p-6">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Add a New Plan</h1>
    </div>

    <!-- Plan Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <!-- Success or error message -->
        <?php if (isset($message)): ?>
            <div class="mb-4 p-3 rounded-lg <?= strpos($message, 'success') !== false ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="plan.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700 font-semibold">Plan Name</label>
                <input type="text" id="name" name="name" class="w-full p-2.5 border border-gray-300 rounded-lg" placeholder="Enter plan name" required>
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-semibold">Price (Rs)</label>
                <input type="number" id="price" name="price" step="0.01" class="w-full p-2.5 border border-gray-300 rounded-lg" placeholder="Enter price" required>
            </div>

            <div>
                <label for="duration" class="block text-gray-700 font-semibold">Duration (in days)</label>
                <input type="number" id="duration" name="duration" class="w-full p-2.5 border border-gray-300 rounded-lg" placeholder="Enter duration in days" required>
            </div>

            <div class="text-center">
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                    Add Plan
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
