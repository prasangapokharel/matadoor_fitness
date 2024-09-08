<?php
// event.php

// Include database connection
include 'includes/db_connect.php';

// Fetch events from the database
$sql = "SELECT id, image_path, description FROM events ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/scroll.css">

</head>
<body class="bg-gray-100">

<?php include 'includes/navbar.php'; ?>

<!-- Showcase Section -->
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Upcoming Events</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <?php if (!empty($row['image_path'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['image_path']); ?>" alt="Event Image" class="w-full h-48 object-cover">
                    <?php endif; ?>
                    <div class="p-6">
                        <!-- Ensure that the description is rendered as HTML -->
                        <div class="text-gray-700 mb-4">
                            <?php echo $row['description']; // Directly output the description ?>
                        </div>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="text-blue-500 hover:underline">Read More</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No events available.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
