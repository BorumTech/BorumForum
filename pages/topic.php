<?php
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
	include('includes/login_functions.inc.php');

	// Generate query for question's information
	$query = 'SELECT id, name FROM topics WHERE name = "' . $_GET['topic'] . '"';
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$page_title = $row['name'];
	include('includes/header.html');
?>
	<h1><?php echo $row['name']; ?></h1>
	<?php
		require('includes/pagination_functions.inc.php');

		define('DISPLAY', 10); // Number of records to show per page

		$pages = getPagesValue('id', 'messages', 'WHERE forum_id = ' . $row['id']);
		$start = getStartValue();

		$q = 'SELECT id, subject FROM messages WHERE parent_id = 0 AND forum_id = ' . $row['id'];
		$result = performPaginationQuery($q, 'date_entered DESC', $start, $dbc);

		echo "<table id = 'latest-questions'>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

			echo "
			<tr><td align = \"left\"><a href = \"../Questions/{$row['id']}\">{$row['subject']}</a></td></tr>
			";

		}
		echo "</table>";

		mysqli_free_result($result);

		setPreviousAndNextLinks('../Topics/' . $_GET['topic']);


		mysqli_close($dbc);	
		include('includes/footer.html');
	?>