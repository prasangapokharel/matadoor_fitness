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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="container mx-auto">
                <h1 class="text-3xl font-bold text-center mb-6">Add New Gallery Post</h1>
                <div class="flex justify-center">
                    <div class="w-full max-w-3xl bg-white shadow-md rounded-lg p-6">
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
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload image</label>
                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">We accept image format which must be in .jpg .png .jpeg</div>

                        </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                                <textarea name="description" id="description" rows="4" class="form-textarea w-full border-gray-300 rounded-lg bg-gray-50 text-gray-700 py-2 px-3" required></textarea>
                            </div>

                            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 w-full">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
