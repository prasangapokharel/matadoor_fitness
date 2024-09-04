<!-- admin/contact.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts - Admin Panel</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

<?php include('includes/sidebar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-6">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold">Contact Messages</h1>
    </div>

    <!-- Contacts Table -->
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Message</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                <?php
                // Include database connection
                include 'includes/db_connect.php';

                // Fetch contacts from the database
                $query = "SELECT name, email, phone, message FROM contacts";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td class='py-2 px-4 border-b'>{$row['name']}</td>
                            <td class='py-2 px-4 border-b'>{$row['email']}</td>
                            <td class='py-2 px-4 border-b'>{$row['phone']}</td>
                            <td class='py-2 px-4 border-b'>{$row['message']}</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
