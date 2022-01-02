<?php 

# Script 12.6 - logout.php
# The user is redirected here from login.php

session_start();

$message = "";

// If no cookie is present, redirect the user
if (!isset($_COOKIE['id'])) {
	// Need the functions
	require('includes/login_functions.inc.php');
	redirect_user();
} else { // Delete the cookies
	$_SESSION = []; // Erase data from text file of sessions on server
	session_destroy(); // Remove the session data from the server
	setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the session cookie in the browser
	setcookie('dark', '', time()-3600, '/', '', 0, 0); // Remove dark cookie to set back to default theme for guest user
}

// Set the page title and include the HTML header
$page_title = 'Logged Out! ';
include('includes/header.html');
echo "<div class = 'col-sm-6'>";
// Print the customized message
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";

include('includes/footer.html');