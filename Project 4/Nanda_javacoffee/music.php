<?php
include "dbconn.php";

$performances = array();

$sql = "SELECT Performance.Month_Year, Performance.Description, " .
"Musician.Name, Musician.Musician_Image_URL FROM Performance " .
"INNER JOIN Musician ON Performance.MusicianId=Musician.MusicianId";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		array_push($performances, array($row["Name"], $row["Description"], $row["Month_Year"], $row["Musician_Image_URL"]));
	}
}

$conn->close();

$title = "Music - JavaJam Coffee House";
include "header.php";
?>
<article>
	<img src="images/heroguitar.jpg" width="100%">
	<section>
		<h2>Music at JavaJam</h2>
		<p>The first Friday night each month at JavaJam is a special night. Join us from 8 pm to 11 pm for some music you won't want to miss!</p>
	</section><?php
	for ($row = 0; $row < count($performances); $row++) {
		echo "<h3 class='music-h'>" . $performances[$row][2] . "</h3>";
		
		if ($row == count($performances) - 1) {
			echo "<section class='last'>";
		} else {
			echo "<section>";
		}
		
		echo "<figure class='performer'>";
		echo "<img src='" . $performances[$row][3] . "' alt='" . $performances[$row][0] . "' width='80px' height='80px'>";
		echo "<figcaption>" . $performances[$row][1] . "</figcaption>";
		echo "</figure>";
		echo "</section>";
	}
	?></article>
<?php include "footer.php";?>
