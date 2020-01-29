<?php
ob_start();

$page_title = "Edit a Post";
@require('includes/header.html');

echo "<div class = 'col-sm-6'>";

@require('includes/login_functions.inc.php');

$query = "SELECT subject, body, user_id, parent_id FROM messages WHERE id = {$_GET['id']}";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
define('ISQUESTION', $row['parent_id'] == 0);

if (!LOGGEDIN || $row['user_id'] !== $_SESSION['id']) { // Make sure user is author of the question by redirecting everyone else
	redirect_user();
}

ob_flush();

$sub = $row['subject'];
$body = $row['body'];


echo '<form action = "../';
echo ISQUESTION ? $_GET['id'] : $row['parent_id'];
echo '" method = "post">';
echo ISQUESTION ? "Subject: <input required name = 'subject' type = 'text' value = \"$sub\" style = 'width: 100%'>\n<br><br>" : "";
echo "Question Description: <textarea required id = 'edit-body' name = 'body' style = 'width: 100%' cols = '70' rows = '20'>$body</textarea>";
echo "<input type = 'submit' value = 'Edit Question'>";
echo '<input type = "hidden" name = "action" value = "edit-question">';
echo '<input type = "hidden" name = "id" value = "' . $_GET['id'] . '">';
echo '</form>';
include('includes/footer.html');

?>
