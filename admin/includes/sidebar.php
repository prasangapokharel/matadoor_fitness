<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <style>
        /* Sidebar hidden by default on small screens */
        .sidebar-hidden {
            transform: translateX(-100%);
        }
    </style>
</head>
<body class="bg-gray-100 flex">
    <!-- Toggle Button -->
    <button id="toggle-btn" class="p-3 bg-black-700 text-gray rounded-full fixed top-10 left-20 z-90">
        <i class="bx bx-menu"></i>
    </button>

    <div id="sidebar" class="min-h-screen flex flex-row bg-gray-100 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col w-56 bg-white rounded-r-3xl shadow-md overflow-hidden">
            <div class="flex items-center justify-center h-20 shadow-md" style="background-color: #000;">
                <img src="./image/logo.png" class="w-12 h-12 mr-2 rounded-full" alt="Logo">
                <h1 style="font-weight: bolder;" class="text-2xl uppercase text-white">Matadoor</h1>
            </div>
            <div class="flex flex-col py-4 space-y-2">
                <!-- Dashboard Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Dashboard</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="index.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                                <span class="text-sm font-medium">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Users Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Users</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="users.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-group"></i></span>
                                <span class="text-sm font-medium">Users</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Gallery Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Gallery</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="gallerypost.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-image"></i></span>
                                <span class="text-sm font-medium">Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a href="membership_add.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-id-card"></i></span>
                                <span class="text-sm font-medium">Membership</span>
                            </a>
                        </li>
                        <li>
                            <a href="viewmembership.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-edit"></i></span>
                                <span class="text-sm font-medium">View</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Posts Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Posts</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="post.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-pencil"></i></span>
                                <span class="text-sm font-medium">New Post</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage_events.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-edit"></i></span>
                                <span class="text-sm font-medium">Manage Post</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Plan Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Plans</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="plan.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-calendar"></i></span>
                                <span class="text-sm font-medium">Create Plan</span>
                            </a>
                        </li>
                        <li>
                            <a href="Planview.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-list-ul"></i></span>
                                <span class="text-sm font-medium">Available Plans</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Balance Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Finance</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="balance.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-wallet"></i></span>
                                <span class="text-sm font-medium">Balance</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Payment Methods Section -->
                <div class="px-4">
                    <h2 class="text-xs font-semibold text-gray-600 uppercase">Payment Methods</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="add_payment_method.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-credit-card"></i></span>
                                <span class="text-sm font-medium">Methods</span>
                            </a>
                        </li>
                        <li>
                            <a href="payment_methods_list.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-list-ul"></i></span>
                                <span class="text-sm font-medium">Payment Options</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Logout Section -->
                <div class="px-4">
                    <ul class="space-y-1">
                        <li>
                            <a href="logout.php" class="flex items-center h-12 px-4 text-gray-500 hover:text-gray-800 transition-transform ease-in duration-200">
                                <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-log-out"></i></span>
                                <span class="text-sm font-medium">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('sidebar-hidden');
        });
    </script>
</body>
</html>
