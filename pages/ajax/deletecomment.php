<?php 
require_once('../../../mysqli_connect.inc.php'); // Retrieve db connection

$commentID = $_REQUEST['id'];

if (is_numeric($commentID)) {
    $q = "DELETE FROM comments WHERE id = $commentID LIMIT 1";
    $r = mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc) == 1) {
        echo json_encode(['ok' => TRUE]);
    } else {
        echo json_encode(['ok' => FALSE]);
    }
} else {
    echo json_encode(['ok' => FALSE]);
}


?>