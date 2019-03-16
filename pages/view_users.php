<?php 
# Script 10.5 - View_Users #5
# This script retrieves all the records from the users table. The new version paginates the query results.

$page_title = 'View the Current Users';
include('includes/header.html');
?>

<h1>Registered Users</h1>

<?php

require('includes/pagination_functions.inc.php'); // Get pagination functions

$pages = getPagesValue('users', 'id', 10);

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
<th align = "left"><strong>User Profile</strong></th>
<th align = "left"><strong><a href = "View_Users?sort=ln">Last Name</a></strong></th>
<th align = "left"><strong><a href = "View_Users?sort=fn">First Name</a></strong></th>
<th align = "left"><strong><a href = "View_Users?sort=rd">Date Registered</a></strong></th>
</tr>
</thead>
<tbody>
';

// Fetch and print all the records

$bg = '#eeeeee'; // Set the initial background color

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

	$bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee'); // Switch the background color every row

	echo '<tr bgcolor = "' . $bg . '">
	<td align = "left"><a href = "pages/edit_user.php/?id=' . $row['id'] . '">Edit</a></td>
	<td align = "left"><a href = "pages/delete_user.php?id=' . $row['id'] . '">Delete</a></td>
	<td align = "left"><a href = "users/' . $row['id'] . '">View Profile</a></td>
	<td align = "left">' . $row['last_name'] . '</td>
	<td align = "left">' . $row['first_name'] . '</td>
	<td align = "left">' . $row['dr'] . '</td>
	</tr>
	';

}

echo '</tbody></table>';
mysqli_free_result ($result);
mysqli_close($dbc);

setPreviousAndNextLinks();

include('includes/footer.html');

?>

