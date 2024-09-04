<?php
// admin/post.php

// Include database connection
include './includes/db_connect.php';

// Initialize variables
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the uploaded file and description
    $description = $conn->real_escape_string($_POST['description']);
    
    // File upload configuration
    $targetDir = "../uploads/";
    $imagePath = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imagePath;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate file upload
    if (!empty($imagePath)) {
        // Allow only certain file formats
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Insert post data into the database
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Post Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/7j4b4rymffricr4y79xgnplnw7k2uq46ssdxwgqelz67sl6n/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- TinyMCE Integration -->
    <script>
        tinymce.init({
            selector: '#description',  // Replace this CSS selector to match the textarea's ID
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            menubar: false,
            height: 300,
        });
    </script>
</head>

<body class="bg-gray-100">
<?php include('includes/sidebar.php'); ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10 mb-10">

    <h2 class="text-2xl font-bold mb-6">Create a New Event</h2>

    <?php if (!empty($errorMessage)) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $errorMessage; ?></div>
    <?php } ?>
    <?php if (!empty($successMessage)) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo $successMessage; ?></div>
    <?php } ?>

    <form action="post.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Event Image:</label>
            <input type="file" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Event Description:</label>
            <!-- Textarea with TinyMCE applied -->
            <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Post Event</button>
        </div>
    </form>
</div>

</body>
</html>
