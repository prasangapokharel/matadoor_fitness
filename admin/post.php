<?php
// create_event.php

include 'includes/session.php';
include 'includes/db_connect.php';

// Initialize variables
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $conn->real_escape_string($_POST['description']);
    
    // File upload configuration
    $targetDir = "../uploads/";
    $imagePath = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imagePath;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate file upload
    if (!empty($imagePath)) {
        $allowedTypes = array("jpg", "jpeg", "png", "gif", "mp4");
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $sql = "INSERT INTO events (image_path, description) VALUES ('$imagePath', '$description')";
                if ($conn->query($sql) === TRUE) {
                    $successMessage = "Event posted successfully.";
                } else {
                    $errorMessage = "Error posting event: " . $conn->error;
                }
            } else {
                $errorMessage = "There was an error uploading the file.";
            }
        } else {
            $errorMessage = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        $errorMessage = "Please select an image to upload.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/7j4b4rymffricr4y79xgnplnw7k2uq46ssdxwgqelz67sl6n/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            menubar: false,
            height: 300,
        });
    </script>
</head>
<body class="bg-gray-100 flex">
<?php include('includes/sidebar.php'); ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10 mb-10">
    <h2 class="text-2xl font-bold mb-6">Create a New Event</h2>

    <?php if (!empty($errorMessage)) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php } ?>
    <?php if (!empty($successMessage)) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php } ?>

    <form action="post.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Event Image:</label>
            <input type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">We accept image format which must be in .jpg .png .jpeg</div>

        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Event Description:</label>
            <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 w-full">Post Event</button>
        </div>
    </form>
</div>

</body>
</html>
