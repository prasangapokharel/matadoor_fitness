<?php
// get_user_details.php

include 'includes/db_connect.php';

if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Fetch user details
    $query = "SELECT * FROM gym_registrations WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        ?>
        <form action="update_user.php" method="post" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $user['full_name']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="plan" class="block text-sm font-medium text-gray-700">Plan</label>
                <select name="plan" id="plan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="monthly" <?php echo ($user['plan'] == 'monthly') ? 'selected' : ''; ?>>Monthly - 1,500 Rs</option>
                    <option value="6 months" <?php echo ($user['plan'] == '6 months') ? 'selected' : ''; ?>>6 Months - 5,000 Rs</option>
                    <option value="yearly" <?php echo ($user['plan'] == 'yearly') ? 'selected' : ''; ?>>Yearly - 10,000 Rs</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="paid" <?php echo ($user['status'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                    <option value="unpaid" <?php echo ($user['status'] == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Changes</button>
            </div>
        </form>
        <?php
    } else {
        echo "<p>User not found.</p>";
    }
}
?>
