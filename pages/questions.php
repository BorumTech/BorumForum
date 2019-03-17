<?php

$page_title = "Questions";
include('includes/header.html');
?>

<h1>Recent Questions</h1>

<?php 
require('includes/pagination_functions.inc.php');

define('DISPLAY', 10); // Number of records to show per page

$pages = getPagesValue('id', 'messages');
$start = getStartValue();

$q = 'SELECT id, subject FROM messages';
$result = performPaginationQuery($q, 'date_entered', $start, $dbc);

echo "<table id = 'latest-questions'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

	echo "
	<tr><td align = \"left\"><a href = \"Questions/{$row['id']}\">{$row['subject']}</a></td></tr>
	";

}
echo "</table>";

mysqli_free_result($result);
mysqli_close($dbc);

setPreviousAndNextLinks('Questions');

?>

<?php include('includes/footer.html'); ?>