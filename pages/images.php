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
		# Script 11.4 - images.php
		# This script lists the images in the uploads directory

		$dir = '../../uploads'; // Define the directory to view
		$files = scandir($dir);

		// Display each image caption as a link to the JavaScript function
		foreach($files as $image) {
			if (substr($image, 0, 1) != '.') { // Ignore anyhting starting with a period
				$image_size = getimagesize("$dir/$image");
				$image_name = urlencode($image);

				echo "<li><a href = \"javascript:create_window('$image_name', $image_size[0], $image_size[1])\">$image</a></li>\n";
			}
		}
		?>
	</ul>
</body>
</html> 