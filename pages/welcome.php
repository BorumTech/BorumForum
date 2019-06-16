<?php # Script 12.4 - loggedin.php
# The user is redirected here from login.php

// If no cookie is present, redirect the user
if (!isset($_COOKIE['id'])) {
	// Need the functions
	require('includes/login_functions.inc.php');
	redirect_user();
}

// Set the page title and include the HTML header
$page_title = 'Logged In! ';
include('includes/header.html');

// Print the customized message
echo "<div class = 'col-sm-6'><h1>Logged In!</h1>
<p>You are now logged in, {$_COOKIE['first_name']}!</p>
<p><a href=\"logout\">Logout</a>
</p><p>
<a href = \"users/{$_COOKIE['id']}\">Profile</a>
</p>";

include('includes/footer.html');