<?php include 'includes/session.php'; ?>

<?php
// Include database connection
include 'includes/db_connect.php';

$error_message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $plan_id = mysqli_real_escape_string($conn, $_POST['plan']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $emergency_phone = mysqli_real_escape_string($conn, $_POST['emergency_phone']);
    $fitness_level = mysqli_real_escape_string($conn, $_POST['fitness_level']);
    $health_conditions = mysqli_real_escape_string($conn, $_POST['health_conditions']);
    $referral_source = mysqli_real_escape_string($conn, $_POST['referral_source']);

    // Fetch plan details from the database
    $planQuery = "SELECT name, duration FROM plans WHERE id = ?";
    $stmt = $conn->prepare($planQuery);
    $stmt->bind_param("i", $plan_id);
    $stmt->execute();
    $planResult = $stmt->get_result();
    $plan = $planResult->fetch_assoc();
    $stmt->close();

    if ($plan) {
        $plan_name = $plan['name'];
        $duration = $plan['duration'];

        // Insert user into the database with the plan name and duration
        $query = "INSERT INTO gym_registrations (full_name, email, contact_number, plan_name, plan_id, status, dob, gender, emergency_phone, fitness_level, health_conditions, referral_source, duration) 
                  VALUES ('$full_name', '$email', '$contact_number', '$plan_name', '$plan_id', '$status', '$dob', '$gender', '$emergency_phone', '$fitness_level', '$health_conditions', '$referral_source', '$duration')";

        if (mysqli_query($conn, $query)) {
            // Redirect back to users page with success message
            header('Location: users.php?message=User added successfully');
            exit;
        } else {
            // Display error message
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Invalid plan selected.";
    }
}

// Fetch plans for the form
$plansQuery = "SELECT id, name FROM plans";
$plansResult = mysqli_query($conn, $plansQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <!-- Include Sidebar -->
    <?php include('includes/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="flex-1 p-9 flex items-center justify-center w-5/6">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full">
            <h2 class="text-2xl font-semibold mb-4">Add New User</h2>
            
            <?php if ($error_message): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="POST">
                <!-- User Information -->
                <fieldset class="mb-4">
                    <legend class="text-lg font-semibold mb-2">User Information</legend>
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full px-2 mb-4">
                            <label for="full_name" class="block text-gray-700">Full Name</label>
                            <input type="text" id="full_name" name="full_name" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="contact_number" class="block text-gray-700">Phone</label>
                            <input type="text" id="contact_number" name="contact_number" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="dob" class="block text-gray-700">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="gender" class="block text-gray-700">Gender</label>
                            <select id="gender" name="gender" class="w-full p-2 border rounded" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <!-- Plan Information -->
                <fieldset class="mb-4">
                    <legend class="text-lg font-semibold mb-2">Plan Information</legend>
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full px-2 mb-4">
                            <label for="plan" class="block text-gray-700">Plan</label>
                            <select id="plan" name="plan" class="w-full p-2 border rounded" required>
                                <?php while ($row = mysqli_fetch_assoc($plansResult)): ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="status" class="block text-gray-700">Status</label>
                            <select id="status" name="status" class="w-full p-2 border rounded">
                                <option value="Unpaid">Unpaid</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <!-- Additional Information -->
                <fieldset class="mb-4">
                    <legend class="text-lg font-semibold mb-2">Additional Information</legend>
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full px-2 mb-4">
                            <label for="emergency_phone" class="block text-gray-700">Emergency Phone</label>
                            <input type="text" id="emergency_phone" name="emergency_phone" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="fitness_level" class="block text-gray-700">Fitness Level</label>
                            <select id="fitness_level" name="fitness_level" class="w-full p-2 border rounded" required>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="health_conditions" class="block text-gray-700">Health Conditions</label>
                            <textarea id="health_conditions" name="health_conditions" class="w-full p-2 border rounded"></textarea>
                        </div>
                        <div class="w-full px-2 mb-4">
                            <label for="referral_source" class="block text-gray-700">Referral Source</label>
                            <input type="text" id="referral_source" name="referral_source" class="w-full p-2 border rounded" required>
                        </div>
                    </div>
                </fieldset>

                <div class="text-center">
                    <button type="submit" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Add User</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
