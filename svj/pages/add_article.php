<?php 
$page_title = "Article Wizard - The Silicon Valley Journal";
include('includes/header.html');

include('../../../svj_connect.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['title'])) {
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	} 

	if (isset($_POST['body'])) {
		$body = mysqli_real_escape_string($dbc, trim($_POST['body']));
	}

	$q = "INSERT INTO articles (title, body, date_written) VALUES ('$title', '$body', NOW())";
	$r = mysqli_query($dbc, $q);
	if (mysqli_affected_rows($dbc) == 1) {
		echo "<p>The article was successfully added. Thank you!";
		include('includes/footer.html');
		exit();
	}
}

echo "<form method = 'post' action = ''>";
?>

<p>
	<label for = "title">Title: </label>
	<input type = "text" name = "title" required id = "title">
</p>
<p>
	<label for = "body">Body: </label><br>
	<textarea style = "resize:none" type = "text" required name = "body" id = "body" cols = "150" rows = "15"></textarea>
</p>
<p>
	<input type = "submit" value = "Submit article">
</p>

<?php
echo "</form>";

include('includes/footer.html');

?>