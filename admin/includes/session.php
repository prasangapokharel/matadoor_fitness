<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin/authentication/adminlogin.php ");
    exit();
}
?>
