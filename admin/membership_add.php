<?php 
include 'includes/db_connect.php';

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $yearly_equivalent = $_POST['yearly_equivalent'];
    $description = $_POST['description'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO membership_plans (plan_name, price, yearly_equivalent, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdis", $plan_name, $price, $yearly_equivalent, $description);

    if ($stmt->execute()) {
        $success_message = "Membership plan added successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Membership Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

<div class="flex">
    <?php include('includes/sidebar.php'); ?>

    <div class="flex-1 p-10">
        <h2 class="text-2xl font-semibold mb-5">Add New Membership Plan</h2>

        <!-- Display success or error message -->
        <?php if(isset($success_message)) { ?>
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-200 dark:text-green-900" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } elseif (isset($error_message)) { ?>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-red-200 dark:text-red-900" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <!-- Membership Add Form -->
        <form method="POST" action="membership_add.php" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="plan_name" class="block mb-2 text-sm font-medium text-gray-900">Plan Name</label>
                    <input type="text" name="plan_name" id="plan_name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="Plan Name" required>
                </div>

                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (Rs)</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="Price" required>
                </div>

                <div>
                    <label for="yearly_equivalent" class="block mb-2 text-sm font-medium text-gray-900">Yearly Equivalent (Rs)</label>
                    <input type="number" name="yearly_equivalent" id="yearly_equivalent" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="Yearly Equivalent" required>
                </div>

                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5" rows="4" placeholder="Plan Description" required></textarea>
                </div>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Plan</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
