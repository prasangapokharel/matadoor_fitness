<?php
// Include database connection
include 'includes/db_connect.php';

$successMessage = ""; // Initialize success message variable

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $currency = $_POST['currency'];

    // Handle logo file upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $uploadDir = 'payments/';
        $logoFileName = basename($_FILES['logo']['name']);
        $logoFileTmp = $_FILES['logo']['tmp_name'];
        $logoFilePath = $uploadDir . $logoFileName;
        
        move_uploaded_file($logoFileTmp, $logoFilePath); // Move logo file to the designated folder
    }

    // Handle QR code file upload
    if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] == 0) {
        $qrFileName = basename($_FILES['qr_code']['name']);
        $qrFileTmp = $_FILES['qr_code']['tmp_name'];
        $qrFilePath = $uploadDir . $qrFileName;
        
        move_uploaded_file($qrFileTmp, $qrFilePath); // Move QR code file to the designated folder
    } else {
        $qrFileName = ''; // If no QR code is uploaded, leave it empty
    }

    // Insert payment method into the database
    $query = "INSERT INTO payment_methods (name, logo, currency, qr_code) VALUES ('$name', '$logoFileName', '$currency', '$qrFileName')";
    if (mysqli_query($conn, $query)) {
        // Set success message
        $successMessage = "Payment method added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- HTML code to display the success message and form as in the previous version -->


<!-- Display success message -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Method</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
<?php include('includes/sidebar.php'); ?>

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Add Payment Method</h2>

        <!-- Success Message -->
        <?php if ($successMessage): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline"><?php echo $successMessage; ?></span>
            </div>
        <?php endif; ?>

        <!-- Form to Add Payment Method -->
        <form action="save_payment_method.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
            <!-- Payment Method Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Payment Method Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <!-- Payment Logo -->
            <div class="mb-4">
                <label for="logo" class="block text-gray-700 font-medium">Payment Method Logo</label>
                <input type="file" id="logo" name="logo" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <!-- Currency -->
            <div class="mb-4">
                <label for="currency" class="block text-gray-700 font-medium">Currency</label>
                <select id="currency" name="currency" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="NPR">NPR</option>
                    <!-- Add more currencies as needed -->
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Payment Method</button>
            </div>
        </form>
    </div>
</body>
</html>
