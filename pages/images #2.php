<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "utf-8">
	<title>Images</title>
	<script charset = "utf-8" src = "function.js"></script>
</head>
<body>
	<p>Click on an image to view it in a separate window</p>
	<ul>
		<?php 
		# Script 11.6 - images.php
		# This script lists the images in the uploads directory
		# This version now shows each image's file size and uploaded date and time

		date_default_timezone_set('America/New_York'); // Set the default timezone

		$dir = '../../uploads'; // Define the directory to view
		$files = scandir($dir);

		// Display each image caption as a link to the JavaScript function
		foreach($files as $image) {
			if (substr($image, 0, 1) != '.') { // Ignore anyhting starting with a period
				$image_size = getimagesize("$dir/$image"); // Get the image's size in pixels
				$image_name = urlencode($image); // Make the image's name URL-safe
				$filemtime = filemtime("$dir/$image");
				$image_date = date("F d, Y H:i:s", $filemtime); // Determine the image's upload date and time
				$file_size = round(filesize("$dir/$image") / 1024) . "kb"; // Calculate the image's size in kilobytes

				// Print the information
				echo "<li><a href = \"javascript:create_window('$image_name', $image_size[0], $image_size[1])\">$image</a> $file_size ($image_date)</li>\n";
			}
		}
		?>
	</ul>
</body>
</html> 