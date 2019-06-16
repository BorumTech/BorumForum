<?php 

$page_title = "Edit a Post";
include('includes/header.html');
include('includes/login_functions.inc.php');

echo "<div class = 'col-sm-6'>";

$query = "SELECT subject, body, user_id FROM messages WHERE id = {$_GET['id']}";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (!LOGGEDIN && $row['user_id'] !== $_GET['id']) { // Make sure user is author of the question by redirecting everyone else
	redirect_user();
}

$sub = $row['subject'];
$body = $row['body'];


echo '<form action = "../' . $_GET['id'] . '" method = "post">';
echo "Subject: <input required name = 'subject' type = 'text' value = \"$sub\" style = 'width: 100%'>\n<br><br>";
echo "Question Description: <textarea required id = 'edit-body' name = 'body' style = 'width:100%' cols = '70' rows = '20'>$body</textarea>";
echo "<input type = 'submit' value = 'Edit Question'>";
echo '<input type = "hidden" name = "action" value = "edit-question">';
echo '<input type = "hidden" name = "id" value = "' . $_GET['id'] . '">';
echo '</form>';
include('includes/footer.html');

?>