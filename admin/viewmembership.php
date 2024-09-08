<?php 
include 'includes/session.php'; 
include 'includes/db_connect.php'; 

// Handle the deletion of a membership plan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM membership_plans WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Membership plan deleted successfully!";
    } else {
        $message = "Error deleting plan: " . $stmt->error;
    }
    $stmt->close();
}

// Handle the update of a membership plan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $yearly_equivalent = $_POST['yearly_equivalent'];

    // Prepare SQL statement
    $stmt = $conn->prepare("UPDATE membership_plans SET plan_name = ?, price = ?, duration = ?, description = ?, yearly_equivalent = ? WHERE id = ?");
    $stmt->bind_param("sddssi", $name, $price, $duration, $description, $yearly_equivalent, $id);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Membership plan updated successfully!";
    } else {
        $message = "Error updating plan: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all membership plans from the database
$plans = $conn->query("SELECT * FROM membership_plans");

// Fetch details of the membership plan to edit
$edit_plan = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM membership_plans WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_plan = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Membership Plans - Admin Panel</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex min-h-screen">

<!-- Include sidebar -->
<?php include('includes/sidebar.php'); ?>

<!-- Main content -->
<div class="flex-1 p-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-700">Available Membership Plans</h1>
    </div>

    <!-- Display success or error messages -->
    <?php if (isset($message)): ?>
        <div class="mb-4 p-4 rounded-lg <?= strpos($message, 'success') !== false ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <!-- Membership Plans Table -->
    <div class="bg-white p-8 rounded-lg shadow-lg mb-6">
        <table class="min-w-full text-left table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Plan Name</th>
                    <th class="px-4 py-2">Price (Rs)</th>
                    <th class="px-4 py-2">Duration</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Yearly Equivalent</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $plans->fetch_assoc()): ?>
                    <tr class="border-b">
                        <td class=" font-semibold px-4 py-6"><?= htmlspecialchars($row['plan_name']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['price']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['duration']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['description']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['yearly_equivalent']) ?></td>
                        <td class="px-4 py-2">
                            <a href="viewmembership.php?edit=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a> |
                            <a href="viewmembership.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this plan?')" class="text-red-500 hover:text-red-700">
                                <i class="fa-solid fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Plan Form -->
    <?php if ($edit_plan): ?>
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Edit Plan</h2>
            <form action="viewmembership.php" method="POST" class="space-y-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($edit_plan['id']) ?>">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Plan Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($edit_plan['plan_name']) ?>" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold">Price:</label>
                    <input type="number" id="price" name="price" value="<?= htmlspecialchars($edit_plan['price']) ?>" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="duration" class="block text-gray-700 font-semibold">Duration:</label>
                    <input type="text" id="duration" name="duration" value="<?= htmlspecialchars($edit_plan['duration']) ?>" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold">Description:</label>
                    <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded"><?= htmlspecialchars($edit_plan['description']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="yearly_equivalent" class="block text-gray-700 font-semibold">Yearly Equivalent:</label>
                    <input type="number" id="yearly_equivalent" name="yearly_equivalent" value="<?= htmlspecialchars($edit_plan['yearly_equivalent']) ?>" step="0.01" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="update" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">Update Plan</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<!-- Include Flowbite (optional) -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
