<?php
// Include your database connection
include 'includes/db_connect.php';

// Fetch site settings
$query = "SELECT * FROM site_settings WHERE id = 1";
$result = mysqli_query($conn, $query);
$site_settings = mysqli_fetch_assoc($result);
?>
<title><?php echo isset($site_settings['site_title']) ? $site_settings['site_title'] : 'Matadoor Fitness'; ?></title>
    <meta name="description" content="<?php echo isset($site_settings['meta_description']) ? $site_settings['meta_description'] : ''; ?>">
    <meta name="keywords" content="<?php echo isset($site_settings['meta_keywords']) ? $site_settings['meta_keywords'] : ''; ?>">

