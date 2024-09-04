<!-- admin/users.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Panel</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-gray-100 flex">

<?php include('includes/sidebar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-6">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Users</h1>
        <!-- New Admission Button -->
        <button id="newAdmissionBtn" class="bg-green-500 text-white px-4 py-2 rounded">New Admission</button>
    </div>

    <!-- Users Table -->
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Plan</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Days Left</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                <?php
                // Include database connection
                include 'includes/db_connect.php';

                // Fetch users from the database
                $query = "SELECT id, full_name, email, contact_number, plan, status, DATEDIFF(end_date, CURDATE()) AS days_left FROM gym_registrations";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    // Display each user with days left
                    echo "<tr>
                            <td class='py-2 px-4 border-b'>{$row['full_name']}</td>
                            <td class='py-2 px-4 border-b'>{$row['email']}</td>
                            <td class='py-2 px-4 border-b'>{$row['contact_number']}</td>
                            <td class='py-2 px-4 border-b'>{$row['plan']}</td>
                            <td class='py-2 px-4 border-b'>{$row['status']}</td>
                            <td class='py-2 px-4 border-b'>" . ($row['days_left'] > 0 ? $row['days_left'] . " days" : "Expired") . "</td>
                            <td class='py-2 px-4 border-b'>
                                <button class='bg-blue-500 text-white px-4 py-1 rounded view-btn' data-id='{$row['id']}'>View</button>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Adding New User -->
<div id="newAdmissionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="text-right">
                <button class="text-gray-500 hover:text-gray-800 close-modal">&times;</button>
            </div>
            <h2 class="text-xl font-bold mb-4">New Admission</h2>
            <form id="newAdmissionForm" action="add_user.php" method="POST">
                <div class="mb-4">
                    <label for="full_name" class="block text-gray-700">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="contact_number" class="block text-gray-700">Phone</label>
                    <input type="text" id="contact_number" name="contact_number" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="plan" class="block text-gray-700">Plan</label>
                    <select id="plan" name="plan" class="w-full p-2 border rounded" required>
                        <option value="Monthly">Monthly - 1,500 Rs</option>
                        <option value="6 Month">6 Month - 5,000 Rs</option>
                        <option value="Yearly">Yearly - 10,000 Rs</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full p-2 border rounded">
                        <option value="Unpaid">Unpaid</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Viewing User Details -->
<div id="userModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="text-right">
                <button class="text-gray-500 hover:text-gray-800 close-modal">&times;</button>
            </div>
            <h2 class="text-xl font-bold mb-4">User Details</h2>
            <div id="userDetails">
                <!-- User details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Show modal on 'View' button click
    $('.view-btn').on('click', function() {
        var userId = $(this).data('id');

        // Fetch user details using AJAX
        $.ajax({
            url: 'get_user_details.php',
            method: 'POST',
            data: {id: userId},
            success: function(response) {
                $('#userDetails').html(response);
                $('#userModal').removeClass('hidden');
            }
        });
    });

    // Show modal on 'New Admission' button click
    $('#newAdmissionBtn').on('click', function() {
        $('#newAdmissionModal').removeClass('hidden');
    });

    // Close modal
    $('.close-modal').on('click', function() {
        $('#userModal').addClass('hidden');
        $('#newAdmissionModal').addClass('hidden');
    });
});
</script>

</body>
</html>
