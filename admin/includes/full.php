<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Toggle</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <style>
        /* Custom styles to ensure button stays visible */
        #fullscreen-btn {
            position: fixed;
            top: 8px;
            right: 9px;
            z-index: 50;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Fullscreen Button -->
    <button id="fullscreen-btn" class="p-3 bg-gray-700 text-white">
        <i id="fullscreen-icon" class="bx bx-fullscreen"></i>
    </button>

    <!-- JavaScript for fullscreen toggle -->
    <script>
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const fullscreenIcon = document.getElementById('fullscreen-icon');

        fullscreenBtn.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => {
                    console.log(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
                });
                fullscreenIcon.classList.replace('bx-fullscreen', 'bx-fullscreen-exit');
            } else {
                document.exitFullscreen().catch(err => {
                    console.log(`Error attempting to exit fullscreen mode: ${err.message} (${err.name})`);
                });
                fullscreenIcon.classList.replace('bx-fullscreen-exit', 'bx-fullscreen');
            }
        });

        // Listen for fullscreen change events to update icon
        document.addEventListener('fullscreenchange', () => {
            if (document.fullscreenElement) {
                fullscreenIcon.classList.replace('bx-fullscreen', 'bx-fullscreen-exit');
            } else {
                fullscreenIcon.classList.replace('bx-fullscreen-exit', 'bx-fullscreen');
            }
        });
    </script>
</body>
</html>
