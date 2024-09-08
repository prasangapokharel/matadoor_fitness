<?php
// edit_event.php

include 'includes/session.php';
include 'includes/db_connect.php';

// Initialize variables
$errorMessage = "";
$successMessage = "";
$event = null;

// Check if an event ID is provided
if (isset($_GET['id'])) {
    $eventId = intval($_GET['id']);

    // Fetch the event data
    $sql = "SELECT * FROM events WHERE id = $eventId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        $errorMessage = "Event not found.";
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $description = $conn->real_escape_string($_POST['description']);
        $newImagePath = $event['image_path']; // Keep the old image path

        // File upload configuration
        $targetDir = "../uploads/";
        if (!empty($_FILES["image"]["name"])) {
            $imagePath = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $imagePath;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Validate file upload
            $allowedTypes = array("jpg", "jpeg", "png", "gif", "mp4");
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $newImagePath = $imagePath; // Update image path if new image is uploaded
                } else {
                    $errorMessage = "There was an error uploading the file.";
                }
            } else {
                $errorMessage = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        }

        // Update the event data
        if (empty($errorMessage)) {
            $sql = "UPDATE events SET image_path = '$newImagePath', description = '$description' WHERE id = $eventId";
            if ($conn->query($sql) === TRUE) {
                $successMessage = "Event updated successfully.";
            } else {
                $errorMessage = "Error updating event: " . $conn->error;
            }
        }
    }

} else {
    $errorMessage = "No event ID provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    <h2 class="text-2xl font-bold mb-6">Edit Event</h2>

    <?php if (!empty($errorMessage)) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php } ?>
    <?php if (!empty($successMessage)) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php } ?>

    <?php if ($event) { ?>
        <form action="edit_event.php?id=<?php echo $event['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Event Image:</label>
                <input type="file" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <img src="../uploads/<?php echo htmlspecialchars($event['image_path']); ?>" alt="Event Image" class="mt-2 w-20 h-20 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Event Description:</label>
                <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($event['description']); ?></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Event</button>
            </div>
        </form>
    <?php } ?>
</div>

</body>
</html>
