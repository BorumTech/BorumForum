<?php
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
	include('includes/login_functions.inc.php');

	// Generate query for question's information
	$query = 'SELECT name FROM topics WHERE name = "' . $_GET['topic'] . '"';
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$page_title = $row['name'];
	include('includes/header.html');
?>
	<h1><?php echo $row['name']; ?></h1>
</div>
	<?php

		mysqli_close($dbc);	
		include('includes/footer.html');
	?>