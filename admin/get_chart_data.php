<!-- get_chart_data.php -->
<?php
header('Content-Type: application/json');
include 'includes/db_connect.php';

// Query to fetch chart data
$query = "SELECT date, count FROM user_growth"; // Replace with your actual query
$result = mysqli_query($conn, $query);

$data = [
    'labels' => [],
    'values' => []
];

while ($row = mysqli_fetch_assoc($result)) {
    $data['labels'][] = $row['date'];
    $data['values'][] = (int) $row['count'];
}

echo json_encode($data);
?>
