<?php
// admin/edit_event.php

// Include database connection
include '../includes/db_connect.php';

// Initialize variables
$errorMessage = "";
$successMessage = "";

// Check if an event ID is provided
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Fetch event details from the database
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if (!$event) {
        $errorMessage = "Event not found.";
    }
} else {
    header("Location: post.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated description
    $description = $conn->real_escape_string($_POST['description']);
    
    // File upload configuration
    $targetDir = "../uploads/";
    $imagePath = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imagePath;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    // Update event details
    if (!empty($imagePath)) {
        // Allow only certain file formats
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Update event data in the database
                $sql = "UPDATE events SET image_path = ?, description = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $imagePath, $description, $eventId);
                if ($stmt->execute()) {
                    $successMessage = "Event updated successfully.";
                } else {
                    $errorMessage = "Error updating event: " . $conn->error;
                }
            } else {
                $errorMessage = "There was an error uploading the file.";
            }
        } else {
            $errorMessage = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        // Update only description if no new image is uploaded
        $sql = "UPDATE events SET description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $description, $eventId);
        if ($stmt->execute()) {
            $successMessage = "Event updated successfully.";
        } else {
            $errorMessage = "Error updating event: " . $conn->error;
        }
    }

    // Refresh the event details after update
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="js/md.js"></script>

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

<body class="bg-gray-100 flex">
<?php include('../includes/sidebar.php'); ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10 mb-10">

    <h2 class="text-2xl font-bold mb-6">Edit Event</h2>

    <?php if (!empty($errorMessage)) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $errorMessage; ?></div>
    <?php } ?>
    <?php if (!empty($successMessage)) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo $successMessage; ?></div>
    <?php } ?>

    <form action="edit_event.php?id=<?php echo $eventId; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Event Image:</label>
            <input type="file" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <img src="../uploads/<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image" class="mt-4 w-20 h-20 rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Event Description:</label>
            <!-- Textarea with TinyMCE applied -->
            <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Event</button>
        </div>
    </form>
</div>

</body>
</html>
