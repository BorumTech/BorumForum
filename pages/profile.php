<?php

file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
// Use my error handler
set_error_handler(function() {});
$id = $_GET['id'];
$query = 'SELECT id, first_name, last_name, profile_picture, bio FROM users WHERE id = ' . $id . ' LIMIT 1';
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);

$page_title = "{$row['first_name']}'s Profile";
include('includes/header.html');
?>

<?php 

echo "<output id = 'bio'>{$row['bio']}</output>";
if ($_COOKIE['id'] == $id) {
	echo "<button id = 'edit-bio-btn' onclick = 'editBio($id)'>Edit Bio</button>";
}


$query1 = "SELECT id, subject, date_entered FROM messages WHERE parent_id = 0 AND user_id = $id"; // Get questions
$result1 = mysqli_query($dbc, $query1);
echo '<h2>Questions</h2><ul>';
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
	echo "<li><a href = '/Questions/{$row1['id']}'>{$row1['subject']}</a></li>"; // Show questions
}
echo '</ul>';

$query1 = "SELECT answers.user_id, questions.subject, questions.id, answers.parent_id FROM messages AS answers JOIN messages AS questions ON questions.id = answers.parent_id HAVING answers.user_id = $id";
$result1 = mysqli_query($dbc, $query1);
echo '<h2>Answers</h2><ul>';
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
	echo "<li><a href = '/Questions/{$row1['parent_id']}'>{$row1['subject']}</a></li>"; // Show answers
}
echo '</div><div class = "col-sm-2">';

function handleImageUpload() {
	global $id;
	global $dbc;
	if (isset($_FILES['upload']) && $_FILES['upload']['size'] < $_POST['MAX_FILE_SIZE']) {
		$allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
		if (in_array($_FILES['upload']['type'], $allowed)) {
			if (move_uploaded_file($_FILES['upload']['tmp_name'], "../../uploads/{$_FILES['upload']['name']}")) {
				echo '<p><em>The file has been uploaded!</em></p>';
				echo '<img width = "300" src = "../pages/show_image.php?image=' . $_FILES['upload']['name'] . '">';
				$query1 = 'UPDATE users SET profile_picture = "' . $_FILES['upload']['name'] . '" WHERE id = ' . $id;
				$result1 = mysqli_query($dbc, $query1);
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
		<input type = "submit" name = "submit" value = "Submit">
	</form>';
}

// If the user is viewing his or her own profile
if ($_COOKIE['id'] == $id) {
	displayForm();
}

// If they submitted the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	handleImageUpload(); // 
}	
// If the user already has a profile picture 
if (isset($row['profile_picture'])) {
	echo '<img width = "300" src = "../pages/show_image.php?image=' . $row['profile_picture'] . '">'; // Show it
}

echo "<p>{$row['first_name']} {$row['last_name']}</p>";

mysqli_free_result ($result);
mysqli_close($dbc);

echo $_COOKIE['id'] !== $_GET['id'] ? '' : '<a href = "../Settings">Settings</a>';
include('includes/footer.html'); 
?>

