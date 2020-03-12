<?php
session_start();
$_SESSION = []; // Erase data from text file of sessions on server
session_destroy(); // Remove the session data from the server
setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0);
var_export($_SESSION);
?>
