<?php 
$page_title = "{$_COOKIE['first_name']}'s Profile";
include('includes/header.html');

echo "<div style = 'float:right'><p>{$_COOKIE['first_name']} {$_COOKIE['last_name']}</p></div>";
echo '<textarea rows="10" cols="50"></textarea>';

include('includes/footer.html');