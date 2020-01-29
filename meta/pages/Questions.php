<?php

$page_title = "Questions";
include('includes/header.html');
?>
<div class = "col-sm-7">

<h1>All Questions</h1>

<?php

require('includes/pagination_functions.inc.php');

define('DISPLAY', 10); // Number of records to show per page
define('SHOWINGUNANSWERED', isset($_GET['sort']) && $_GET['sort'] == 'unanswered');
define('UNANSWEREDQUERY', SHOWINGUNANSWERED ? ' HAVING COUNT(id) IS NULL' : '');

$pages = getPagesValue('id', 'questions', 'WHERE 0 = 0' . UNANSWEREDQUERY);
$start = getStartValue();

list($sort, $order_by) = getSortValue('questions');

if ($order_by != 'unanswered') {
    $q = '
    SELECT
        T1.votes AS votes, T1.msg_id AS msg_id, T1.subject AS subject, T1.date_posted AS date_posted, T1.name AS topic_name, IFNULL(T2.answers, 0) AS answers
    FROM
        (
        SELECT
            `question-votes`.id,
            IFNULL(SUM(`question-votes`.vote), 0) AS votes,
            questions.id AS msg_id,
            questions.subject,
            DATEDIFF(NOW(), questions.date_entered) AS date_posted, questions.date_entered AS de,
            topics.name
        FROM
            questions
        JOIN topics ON questions.topic_id = topics.id
        LEFT OUTER JOIN `question-votes` ON questions.id = `question-votes`.question_id
        GROUP BY
            questions.id
    ) T1
        LEFT OUTER JOIN(
            SELECT
                id,
                question_id,
                COUNT(id) AS answers
            FROM
                answers
            WHERE
                question_id != 0
            GROUP BY
                question_id
        ) T2
    ON
        T1.msg_id = T2.question_id
    ORDER BY
            ' . $order_by . ' LIMIT ' . $start . ', ' . DISPLAY;
} else {
    $q = '
    SELECT
        T1.votes AS votes, T1.msg_id AS msg_id, T1.subject AS subject, T1.date_posted AS date_posted, T1.name AS topic_name, IFNULL(T2.answers, 0) AS answers
    FROM
        (
        SELECT
            `question-votes`.id,
            IFNULL(SUM(`question-votes`.vote), 0) AS votes,
            questions.id AS msg_id,
            questions.subject,
            DATEDIFF(NOW(), questions.date_entered) AS date_posted,
            topics.name
        FROM
            messages
        JOIN topics ON messages.forum_id = topics.id
        LEFT OUTER JOIN `user-message-votes` ON messages.id = `user-message-votes`.message_id
        WHERE
            messages.question_id = 0
        GROUP BY
            messages.id
    ) T1
        LEFT OUTER JOIN(
            SELECT
                id,
                question_id,
                COUNT(id) AS answers
            FROM
                messages
            WHERE
                question_id != 0
            GROUP BY
                question_id
        ) T2
    ON
        T1.msg_id = T2.question_id
    WHERE T2.answers IS NULL
    ORDER BY T1.votes DESC
    LIMIT ' . $start . ', ' . DISPLAY;
}

$result = mysqli_query($dbc, $q);

?>

<div class = "sorting" style = "float:right">
	<a class = "<?php echo $sort == 'top' ? 'active': ''; ?>" href = "/Questions?sort=top">Top</a>
	<a class = "<?php echo $sort == 'new' ? 'active': ''; ?>" href = "/Questions?sort=new">New</a>
	<a class = "<?php echo $sort == 'active' ? 'active': ''; ?>"href = "/Questions?sort=active">Active</a>
	<a class = "<?php echo $sort == 'unanswered' ? 'active': ''; ?>"href = "/Questions?sort=unanswered">Unanswered</a>
</div>
<?php
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
		<a class = \"question-tags\" href = \"Topics/{$row['topic_name']}\">{$row['topic_name']}</a>
	</td>
	<td align = \"right\" class = 'date-diff' style = 'font-style: italic'>Asked $timeelapsed</td>
	</tr>
	";

}
echo "</table>";

setPreviousAndNextLinks('Questions');

?>
</div>
<?php if (isset($_SESSION['id'])) {

echo "<div class = \"col-sm-3 topic-notif-container\">
    <fieldset class = \"topic-notif\">
        <legend>Tags you are Following</legend>";

            $q = "SELECT `followed-topics`.id, topics.name FROM `followed-topics` JOIN topics ON topics.id = `followed-topics`.topic_id WHERE `followed-topics`.user_id = {$_SESSION['id']}";
            $r = mysqli_query($dbc, $q);
            while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo "<p><a href = \"Topics/{$row['name']}\">{$row['name']}</a></p>";
            }
echo"    </fieldset>
    <fieldset class = \"topic-notif\">
        <legend>Tags you are Ignoring</legend>
     ";
            $q = "SELECT `ignored-topics`.id, topics.name FROM `ignored-topics` JOIN topics ON topics.id = `ignored-topics`.topic_id WHERE `ignored-topics`.user_id = {$_SESSION['id']}";
            $r = mysqli_query($dbc, $q);
            while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo "<p><a href = \"Topics/{$row['name']}\">{$row['name']}</a></p>";
            }
       echo "</fieldset>";
}

    @mysqli_free_result($result);
    mysqli_close($dbc);
    include('includes/footer.html');

?>
