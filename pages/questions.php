<?php
$page_title = "Questions";
include('includes/header.html');
?>

<?php 

define('DISPLAY', 10); // Number of records to show per page

if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already determined
	$pages = $_GET['p'];
} else { // Need to be determined

	// Count the number of records
	$query = "SELECT COUNT(subject) FROM messages";
	$result = @mysqli_query($dbc, $query);
	$row = @mysqli_fetch_array($result, MYSQLI_NUM);
	$records = $row[0];

	// Calculate the number of pages
	if($records > DISPLAY) { // More than 1 Page
		$pages = ceil($records / DISPLAY);
	} else { // 1 Page
		$pages = 1;
	}
$q = 'SELECT id, subject FROM messages ORDER BY date_entered';
$result = @mysqli_query($dbc, $q);
echo "<table id = 'latest-questions'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

echo "
<tr><td><a href = \"Questions/{$row['id']}\">{$row['subject']}</a></td></tr>
";

}
echo "</table>";
?>

<?php
include('includes/footer.html');
?>