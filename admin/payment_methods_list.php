<?php
// Include database connection
include 'includes/db_connect.php';

// Fetch all payment methods
$query = "SELECT * FROM payment_methods";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Methods List</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php include('includes/sidebar.php'); ?>

<body class="bg-gray-100 flex">
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Payment Methods</h2>

        <!-- Payment Methods Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="text-left py-3 px-4">Name</th>
                        <th class="text-left py-3 px-4">Logo</th>
                        <th class="text-left py-3 px-4">Currency</th>
                        <th class="text-left py-3 px-4">QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="py-3 px-4"><?php echo $row['name']; ?></td>
                            <td class="py-3 px-4">
                                <img src="payments/<?php echo $row['logo']; ?>" alt="<?php echo $row['name']; ?>" width="50">
                            </td>
                            <td class="py-3 px-4"><?php echo $row['currency']; ?></td>
                            <td class="py-3 px-4">
                                <!-- Button trigger modal -->
                                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="openModal('qrModal<?php echo $row['id']; ?>')">
                                    View QR Code
                                </button>

                                <!-- Modal for QR Code -->
                                <div id="qrModal<?php echo $row['id']; ?>" class="fixed z-10 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen">
                                        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
                                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                                                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeModal('qrModal<?php echo $row['id']; ?>')">&times;</button>
                                            </div>
                                            <div class="p-6">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">QR Code for <?php echo $row['name']; ?></h3>
                                                <div class="mt-4">
                                                    <?php if ($row['qr_code']): ?>
                                                        <img src="payments/<?php echo $row['qr_code']; ?>" alt="QR Code" class="w-full h-auto">
                                                    <?php else: ?>
                                                        <p>No QR code available.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3">
                                                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg" onclick="closeModal('qrModal<?php echo $row['id']; ?>')">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tailwind modal functionality using vanilla JS -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</body>
</html>
