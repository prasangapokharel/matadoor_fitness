<?php include 'includes/session.php'; ?>

<?php
// Include your database connection file
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $duration = $_POST['duration']; // This will be the number of days

    // Validate input (basic example)
    if (!empty($name) && !empty($price) && !empty($duration)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO plans (name, price, duration) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $name, $price, $duration);

        // Execute the statement
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
    <!-- Include Tailwind CSS and FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-gray-100 flex">

<!-- Include sidebar -->
<?php include('includes/sidebar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-6">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Add a New Plan</h1>
    </div>

    <!-- Add Plan Form -->
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <?php if (isset($message)): ?>
            <div class="mb-4 p-3 rounded-lg <?= strpos($message, 'success') !== false ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="plan.php" method="POST" class="space-y-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Plan Name:</label>
                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold">Price:</label>
                <input type="number" id="price" name="price" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-gray-700 font-semibold">Duration (in days):</label>
                <input type="number" id="duration" name="duration" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="text-center">
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2  w-full">Add Plan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
