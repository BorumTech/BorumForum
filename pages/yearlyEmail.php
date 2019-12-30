<?php 
session_start();
$page_title = "Contact Us";

// Fetch email from database
include('../../mysqli_connect.inc.php');
include('includes/helpers.php');
$q = "SELECT id, email, first_name FROM users";
$r = mysqli_query($dbc, $q);

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
  sendEmail("Your 2019 on Borum", "<img src = 'http://www.bforborum.com/images/BorumYearlyEmail.png'><h2>Thank you {$row['first_name']}! Here's a look into your 2019 on Borum</h2><p>Borum had a great year, thanks to people like you. Let's look back at how you helped share and grow the world's knowledge this year.</p><table><tr><td>4</td><td>10</td><td>3</td></tr><tr><td>answers written</td><td>questions asked</td><td>topics followed</td></tr></table><hr><h2>Thanks for a great year on Borum, and we look forward to seeing you in 2020!</h2>", "{$row['email']}");
}

?>

