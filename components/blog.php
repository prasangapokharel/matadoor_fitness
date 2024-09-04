<link href="./css/tailwind/talwind.css" rel="stylesheet">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Upcoming Events</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eventId = $row['id'];
                $imagePath = htmlspecialchars($row['image_path']);
                $description = htmlspecialchars($row['description']);
        ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./uploads/<?php echo $imagePath; ?>" alt="Event Image" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <p class="text-gray-700"><?php echo $description; ?></p>
                        <a href="event/<?php echo $eventId; ?>" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">Read More</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p class="text-center text-gray-500">No events available.</p>';
        }

        ?>
    </div>
</div>