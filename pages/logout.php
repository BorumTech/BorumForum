<?php # Script 12.6 - logout.php
# The user is redirected here from login.php

$message = "";

// If no cookie is present, redirect the user
if (!isset($_COOKIE['id'])) {
	// Need the functions
	require('includes/login.php');
	redirect_user();
} else { // Delete the cookies
	setcookie('id', '', time()-3600, '/', '', 0, 0);
	setcookie('first_name', '', time()-3600, '/', '', 0, 0);
	setcookie('last_name', '', time()-3600, '/', '', 0, 0);}

// Set the page title and include the HTML header
$page_title = 'Logged Out! ';
include('includes/header.html');

// Print the customized message
echo "<h1>Logged Out!</h1>
<p>You are now logged out, {$_COOKIE['first_name']}!</p>";

include('includes/footer.html');