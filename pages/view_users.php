<?php 
# Script 10.5 - view_users.php #5
# This script retrieves all the records from the users table. The new version paginates the query results.

$page_title = 'View the Current Users';
include('includes/header.html');
?>

<h1>Registered Users</h1>

<?php 
require_once('../../../mysqli_connect.inc.php');

define('DISPLAY', 10); // Number of records to show per page

// Determine number of pages there are
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already determined
	$pages = $_GET['p'];
} else { // Need to be determined

	// Count the number of records
	$query = "SELECT COUNT(id) FROM users";
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

// Determine where in the database to start returning results
if (isset($_GET['s']) && is_numeric($_GET['s'])) { // Set in the url
	$start = $_GET['s']; // Start at s
} else { // Not set in the url
	$start = 0; // Start from the beginning
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'rd'; // Define a sort variable to determine how query results are to be ordered

// Determine how the results should be ordered
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'rd':
		$order_by = 'registration_date ASC';
		break;
	default: 
		$order_by = 'registration_date ASC';
		$sort = 'rd';
		break;
}

// Define the query
$query = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, id FROM users ORDER BY $order_by LIMIT $start, " . DISPLAY;
$result = @mysqli_query($dbc, $query);

// Table header
echo '<table width = "60%">
<thead>
<tr>
<th align = "left"><strong>Edit</strong></th>
<th align = "left"><strong>Delete</strong></th>
<th align = "left"><strong><a href = "view_users.php?sort=ln">Last Name</a></strong></th>
<th align = "left"><strong><a href = "view_users.php?sort=fn">First Name</a></strong></th>
<th align = "left"><strong><a href = "view_users.php?sort=rd">Date Registered</a></strong></th>
</tr>
</thead>
<tbody>
';

// Fetch and print all the records

$bg = '#eeeeee'; // Set the initial background color

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

	$bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee'); // Switch the background color every row

	echo '<tr bgcolor = "' . $bg . '">
	<td align = "left"><a href = "edit_user.php?id=' . $row['id'] . '">Edit</a></td>
	<td align = "left"><a href = "delete_user.php?id=' . $row['id'] . '">Delete</a></td>
	<td align = "left">' . $row['last_name'] . '</td>
	<td align = "left">' . $row['first_name'] . '</td>
	<td align = "left">' . $row['dr'] . '</td>
	</tr>
	';

}

echo '</tbody></table>';
mysqli_free_result ($result);
mysqli_close($dbc);

// Make the links to other pages, if necessary
if ($pages > 1) {

	// Add some spacing and start a paragraph
	echo '<br><p>';

	// Determine what page the script is on
	$current_page = ($start / DISPLAY) + 1;

	// If it's not the first page, make a Previous button
	if($current_page != 1) {
		echo '<a href = "view_users.php?s=' . ($start - DISPLAY) . '&p=' . $pages . '&sort=' .  $sort . '">Previous</a> ';
	}

	// Make all the numbered pages
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href = "view_users.php?s=' . (DISPLAY * ($i - 1)) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	}

	// If i's not the last page, make a Next button
	if ($current_page != $pages) {
		echo '<a href = "view_users.php?s=' . ($start + DISPLAY) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>';
}

include('includes/footer.html');

?>

