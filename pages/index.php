<?php
# Varun Singh adapted from Larry Ullman's script from book
# 12/17/2018
# This script is the template for the pages in Chapter 12

$page_title = 'Borum';
include('includes/header.html');

?>

<div class = "col-sm-9">
	<div class = "home-page">
<!-- Script 3.7 - index.php -->

<div class = "page-header"><h1>Welcome to Borum</h1></div>
<p> <em>Empowering the world since 2019</em> </p>

<p>Borum is an interactive community where users from all over the world can ask questions and get answers. </p>
<div id = "products">
	<h2>Products</h2>
	<ul>
		<li><a href = "http://weather.bforborum.com">Borum Weather</a></li>
		<li><a href = "http://feasts.bforborum.com">Borum Feasts</a></li>
		<li><a href = "http://restaurants.bforborum.com">Borum Restaurants</a></li>
		<li><a href = "http://news.bforborum.com">Borum News</a></li>
		<li><a href = "http://documents.bforborum.com">Borum Documents</a></li>
		<li><a href = "http://presentations.bforborum.com">Borum Presentation</a></li>
		<li><a href = "http://spreadsheets.bforborum.com">Borum Spreadsheets</a></li>
		<li><a href = "http://forms.bforborum.com">Borum Forms</a></li>
		<li><a href = "http://drive.bforborum.com">Borum Drive</a></li>
		<li><a href = "http://shows.bforborum.com">Borum Shows</a></li>
	</ul>
</div>
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