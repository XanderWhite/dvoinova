<?php
define('WP_USE_THEMES', false);
require('./wp-blog-header.php');
header('Content-Type: application/json');

$directory = './images/gallery';

$images = glob($directory . "/*.{jpg,jpeg,png,gif,webp,JPG}", GLOB_BRACE);

usort($images, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

$newimages = array_map(function($image) {
 return get_template_directory_uri() . '/images/gallery/' . basename($image);
}, $images);

echo json_encode($newimages);
?>