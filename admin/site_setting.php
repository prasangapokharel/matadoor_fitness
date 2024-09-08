<?php include 'includes/session.php'; ?>

<?php
// Include your database connection
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_title = $_POST['site_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];

    // Check if settings already exist
    $query = "SELECT * FROM site_settings WHERE id = 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update existing settings
        $sql = "UPDATE site_settings SET site_title = '$site_title', meta_description = '$meta_description', meta_keywords = '$meta_keywords' WHERE id = 1";
    } else {
        // Insert new settings
        $sql = "INSERT INTO site_settings (site_title, meta_description, meta_keywords) VALUES ('$site_title', '$meta_description', '$meta_keywords')";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Settings updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating settings: " . mysqli_error($conn) . "');</script>";
    }
}
?>


<?php include('includes/sidebar.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

<body class="bg-gray-100 flex">
<!-- Success Modal -->
<div id="successModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <h3 class="text-lg leading-6 font-medium text-green-700">
                Settings updated successfully!
            </h3>
            <div class="mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeModal('successModal')">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-6">
    <form method="POST" action="" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Update Site Settings</h2>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="site_title">
                Site Title:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="site_title" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="meta_description">
                Meta Description:
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="meta_description" rows="3" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="meta_keywords">
                Meta Keywords (comma-separated):
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="meta_keywords" rows="3" required></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 w-full" type="submit">
                Save Settings
            </button>
        </div>
    </form>
</div>

<script src="js/popup.js">
</body>
