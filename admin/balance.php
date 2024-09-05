<?php
// Database connection
include 'includes/db_connect.php';

// Query for total income (Paid)
$income_query = "SELECT SUM(plans.price) AS total_income
                 FROM gym_registrations
                 JOIN plans ON gym_registrations.plan = plans.name
                 WHERE gym_registrations.status = 'Paid'";
$income_result = mysqli_query($conn, $income_query);
$income_row = mysqli_fetch_assoc($income_result);
$total_income = $income_row['total_income'];

// Query for upcoming income (Unpaid)
$upcoming_query = "SELECT SUM(plans.price) AS upcoming_income
                   FROM gym_registrations
                   JOIN plans ON gym_registrations.plan = plans.name
                   WHERE gym_registrations.status = 'Unpaid'";
$upcoming_result = mysqli_query($conn, $upcoming_query);
$upcoming_row = mysqli_fetch_assoc($upcoming_result);
$upcoming_income = $upcoming_row['upcoming_income'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">
<div class="grid grid-cols-6 gap-4">
    <!-- Sidebar (1/6th width) -->
    <div class="col-span-1">
        <?php include('includes/sidebar.php'); ?>
    </div>

    <!-- Main Content (5/6th width) -->
    <div class="col-span-5 p-4">
        <h1 class="text-2xl font-semibold mb-4 flex items-center">
            <i class='bx bx-money text-green-500 mr-2'></i> Balance Overview
        </h1>

        <!-- Total Income Card -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-md mb-4 flex items-center">
            <i class='bx bx-wallet text-green-600 text-3xl mr-3'></i>
            <div>
                <h2 class="text-xl font-medium">Total Income</h2>
                <p class="text-2xl font-bold text-green-600">Rs. <?php echo number_format($total_income ?? 0); ?></p>
            </div>
        </div>

        <!-- Upcoming Income Card -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-md flex items-center">
            <i class='bx bx-time-five text-red-600 text-3xl mr-3'></i>
            <div>
                <h2 class="text-xl font-medium">Upcoming Income</h2>
                <p class="text-2xl font-bold text-red-600">Rs. <?php echo number_format($upcoming_income ?? 0); ?></p>
            </div>
        </div>

        <!-- Income Chart -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Income Overview Chart</h3>
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
</div>

    <!-- Chart Script -->
    <script>
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var incomeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Income', 'Upcoming Income'],
                datasets: [{
                    label: 'Income (Rs)',
                    data: [<?php echo $total_income ?? 0; ?>, <?php echo $upcoming_income ?? 0; ?>],
                    backgroundColor: ['#10B981', '#EF4444'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
