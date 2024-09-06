<?php
// Initialize $successMessage to prevent undefined variable warning
$successMessage = ""; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Method</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php include('includes/sidebar.php'); ?>

<body class="bg-gray-100 flex">
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

            <!-- QR Code Upload -->
            <div class="mb-4">
                <label for="qr_code" class="block text-gray-700 font-medium">QR Code</label>
                <input type="file" id="qr_code" name="qr_code" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Payment Method</button>
            </div>
        </form>
    </div>
</body>
</html>
