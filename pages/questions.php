<?php

$page_title = "Questions";
include('includes/header.html');
?></div>
<div class = "col-sm-10">

<h1>Recent Questions</h1>

<?php 

require('includes/pagination_functions.inc.php');

define('DISPLAY', 10); // Number of records to show per page

$pages = getPagesValue('id', 'messages', 'WHERE parent_id = 0');
$start = getStartValue();

list($sort, $order_by) = getSortValue('messages');

$q = '
SELECT SUM(`user-message-votes`.vote), messages.id, messages.subject, DATEDIFF(NOW(), messages.date_entered) AS date_posted, topics.name 
FROM messages 
JOIN topics
ON messages.forum_id = topics.id
LEFT OUTER JOIN `user-message-votes` ON messages.id = `user-message-votes`.message_id';
$where = 'messages.parent_id = 0';
$result = performPaginationQuery($q, $order_by, $start, $where, $dbc);

?>

<div class = "sorting" style = "float:right">
	<a href = "/Questions?sort=top">Top</a>
	<a href = "/Questions?sort=new">New</a>
	<a href = "/Questions?sort=active">Active</a>
</div>

<?php
echo "<table id = 'latest-questions'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array
	$timeelapsed = $row['date_posted'] . " days ago";

	if ($row['date_posted'] == 0) {
		$timeelapsed = "today";
	} else if ($row['date_posted'] == 1) {
		$timeelapsed = "yesterday";
	}
	echo "
	<tr>
	<td align = \"left\"><a href = \"Questions/{$row['id']}\">{$row['subject']}</a></td>
	<td align = \"right\" class = 'date-diff' style = 'font-style: italic'>Asked $timeelapsed</td>
	</tr>
	";

}
echo "</table>";

mysqli_free_result($result);
mysqli_close($dbc);

setPreviousAndNextLinks('Questions');

?>

<?php include('includes/footer.html'); ?>