<?php 
$page_title = "The Silicon Valley Journal";
	require('includes/header.html');
?>
	<div class = "main-content">
		<?php 

		require('../../../svj_connect.inc.php');
		$result = mysqli_query($dbc, "SELECT articles.id, articles.title, articles.body, CONCAT(YEAR(articles.`date_written`), '/', MONTH(`articles`.`date_written`), '/', DAYOFMONTH(`articles`.`date_written`)), columns.name, columns.id FROM articles JOIN columns ON columns.id = articles.column_id ORDER BY articles.date_written DESC");
		echo "<div class = 'latest-articles'>";
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
			echo "<div class = 'new-article'>";
			echo "<a href = \"articles/{$row['name']}/{$row[3]}/{$row['title']}\">";
			echo "<h2>" . $row[1] . "</h2>";
			echo "<span>" . $row[3] . "</h2>";
			echo "</a></div>";
		}
		
		?>
	</div>
<?php
	require('includes/footer.html');
?>

