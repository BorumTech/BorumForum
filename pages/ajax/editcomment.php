<?php 
require_once('../../../mysqli_connect.inc.php'); // Retrieve db connection

$commentID = $_REQUEST['id'];
$newtext = mysqli_real_escape_string($dbc, trim($_REQUEST['new_text']));

if (is_numeric($commentID) && isset($newtext)) {
    $q = "UPDATE comments SET body = '$newtext' WHERE id = $commentID LIMIT 1";
    $r = mysqli_query($dbc, $q);

    if (mysqli_affected_rows($dbc) == 1) {
        echo json_encode(['ok' => TRUE]);
    } else {
        echo json_encode(['ok' => FALSE, 'reason' => 'Database not updated', 'affected_rows' => mysqli_affected_rows($dbc)]);
    }
} else {
    echo json_encode(['ok' => FALSE, 'reason' => 'Not all query parameters were set and valid']);
}


?>