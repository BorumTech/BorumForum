<?php

$page_title = "Questions";
include('includes/header.html');
?>

<h1>Recent Questions</h1>

<?php 
require('includes/pagination_functions.inc.php');

define('DISPLAY', 10); // Number of records to show per page

$pages = getPagesValue('id', 'messages', 'WHERE parent_id = 0');
$start = getStartValue();

$q = '
SELECT messages.id, messages.subject, DATEDIFF(NOW(), messages.date_entered) AS date_posted, topics.name 
FROM messages 
JOIN topics
ON messages.forum_id = topics.id
WHERE parent_id = 0';
$result = performPaginationQuery($q, 'date_entered DESC', $start, $dbc);

echo "<table id = 'latest-questions'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

	echo "
	<tr>
	<td align = \"left\"><a href = \"Questions/{$row['id']}\">{$row['subject']}</a></td>
	<td align = \"right\" class = 'date-diff' style = 'font-style: italic'>{$row['date_posted']} days ago</td>
	</tr>
	";

}
echo "</table>";

mysqli_free_result($result);
mysqli_close($dbc);

setPreviousAndNextLinks('Questions');

?>

<?php include('includes/footer.html'); ?>