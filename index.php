<?php include 'includes/store.php'; ?>
<?php include 'includes/cookies.php'; ?>

<?php
// Include your database connection
include 'includes/db_connect.php';

// Fetch site settings
$query = "SELECT * FROM site_settings WHERE id = 1";
$result = mysqli_query($conn, $query);
$site_settings = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($site_settings['site_title']) ? $site_settings['site_title'] : 'Matadoor Fitness'; ?></title>
    <meta name="description" content="<?php echo isset($site_settings['meta_description']) ? $site_settings['meta_description'] : ''; ?>">
    <meta name="keywords" content="<?php echo isset($site_settings['meta_keywords']) ? $site_settings['meta_keywords'] : ''; ?>">

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
        <!-- Your welcome content -->
    </div>

    <!-- Membership Section -->
    <?php include 'components/membership.php'; ?>

    <!-- Showcase Section -->
    <?php include 'components/gallery.php'; ?>

    <!-- Team Section -->
    <?php include 'components/team.php'; ?>

    <!-- Location section -->
    <?php include 'components/location.php'; ?>

    <?php include 'includes/static.php'; ?>

    <!-- Footer Section -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
