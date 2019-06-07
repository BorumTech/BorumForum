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
SELECT `user-message-votes`.id, SUM(`user-message-votes`.vote) AS votes, messages.id AS msg_id, messages.subject, DATEDIFF(NOW(), messages.date_entered) AS date_posted, topics.name 
FROM messages 
JOIN topics
ON messages.forum_id = topics.id
LEFT OUTER JOIN `user-message-votes` ON messages.id = `user-message-votes`.message_id';
$where = 'messages.parent_id = 0 GROUP BY messages.id';
$result = performPaginationQuery($dbc, $q, $order_by, $start, $where);

?>

<div class = "sorting" style = "float:right">
	<a class = "<?php echo $sort == 'top' ? 'active': ''; ?>" href = "/Questions?sort=top">Top</a>
	<a class = "<?php echo $sort == 'new' ? 'active': ''; ?>" href = "/Questions?sort=new">New</a>
	<a class = "<?php echo $sort == 'active' ? 'active': ''; ?>"href = "/Questions?sort=active">Active</a>
</div>

<?php
echo "<table id = 'latest-questions'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array
	$votes = isset($row['votes']) ? $row['votes'] : 0;
	$answers = isset($rowCorr['answers']) ? $rowCorr['answers'] : 0;
	$timeelapsed = $row['date_posted'] . " days ago";

	if ($row['date_posted'] == 0) {
		$timeelapsed = "today";
	} else if ($row['date_posted'] == 1) {
		$timeelapsed = "yesterday";
	}
	echo "
	<tr>
	<td><div class = 'numbers'>Votes<span>$votes</span></div></td>
	<td><div class = 'numbers'>Answers<span>$answers</span></div></td>
	<td align = \"left\"><a href = \"Questions/{$row['msg_id']}\">{$row['subject']}</a></td>
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