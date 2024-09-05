<?php
include 'includes/db_connect.php';

if (isset($_POST['id'])) {
    $user_id = $_POST['id'];

    // Fetch user details
    $user_query = "SELECT gym_registrations.*, plans.name AS plan_name 
                   FROM gym_registrations 
                   LEFT JOIN plans ON gym_registrations.plan = plans.id 
                   WHERE gym_registrations.id = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Display user details
    echo "<form action='update_user.php' method='POST' class='space-y-4'>
            <input type='hidden' name='id' value='{$user['id']}' />

            <div>
                <label for='full_name' class='block text-sm font-medium text-gray-700'>Full Name</label>
                <input type='text' name='full_name' id='full_name' value='{$user['full_name']}' class='mt-1 block w-full border-gray-300 rounded-md shadow-sm'>
            </div>

            <div>
                <label for='email' class='block text-sm font-medium text-gray-700'>Email</label>
                <input type='email' name='email' id='email' value='{$user['email']}' class='mt-1 block w-full border-gray-300 rounded-md shadow-sm'>
            </div>

            <div>
                <label for='contact_number' class='block text-sm font-medium text-gray-700'>Phone</label>
                <input type='text' name='contact_number' id='contact_number' value='{$user['contact_number']}' class='mt-1 block w-full border-gray-300 rounded-md shadow-sm'>
            </div>

            <div>
                <label for='plan' class='block text-sm font-medium text-gray-700'>Plan</label>
                <select name='plan' id='plan' class='mt-1 block w-full border-gray-300 rounded-md shadow-sm'>
    ";

    // Fetch available plans for editing
    $plans_query = "SELECT id, name FROM plans";
    $plans_result = mysqli_query($conn, $plans_query);

    while ($plan_row = mysqli_fetch_assoc($plans_result)) {
        $selected = ($plan_row['id'] == $user['plan']) ? 'selected' : '';
        echo "<option value='{$plan_row['id']}' {$selected}>{$plan_row['name']}</option>";
    }

    echo "      </select>
            </div>

            <div>
                <label for='status' class='block text-sm font-medium text-gray-700'>Payment Status</label>
                <select name='status' id='status' class='mt-1 block w-full border-gray-300 rounded-md shadow-sm'>
                    <option value='paid' " . ($user['status'] == 'paid' ? 'selected' : '') . ">Paid</option>
                    <option value='unpaid' " . ($user['status'] == 'unpaid' ? 'selected' : '') . ">Unpaid</option>
                </select>
            </div>

            <div class='text-right'>
                <button type='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Save Changes</button>
            </div>
          </form>";
}
?>
