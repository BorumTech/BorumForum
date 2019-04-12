<?php
file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
$query = 'SELECT messages.id, messages.subject, messages.body, users.profile_picture, users.first_name FROM messages JOIN users ON messages.user_id = users.id WHERE messages.id = ' . $_GET['id'];
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


$page_title = $row['subject'];
include('includes/header.html');
?>

<?php 

echo "<h1>{$row['subject']}</h1>";
echo "<p>{$row['body']}</p>";
echo "<div style = 'float:right'><span>{$row['first_name']}</span><img height = '30' src = '../pages/show_image.php?image={$row['profile_picture']}'></div>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Validate the form elements
	$ans = mysqli_real_escape_string($dbc, trim($_POST['answer']));
	$id = $_COOKIE['id'];
}

?>

<h2>Your Answer</h2>
<form action = '' method = 'post'>
<br>
<p>
<textarea name = "answer" cols = '125' rows = '20'></textarea>
</p>
<input type = 'submit' name = 'submit' value = 'Post your Answer'>
</form>

<?php
include('includes/footer.html');
?>