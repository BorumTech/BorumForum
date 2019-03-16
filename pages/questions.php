<?php
$page_title = "Questions";
include('includes/header.html');
?>

<?php 

require_once('../../../mysqli_connect.inc.php');

define('DISPLAY', 10); // Number of records to show per page

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