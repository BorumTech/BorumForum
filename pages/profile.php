<?php

include('../../../mysqli_connect.inc.php');
// Use my error handler
set_error_handler(function() {});
$id = $_GET['id'];
$query = 'SELECT id, first_name, last_name FROM users WHERE id = ' . $id . ' LIMIT 1';
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);

$page_title = "{$row['first_name']}'s Profile";
include('includes/header.html');
?>

<div style = 'float:right'>

<?php 
function handleImageUpload() {
	global $id;
	global $dbc;
	if (isset($_FILES['upload']) && $_FILES['upload']['size'] < $_POST['MAX_FILE_SIZE']) {
		$allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
		if (in_array($_FILES['upload']['type'], $allowed)) {
			if (move_uploaded_file($_FILES['upload']['tmp_name'], "../../../uploads/{$_FILES['upload']['name']}")) {
				echo '<img width = "300" src = "/Borum/pages/show_image.php?image=' . $_FILES['upload']['name'] . '">';
				$query1 = 'UPDATE users SET profile_picture = "' . $_FILES['upload']['name'] . '" WHERE id = ' . $id;
				$result1 = @mysqli_query($dbc, $query1);
			}
		} else {
			echo '<p class = "error">Please upload a JPEG or PNG image.</p>';
		}
	}

	if ($_FILES['upload']['error'] > 0) {
		echo '<p class = "error">The file could not be uploaded because: <strong>';

		switch ($_FILES['upload']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini.';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
				break;
			case 3:
				print 'The file was only partially uploaded.';
				break;
			case 4:
				print 'No file was uploaded.';
				break;
			case 6:
				print 'No temporary folder was available. ';
				break;
			case 7:
				print 'Unable to write to disk. ';
				break;
			case 8:
				print 'File upload stopped. ';
				break;
			default: 
				print 'A system error occured. ';
				break; 
		}
		print '</strong></p>';
	}

	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
		unlink ($_FILES['upload']['tmp_name']);
	}
}

function displayForm() {
	echo '
	<form id = "profile_pic" enctype = "multipart/form-data" action = "" method = "post">
		<input type = "hidden" name = "MAX_FILE_SIZE" value = "524288">
		<fieldset>
			<p><strong>File:</strong><input type = "file" name = "upload"></p>
		</fieldset>
		<div align = "center"><input type = "submit" name = "submit" value = "Submit"></div>
	</form>';
}


$query2 = 'SELECT id, first_name, profile_picture, DATE_FORMAT(registration_date, "%M %D, %Y") as regisdate FROM users WHERE id=' . $id;
$result2 = mysqli_query($dbc, $query2);
$row2 = mysqli_fetch_array($result2); 
if ($row2['profile_picture'] !== NULL) {
	echo '<img width = "300" src = "/Borum/pages/show_image.php?image=' . $row2['profile_picture'] . '">';
} else if ($_COOKIE['id'] === $_GET['id']) {
	if (empty($_POST)) { // If the form is not submitted
		displayForm();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		handleImageUpload();
	}	
}


echo "<p>{$row['first_name']} {$row['last_name']}</p>";

echo "
</div>
<output rows='10' cols='50'>Hello my name is {$row2['first_name']}. I have been using Borum since {$row2['regisdate']}.</output>
<br>
";

mysqli_free_result ($result);
mysqli_close($dbc);

echo $_COOKIE['id'] !== $_GET['id'] ? '' : '<a href = "/Borum/pages/settings.html">Settings</a>';
include('includes/footer.html'); 
?>

