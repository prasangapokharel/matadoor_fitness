<?php include 'includes/session.php'; ?>

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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

        body{
            font-family: 'Barlow', sans-serif; /* Apply Barlow font globally */

        }
        .search-suggestion {
            border: 1px solid #ddd;
            border-radius: 4px;
            position: absolute;
            background: white;
            z-index: 10;
            max-height: 200px;
            overflow-y: auto;
            width: calc(100% - 2rem);
        }
        .search-suggestion div {
            padding: 8px;
            cursor: pointer;
        }
        .search-suggestion div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-gray-100 flex">
<?php include('includes/full.php'); ?>

<?php include('includes/sidebar.php'); ?>

<div class="flex-1 p-6 relative">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Users</h1>
        <!-- New Admission Button -->
        <a href="add_user.php" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 flex"> New Admission</a>
    </div>

    <!-- Search Bar -->
    <div class="relative mb-4">
        
        <input id="search-bar" type="text" placeholder="Search Users..." class="w-full px-4 py-4 border rounded-full shadow-md">
        <div id="suggestions" class="search-suggestion hidden"></div>
    </div>
   

    <!-- Users Table -->
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <table id="users-table" class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600">
                <tr>

                    <th class="py-3 px-6 border-b">Name</th>
                    <th class="py-3 px-6 border-b">Email</th>
                    <th class="py-3 px-6 border-b">Phone</th>
                    <th class="py-3 px-6 border-b">Plan</th>
                    <th class="py-3 px-6 border-b">Status</th>
                    <th class="py-3 px-6 border-b">Duration</th>
                    <th class="py-3 px-6 border-b">Registration Date</th>
                    <th class="py-3 px-6 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="users-body" class="text-gray-600">
                <?php
                // Include database connection
                include 'includes/db_connect.php';

                // Fetch users with their respective plans and calculate duration status
                $query = "
                    SELECT gym_registrations.id, gym_registrations.full_name, gym_registrations.email, gym_registrations.contact_number, gym_registrations.status, gym_registrations.created_at, plans.name AS plan_name,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, gym_registrations.created_at, NOW()) >= plans.duration THEN 'Expired'
                            ELSE plans.duration - TIMESTAMPDIFF(HOUR, gym_registrations.created_at, NOW())
                        END AS duration_status
                    FROM gym_registrations
                    LEFT JOIN plans ON gym_registrations.plan_id = plans.id
                ";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    // Display duration or status
                    $duration = $row['duration_status'];
                    $durationDisplay = $duration === 'Expired' ? 'Expired' : $duration . ' Days';

                    // Format registration date
                    $registrationDate = date('Y-m-d', strtotime($row['created_at']));

                    echo "<tr data-name='{$row['full_name']}' data-id='{$row['id']}'>


                            <td class='font-semibold py-4 px-4 border-b'>{$row['full_name']}</td>
                            <td class='py-3 px-6 border-b'>{$row['email']}</td>
                            <td class='py-3 px-6 border-b'>{$row['contact_number']}</td>
                            <td class='py-3 px-6 border-b'>{$row['plan_name']}</td>
                            <td class='py-3 px-6 border-b'>{$row['status']}</td>
                            <td class='py-3 px-6 border-b'>{$durationDisplay}</td>
                            <td class='py-3 px-6 border-b'>{$registrationDate}</td>
                            <td class='py-3 px-6 border-b'>
                                <a href='client.php?id={$row['id']}' class='text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>View</a>
                            </td>
                        </tr>";
                }

                // Close the connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search-bar').on('input', function() {
            let query = $(this).val().toLowerCase();
            let suggestions = $('#suggestions');
            let usersTableRows = $('#users-body tr');
            
            suggestions.empty().hide(); // Hide suggestions initially

            if (query.length > 0) {
                usersTableRows.each(function() {
                    let name = $(this).data('name').toLowerCase();
                    if (name.includes(query)) {
                        // Show matching row
                        $(this).show();
                        // Append suggestion item
                        suggestions.append(`<div data-id="${$(this).data('id')}">${$(this).find('td').eq(0).text()}</div>`);
                    } else {
                        // Hide non-matching row
                        $(this).hide();
                    }
                });

                if (suggestions.children().length > 0) {
                    suggestions.show();
                }
            } else {
                usersTableRows.show(); // Show all rows if query is empty
            }
        });

        $(document).on('click', '#suggestions div', function() {
            let rowId = $(this).data('id');
            let rowToScroll = $(`#users-body tr[data-id="${rowId}"]`);
            if (rowToScroll.length) {
                rowToScroll.get(0).scrollIntoView({ behavior: 'smooth' });
                $('#search-bar').val($(this).text());
                $('#suggestions').hide();
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search-bar, #suggestions').length) {
                $('#suggestions').hide();
            }
        });
    });
</script>

</body>
</html>
