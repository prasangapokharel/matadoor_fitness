<!-- admin/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Include ApexCharts -->
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css"
>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Include hs-apexcharts-helpers.js -->
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>
</head>
<body class="bg-gray-100 flex">

<?php include('includes/sidebar.php'); ?>


<!-- Main Content -->
<div class="flex-1 p-6">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
    </div>

    <!-- Dashboard Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card for Users Count -->
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <h5 class="text-lg font-medium">Users</h5>
                    <h2 class="text-4xl font-bold mt-2">
                        <?php
                        // Include database connection
                        include 'includes/db_connect.php';

                        // Fetch users count from the database
                        $query = "SELECT COUNT(*) as count FROM gym_registrations"; // Updated table name
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['count'];
                        ?>
                    </h2>
                </div>
                <div>
                    <i class="fa fa-users fa-3x"></i>
                </div>
            </div>
            <a href="users.php" class="text-white mt-4 block text-sm">View Details <i class="fa fa-angle-right"></i></a>
        </div>

        <!-- Card for Contact Messages Count -->
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <h5 class="text-lg font-medium">Contact Messages</h5>
                    <h2 class="text-4xl font-bold mt-2">
                        <?php
                        // Fetch contact messages count from the database
                        $query = "SELECT COUNT(*) as count FROM contacts";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['count'];
                        ?>
                    </h2>
                </div>
                <div>
                    <i class="fa fa-envelope fa-3x"></i>
                </div>
            </div>
            <a href="contact.php" class="text-white mt-4 block text-sm">View Details <i class="fa fa-angle-right"></i></a>
        </div>

        <!-- Add more cards here for additional metrics -->
    </div>

  

</div>

<script src="js/chart.js">

</script>
</body>
</html>
