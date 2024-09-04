<?php
// Function to set a cookie
function set_cookie($name, $value, $expire = 3600, $path = "/") {
    setcookie($name, $value, time() + $expire, $path);
}

// Function to get a cookie value
function get_cookie($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

// Function to delete a cookie
function delete_cookie($name, $path = "/") {
    setcookie($name, '', time() - 3600, $path);
}
?>
