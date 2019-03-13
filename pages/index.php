<?php
# Varun Singh adapted from Larry Ullman's script from book
# 12/17/2018
# This script is the template for the pages in Chapter 12

// This function outputs theoretical HTML for adding ads to a web page
function create_ad() {
	echo '<div class = "alert alert-info" role = "alert"><p>This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
} // End of the function definition

$page_title = 'Welcome to this Site!';
include('includes/header.html');

// Call the function
create_ad();
?>

<!-- Script 3.7 - index.php -->

<div class = "page-header"><h1>Borum</h1></div>
<p> <em>Empowering the world since 2019</em> </p>

<p>Borum is an interactive community where users from all over the world can ask questions about categories that start with or rhyme with 'bor-'.</p>

<button id="myButton" class="float-left submit-button" >Sign Up - It's FREE</button>

<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "register.php";
    };
</script>
<?php 
// Call the function again
create_ad();

include('includes/footer.html');
?>