<?php 

require_once('../../../mysqli_connect.inc.php');


function getPagesValue($tablename, $columnname, $recsperpg) {
	define('DISPLAY', $recsperpg); // Number of records to show per page

	// Determine number of pages there are
	if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already determined
		$pages = $_GET['p'];
	} else { // Need to be determined

		// Count the number of records
		$query = "SELECT COUNT($columnname) FROM $tablename";
		$result = @mysqli_query($dbc, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_NUM);
		$records = $row[0];

		// Calculate the number of pages
		if($records > DISPLAY) { // More than 1 Page
			$pages = ceil($records / DISPLAY);
		} else { // 1 Page
			$pages = 1;
		}

	}

	return $pages;
}

function setPreviousAndNextLinks() {
	$pages = $_GET['p'];
	
	// Make the links to other pages, if necessary
	if ($pages > 1) {

		// Add some spacing and start a paragraph
		echo '<br><p>';

		// Determine what page the script is on
		$current_page = ($start / DISPLAY) + 1;

		// If it's not the first page, make a Previous button
		if($current_page != 1) {
			echo '<a href = "View_Users?s=' . ($start - DISPLAY) . '&p=' . $pages . '&sort=' .  $sort . '">Previous</a> ';
		}

		// Make all the numbered pages
		for ($i = 1; $i <= $pages; $i++) {
			if ($i != $current_page) {
				echo '<a href = "View_Users?s=' . (DISPLAY * ($i - 1)) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
			} else {
				echo $i . ' ';
			}
		}

		// If i's not the last page, make a Next button
		if ($current_page != $pages) {
			echo '<a href = "View_Users?s=' . ($start + DISPLAY) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
		}

		echo '</p>';
	}
}

?>