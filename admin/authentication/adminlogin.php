<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: ../index.php"); // Redirect to admin index page
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with actual admin credentials
    $admin_username = 'admin';
    $admin_password = 'password';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ../index.php"); // Redirect to admin index page
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }
        
        /* Create a pseudo-element for background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #fff;
            background-size: cover;
           
            z-index: -1; /* Make sure it stays behind the content */
        }
    </style>
</head>
<body class="h-14 bg-gradient-to-r from-cyan-500 to-blue-500 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Admin Login</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="mt-6">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold">Username</label>
                <input type="text" id="username" name="username" class="w-full p-3 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</body>
</html>
