<?php
$page_title = "Questions";
include('includes/header.html');
?>

<?php 

include('../../../mysqli_connect.inc.php');

$q = 'SELECT id, subject FROM messages ORDER BY date_entered';
$result = @mysqli_query($dbc, $q);
echo "<table>";
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