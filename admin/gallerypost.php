<?php
// admin/gallerypost.php

// Include database connection
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = '../uploads/' . $imageName; // Ensure the 'uploads' directory exists

        // Move the file to the uploads directory
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            // Prepare and execute SQL query
            $sql = "INSERT INTO gallery_posts (image_path, description) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $imageName, $description); // Store just the file name in the database

            if ($stmt->execute()) {
                $successMessage = "Gallery post added successfully.";
            } else {
                $errorMessage = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $errorMessage = "Failed to upload image.";
        }
    } else {
        $errorMessage = "No image uploaded or error occurred.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gallery Post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">


    <div class="flex">
    <?php include('includes/sidebar.php'); ?>
       
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold text-center mb-6">Add New Gallery Post</h1>
            <div class="flex justify-center">
                <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-6">
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

                    <form action="gallerypost.php" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="image" class="form-input w-full border-gray-300 rounded-lg bg-gray-50 text-gray-700 py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <textarea name="description" id="description" rows="4" class="form-textarea w-full border-gray-300 rounded-lg bg-gray-50 text-gray-700 py-2 px-3" required></textarea>
                        </div>

                        <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
