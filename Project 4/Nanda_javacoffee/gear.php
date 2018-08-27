<?php
include "dbconn.php";

$products = array();
$sql = "SELECT * FROM Product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		array_push($products, array($row["ProductId"], $row["Name"], $row["Description"], $row["Product_Image_URL"]));
	}
}

$conn->close();

$title = "Gear - JavaJam Coffee House";
include "header.php";
?>
<article>
	<img src="images/herosofa.jpeg" width="100%">
	<section>
		<h1>JavaJam Gear</h1>
		<p>JavaJam gear not only looks good, it's good to your wallet, too.</p>
		<p>Get a 10% discount when you wear a JavaJam shirt or bring in your JavaJam mug!</p>
	</section>
	<section class="last"><?php
		for ($row = 0; $row < count($products); $row++) {
			if ($row > 0) {
				echo "<br>";
			}
			
			echo "<figure>";
			echo "<img src='" . $products[$row][3] . "' alt='" . $products[$row][1] . "' width='200px' height='186px'>";
			echo "<figcaption>";
			echo $products[$row][2];
			echo "<br>";
			echo "<form class='add-to-cart' method='post' action='cart.php'>";
			echo "<button type='submit' name='addToCart' value='" . $products[$row][0] . "'>Add to cart</button>";
			echo "</form>";
			echo "</figcaption>";
			echo "</figure>";
		}
		?></section>
</article>
<?php include "footer.php";?>
