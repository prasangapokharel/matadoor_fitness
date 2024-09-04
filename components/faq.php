<?php include 'includes\navbar.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/tailwind/talwind.css" rel="stylesheet">

    <title>FAQ - Frequently Asked Questions</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Container for FAQ Section -->
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Frequently Asked Questions</h1>

        <!-- FAQ Item 1 -->
        <div class="mb-4">
            <button class="w-full text-left p-4 bg-white shadow rounded-md focus:outline-none" onclick="toggleFaq('faq1')">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">What is your return policy?</h2>
                    <span id="faq1-icon" class="text-gray-500">&#x25BC;</span>
                </div>
            </button>
            <div id="faq1" class="hidden mt-2 p-4 bg-white shadow rounded-md">
                <p>We offer a 30-day return policy. If you're not satisfied with your purchase, you can return it within 30 days for a full refund or exchange. Please refer to our return policy page for more details.</p>
            </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="mb-4">
            <button class="w-full text-left p-4 bg-white shadow rounded-md focus:outline-none" onclick="toggleFaq('faq2')">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">How long does shipping take?</h2>
                    <span id="faq2-icon" class="text-gray-500">&#x25BC;</span>
                </div>
            </button>
            <div id="faq2" class="hidden mt-2 p-4 bg-white shadow rounded-md">
                <p>Shipping usually takes between 5-7 business days, depending on your location and the shipping method selected at checkout.</p>
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="mb-4">
            <button class="w-full text-left p-4 bg-white shadow rounded-md focus:outline-none" onclick="toggleFaq('faq3')">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Do you ship internationally?</h2>
                    <span id="faq3-icon" class="text-gray-500">&#x25BC;</span>
                </div>
            </button>
            <div id="faq3" class="hidden mt-2 p-4 bg-white shadow rounded-md">
                <p>Yes, we offer international shipping to many countries. Please check our shipping policy page for more information on the countries we ship to and the shipping rates.</p>
            </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="mb-4">
            <button class="w-full text-left p-4 bg-white shadow rounded-md focus:outline-none" onclick="toggleFaq('faq4')">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">How can I track my order?</h2>
                    <span id="faq4-icon" class="text-gray-500">&#x25BC;</span>
                </div>
            </button>
            <div id="faq4" class="hidden mt-2 p-4 bg-white shadow rounded-md">
                <p>Once your order is shipped, we will send you an email with the tracking information. You can also track your order by logging into your account on our website and going to the 'Orders' section.</p>
            </div>
        </div>

    </div>

    <!-- JavaScript for FAQ Toggle -->
    <script>
        function toggleFaq(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.innerHTML = '&#x25B2;'; // Up arrow
            } else {
                content.classList.add('hidden');
                icon.innerHTML = '&#x25BC;'; // Down arrow
            }
        }
    </script>
</body>
</html>
