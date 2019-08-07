<?php 

if (!isset($_COOKIE['id'])) {
    include('includes/login_functions.inc.php');
    redirect_user();
}

$page_title = "Interesting Questions";
@require_once('includes/header.html');

?>

<div class = "col-sm-10">
<h1>This page has not been fully designed. </h1>

<?php 

define('DISPLAY', 10);

require('includes/pagination_functions.inc.php');

$start = getStartValue();
list($sort, $order_by) = getSortValue('messages');
$q = "SELECT topic_id FROM `followed-topics` WHERE user_id = {$_COOKIE['id']}";
$r = mysqli_query($dbc, $q);
$followrow = mysqli_fetch_array($r, MYSQLI_NUM);
$following = $followrow;
$following = join("','", $following); 

$q = '
SELECT
    T1.votes AS votes, T1.msg_id AS msg_id, T1.subject AS subject, T1.date_posted AS date_posted, T1.topic_id, T1.name AS topic_name, IFNULL(T2.answers, 0) AS answers
FROM
    (
    SELECT
        `user-message-votes`.id,
        IFNULL(SUM(`user-message-votes`.vote), 0) AS votes,
        messages.id AS msg_id,
        messages.subject,
        DATEDIFF(NOW(), messages.date_entered) AS date_posted, messages.date_entered AS de,
        topics.name,
        topics.id AS topic_id
    FROM
        messages
    JOIN topics ON messages.forum_id = topics.id
    LEFT OUTER JOIN `user-message-votes` ON messages.id = `user-message-votes`.message_id
    WHERE
        messages.parent_id = 0
    GROUP BY
        messages.id
) T1
    LEFT OUTER JOIN(
        SELECT
            id,
            parent_id,
            COUNT(id) AS answers
        FROM
            messages
        WHERE
            parent_id != 0
        GROUP BY
            parent_id
    ) T2
ON
    T1.msg_id = T2.parent_id
WHERE T1.topic_id IN ("' . $following . '")
ORDER BY
        ' . $order_by . ' LIMIT ' . $start . ', ' . DISPLAY;    

echo $q;
$result = mysqli_query($dbc, $q);

echo "<table class = 'question-list'>";
while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array
	$timeelapsed = $row['date_posted'] . " days ago";

	if ($row['date_posted'] == 0) {
		$timeelapsed = "today";
	} else if ($row['date_posted'] == 1) {
		$timeelapsed = "yesterday";
	}

    if ($row['date_posted'] >= 30) {
        $timeelapsed = ceil($row['date_posted'] / 30) . " months ago";
    } else if ($row['date_posted'] >= 7) {
        $timeelapsed = ceil($row['date_posted'] / 7) . " weeks ago";
    }

	echo "
	<tr>
	<td class = 'block'><div class = 'numbers'><span>Votes</span><span>{$row['votes']}</span></div></td>
	<td class = 'block'><div class = 'numbers'><span>Answers</span><span>{$row['answers']}</span></div></td>
	<td align = \"left\">
		<a href = \"Questions/{$row['msg_id']}\">{$row['subject']}</a>
		<a class = \"question-tags\" href = \"/Topics/{$row['topic_name']}\">{$row['topic_name']}</a>
	</td>
	<td align = \"right\" class = 'date-diff' style = 'font-style: italic'>Asked $timeelapsed</td>
	</tr>
	";

}
echo "</table>";

?>

<?php

@include_once('includes/footer.html');
?>

