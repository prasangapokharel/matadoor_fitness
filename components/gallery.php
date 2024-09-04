<?php
// components/gallery.php

// Include database connection
include './admin/includes/db_connect.php';

// Check if connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch gallery posts from the database
$sql = "SELECT image_path, description FROM gallery_posts";
$result = $conn->query($sql);

?>

<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 >What's Available?</h2>
            <p class="mt-4 text-lg leading-6 text-gray-600">Explore our gym facilities and see where you will transform your body and mind.</p>
        </div>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $imagePath = htmlspecialchars($row['image_path']);
                    $description = htmlspecialchars($row['description']);
            ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="./uploads/<?php echo $imagePath; ?>" alt="Gallery Image" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <p class="text-gray-700"><?php echo $description; ?></p>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="text-center text-gray-500">No gallery posts available.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>
