<?php
ob_start();
# Script 11.5 - show_image.php
# This page displays an image

$name = FALSE; // Flag variable

// Check for an image name in the URL
if (isset($_GET['image'])) {

	// Make sure it has an image's extension
	$ext = substr($_GET['image'], -4);
	if (in_array($ext, ['.jpg', '.jpeg', '.png'])) {

		// Full image path
		$image = "../../uploads/{$_GET['image']}";

		// Check that the image exists and is a file
		if (file_exists($image) && is_file($image)) {

			// Set the name as this image
			$name = $_GET['image'];
		}
	}
}

if (!$name) {
	$image = 'http://cdn.bforborum.com/images/unavailable.png';
	$name = 'unavailable.png';
}

$info = getimagesize($image);
$fs = filesize($image);

header("Content-Type: {$info['mime']}\n");
header("Content-Disposition: inline; filename=\"$name\"\n");
header("Content-Length: $fs\n");
readfile($image);
