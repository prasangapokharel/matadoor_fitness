<?php include 'includes/store.php'; ?>
<?php include 'includes/cookies.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matadoor Fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    <link href="./css/tailwind/talwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMI/IFGURTr5eof4y5boF5JeLv5st4/+Ppddz6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/scroll.css">

</head>

<body>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/banner.php'; ?>


    <!-- Welcome Banner -->
    <div class="welcome-banner">
        
        <!-- <h1>WELCOME TO THE MATADOOR FITNESS </h1>
        <h2>+7Years Till Now </h2> -->
    </div>
    <!-- <a href="https://www.google.com/maps/dir//J42W%2BHQQ,+Inaruwa+56710/@26.6014352,87.0645837,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39ef13772751da17:0xffd09ba1f8cbf5cf!2m2!1d87.1469758!2d26.6014619?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D"
    class="direction-button" target="_blank">Start Directions</a> -->
    <!-- Membership Section -->
    <?php include 'components/membership.php'; ?>


    <!-- Showcase Section -->
    <?php include 'components/gallery.php'; ?>


    <!-- Team Section -->
    <?php include 'components/team.php'; ?>

    
   

    <!-- Location section -->
    <?php include 'components/location.php'; ?>



    <?php include 'includes/static.php'; ?>

    <!-- footer section -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>
