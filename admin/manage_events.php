<?php
// manage_events.php

include 'includes/session.php';
include 'includes/db_connect.php';

// Fetch existing events from the database
$sql = "SELECT * FROM events ORDER BY created_at DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        /* Additional styling for the table */
        table {
            width: 100%;
            table-layout: auto;
        }
        .event-image {
            width: 100px; /* Adjust as needed */
            height: 100px; /* Adjust as needed */
            object-fit: cover;
            border-radius: 8px; /* Optional: add rounded corners */
        }
    </style>
</head>
<body class="bg-gray-100 flex">
<?php include('includes/sidebar.php'); ?>

<div class="flex-1 p-6    mt-10 mb-10">
    <h2 class="text-2xl font-bold mb-6">Manage Events</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full  border border-gray-200 rounded-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300">Image</th>
                    <th class="py-2 px-4 border-b border-gray-300">Description</th>
                    <th class="py-2 px-4 border-b border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if ($result && $result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="border-t border-gray-300">
                            <td class="py-2 px-4">
                                <img src="../uploads/<?php echo htmlspecialchars($row['image_path']); ?>" alt="Event Image" class="event-image">
                            </td>
                            <td class="py-2 px-4">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </td>
                            <td class="py-2 px-4">
                                <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="text-blue-500 hover:text-blue-700">Edit</a> | 
                                <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center py-4">No events found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
