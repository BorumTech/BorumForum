<?php 
$page_title = "Add Article - The Silicon Valley Journal";
include('includes/header.html');

echo "<form>";
?>

<p>
	<label for = "title">Title: </label>
	<input type = "text" id = "title">
</p>
<p>
	<label for = "body">Body: </label><br>
	<textarea style = "resize:none" type = "text" id = "body" cols = "150" rows = "15"></textarea>
</p>
<p>
	<input type = "submit" value = "Submit article">
</p>

<?php
echo "</form>";

include('includes/footer.html');

?>