<?php
# Varun Singh adapted from Larry Ullman's script from book
# 12/17/2018
# This script is the template for the pages in Chapter 12

$page_title = 'Borum';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
}

?>

<div class = "col-sm-9">
	<div class = "home-page">
<!-- Script 3.7 - index.php -->

<div class = "page-header"><h1>Welcome to Borum</h1></div>
<p> <em>Empowering the world since 2019</em> </p>

<p>Borum is an interactive community where users from all over the world can ask questions and get answers.</p>

<button id="myButton" class="float-left submit-button">Sign Up</button>
</div>
<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "../Register";
    };
</script>
<?php 

include('includes/footer.html');
?>