<?php
// track_visitors.php
session_start();
include 'includes/db_connect.php';

// Get visitor IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Function to get country by IP
function getCountryByIP($ip) {
    $url = "http://www.geoplugin.net/json.gp?ip=" . $ip;
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data['geoplugin_countryName'] ?? 'Unknown';
}

// Get the country name
$country = getCountryByIP($ip);

// Store in session
$_SESSION['country'] = $country;

// Store visit in database
$sql = "INSERT INTO visit_logs (ip_address, country, visit_time) VALUES ('$ip', '$country', NOW())";
$conn->query($sql);

$conn->close();
?>
