<?php
include 'includes/db_connect.php';

// Function to get visit count for a specific time range
function getVisitCount($conn, $interval) {
    $sql = "SELECT COUNT(*) AS visit_count FROM visit_logs WHERE visit_time >= NOW() - INTERVAL $interval";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['visit_count'];
}

$totalVisits24Hours = getVisitCount($conn, '1 DAY');
$totalVisits3Days = getVisitCount($conn, '3 DAY');
$totalVisitsWeek = getVisitCount($conn, '7 DAY');
$totalVisitsMonth = getVisitCount($conn, '1 MONTH');
$totalVisitsYear = getVisitCount($conn, '1 YEAR');

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex ">

    <!-- Sidebar -->
    <?php include('includes/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="container mx-auto p-6 flex-grow">
        <h1 class="text-4xl font-extrabold mb-6 text-gray-800">Analytics Dashboard</h1>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800">Last 24 Hours</h2>
                <p class="text-3xl font-extrabold text-green-500"><?php echo $totalVisits24Hours; ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800">Last 3 Days</h2>
                <p class="text-3xl font-extrabold text-green-500"><?php echo $totalVisits3Days; ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800">Last Week</h2>
                <p class="text-3xl font-extrabold text-green-500"><?php echo $totalVisitsWeek; ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800">Last Month</h2>
                <p class="text-3xl font-extrabold text-green-500"><?php echo $totalVisitsMonth; ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800">Last Year</h2>
                <p class="text-3xl font-extrabold text-green-500"><?php echo $totalVisitsYear; ?></p>
            </div>
        </div>

        <!-- Visit Statistics Graph -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-extrabold mb-4 text-gray-800">Visit Statistics</h2>
            <canvas id="visitStatsChart"></canvas>
        </div>
    </div>

    <!-- Footer -->

    <script>
        // Data for the chart
        const visitData = {
            labels: ['Last 24 Hours', 'Last 3 Days', 'Last Week', 'Last Month', 'Last Year'],
            datasets: [{
                label: 'Number of Visits',
                data: [<?php echo $totalVisits24Hours; ?>, <?php echo $totalVisits3Days; ?>, <?php echo $totalVisitsWeek; ?>, <?php echo $totalVisitsMonth; ?>, <?php echo $totalVisitsYear; ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configuration options for the chart
        const config = {
            type: 'bar',
            data: visitData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Render the chart
        const visitStatsChart = new Chart(
            document.getElementById('visitStatsChart'),
            config
        );
    </script>
</body>
</html>
