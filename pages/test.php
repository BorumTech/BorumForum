<?php 
$page_title = "TEST!";
include('includes/header.html');
echo "<div class = 'col-sm-6'>";
if (!LOGGEDIN) {
	require('includes/login_functions.inc.php');
	redirect_user('does_not_exist.php');
}

include('includes/footer.html');
?>