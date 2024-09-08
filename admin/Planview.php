<?php
// Include database connection
include 'includes/db_connect.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    // Prepare and execute SQL delete query
    $sql = "DELETE FROM plans WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        $successMessage = "Plan deleted successfully.";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// Fetch plans from the database
$sql = "SELECT id, name, price, duration FROM plans";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Plans</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="container mx-auto">
                <h1 class="text-3xl font-bold text-center mb-6">Available Plans</h1>
                
                <?php if (isset($successMessage)) { ?>
                    <div class="mb-4 p-4 bg-green-200 text-green-800 border border-green-300 rounded">
                        <?php echo $successMessage; ?>
                    </div>
                <?php } ?>
                <?php if (isset($errorMessage)) { ?>
                    <div class="mb-4 p-4 bg-red-200 text-red-800 border border-red-300 rounded">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php } ?>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg">
                        <thead>
                            <tr class="w-full bg-gray-200 border-b border-gray-300">
                                <th class="py-3 px-6 text-left text-gray-600">Name</th>
                                <th class="py-3 px-6 text-left text-gray-600">Price</th>
                                <th class="py-3 px-6 text-left text-gray-600">Duration</th>
                                <th class="py-3 px-6 text-left text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) { 
                                while($row = $result->fetch_assoc()) { ?>
                                    <tr class="border-b border-gray-300">
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($row['price']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($row['duration']); ?></td>
                                        <td class="py-3 px-6">
                                            <a href="?delete_id=<?php echo $row['id']; ?>" 
                                               class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" 
                                               onclick="return confirm('Are you sure you want to delete this plan?');">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="4" class="py-3 px-6 text-center text-gray-600">No plans available</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
