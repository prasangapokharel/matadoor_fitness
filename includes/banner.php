<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Section</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.3.0/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-gradient-custom {
            background: linear-gradient(to right, #ff80b5, #9089fc);
            clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%);
            opacity: 0.3;
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: -1;
            filter: blur(20px);
            width: 100%;
            height: 100%;
        }

        .bg-gradient-custom-right {
            left: unset;
            right: 0;
        }
    </style>
</head>

<body>
    <!-- Banner Section -->
    <div id="banner" class="relative flex items-center gap-3 p-3 bg-gray-100 overflow-hidden">
        <!-- Gradient Backgrounds -->
        <div class="bg-gradient-custom"></div>
        <div class="bg-gradient-custom bg-gradient-custom-right"></div>

        <!-- Banner Content -->
        <div class="flex flex-wrap items-center justify-center gap-3 text-center w-full">
            <p class="mb-0 text-gray-800 font-bold">
                MF 2024
                <svg xmlns="http://www.w3.org/2000/svg" class="inline mx-2" width="4" height="4" fill="currentColor" aria-hidden="true">
                    <circle cx="2" cy="2" r="2" />
                </svg>
                Join us in Denver from June 7 – 9 to see what’s coming next.
            </p>
            <a href="registration" class="bg-black text-white px-4 py-2 rounded no-underline">Register now &rarr;</a>
        </div>

        <!-- Dismiss Button -->
        <div class="absolute top-1/2 right-0 transform -translate-y-1/2 mr-4">
            <button type="button" class="text-black" aria-label="Close" onclick="hideBanner()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        function hideBanner() {
            document.getElementById('banner').style.display = 'none';
        }
    </script>
</body>

</html>
