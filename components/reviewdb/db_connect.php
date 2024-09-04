<?php
// db_connect.php

$servername = "localhost"; // Change this to your database server
$username = "root";        // Change this to your database username
$password = "";            // Change this to your database password
$dbname = "matadoor_fitness";        // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
$conn->set_charset("utf8");
?>
