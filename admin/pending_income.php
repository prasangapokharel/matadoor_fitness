<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Income</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex">

<?php include('includes/sidebar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-6">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold">Pending Income</h1>
    </div>

    <!-- Table for Pending Income -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Users with Pending Payments</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Full Name</th>
                    <th class="py-2 px-4 border-b">Amount to be Paid</th>
                    <th class="py-2 px-4 border-b">Phone Number</th>
                </tr>
            </thead>
            <tbody>
            <?php
// Database connection
include 'includes/db_connect.php';

// SQL query to fetch pending income information
$sql = "
SELECT 
    gr.full_name AS 'Full Name', 
    p.price AS 'Amount to be Paid', 
    gr.contact_number AS 'Phone Number'
FROM 
    gym_registrations gr
JOIN 
    plans p ON gr.plan_id = p.id
WHERE 
    gr.status = 'Unpaid' AND gr.membership_type = 'monthly'
";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>Full Name</th>
                <th>Amount to be Paid</th>
                <th>Phone Number</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Full Name"]. "</td>
                <td>" . $row["Amount to be Paid"]. "</td>
                <td>" . $row["Phone Number"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$mysqli->close();
?>

            </tbody>
        </table>
    </div>
</div>

</body>
</html>
