<?php
// Include the Cache class
include 'includes/Cache.php';

// Create an instance of the Cache class
$cache = new Cache();

// Define a cache key and check if data is available in cache
$cacheKey = 'homepage_content';
$cachedContent = $cache->get($cacheKey);

if ($cachedContent) {
    // Use cached content
    echo $cachedContent;
} else {
    // Generate content (e.g., fetch from database or generate HTML)
    ob_start(); // Start output buffering
    ?>
    <?php
    $content = ob_get_clean(); // Get the content from the buffer
    // Cache the generated content for 1 hour
    $cache->set($cacheKey, $content, 3600);
    // Output the content
    echo $content;
}
?>
