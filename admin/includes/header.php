<head>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.7/dist/tailwind.min.css" rel="stylesheet">
</head>

<header class="pcoded-header" header-theme="theme3">
    <nav class="navbar-header flex justify-between items-center p-4 bg-orange-500" header-theme="theme4" logo-theme="theme6">
        <!-- Logo Section -->
        <div class="navbar-brand">
            <a href="index.html" class="logo flex items-center">
                <img class="h-10 w-10 mr-2" src="path-to-your-logo.png" alt="Logo">
                <span class="text-white text-lg font-bold">AdminDek</span>
            </a>
        </div>

        <!-- Search and Icons Section -->
        <div class="flex items-center">
            <div class="mr-4">
                <input type="text" class="border border-gray-300 rounded px-2 py-1" placeholder="Search...">
            </div>
            <div class="flex space-x-4 text-white">
                <span class="relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs flex items-center justify-center">5</span>
                </span>
                <span class="relative">
                    <i class="fas fa-envelope"></i>
                    <span class="absolute top-0 right-0 h-4 w-4 bg-green-500 rounded-full text-xs flex items-center justify-center">3</span>
                </span>
            </div>
        </div>

        <!-- User Profile Section -->
        <div class="flex items-center">
            <img src="path-to-profile-picture.jpg" alt="John Doe" class="h-10 w-10 rounded-full mr-2">
            <span class="text-white">John Doe</span>
            <i class="fas fa-chevron-down ml-2 text-white"></i>
        </div>
    </nav>
</header>
