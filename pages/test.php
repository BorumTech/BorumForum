<?php 

include('includes/header.html');
echo "<div class = 'col-sm-6'>";
if (!LOGGEDIN) {
	require('includes/login_functions.inc.php');
	redirect_user('');
}

include('includes/footer.html');
?>