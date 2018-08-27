<?php
include "dbconn.php";

$updatedId = "";
$updatedValue = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST["addToCart"])) {
		if(!isset($_COOKIE[$_POST["addToCart"]])) {
			$updatedId = $_POST["addToCart"];
			$updatedValue = 1;
			setcookie($_POST["addToCart"], 1, time() + (86400 * 30), "/");
		} else {
			$current = $_COOKIE[$_POST["addToCart"]] + 1;
			$updatedId = $_POST["addToCart"];
			$updatedValue = $current;
			setcookie($_POST["addToCart"], $current, time() + (86400 * 30), "/");
		}
	}
}

$cart = array();
$total = 0;

$sql = "SELECT * FROM Product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if ($row["ProductId"] == (int)$updatedId) {
			$price = $row["Price"] * $updatedValue;
			$total = $total + $price;
			array_push($cart, array($row["ProductId"], $row["Name"], $updatedValue, $price));
		} else if (isset($_COOKIE[$row["ProductId"]])) {
			$price = $row["Price"] * $_COOKIE[$row["ProductId"]];
			$total = $total + $price;
			array_push($cart, array($row["ProductId"], $row["Name"], $_COOKIE[$row["ProductId"]], $price));
		}
	}
}

$conn->close();

$title = "Cart - JavaJam Coffee House";
include "header.php";
?>
<article class="cart-a">
	<section class="last">
		<h3>Shopping Cart</h3><?php
		if (count($cart) > 0) {
			echo "<table class='cart-t stripes'>";
			echo "<tbody>";
			echo "<tr>";
			echo "<th>Description</th>";
			echo "<th>Quantity</th>";
			echo "<th>Price</th>";
			echo "</tr>";
			
			for ($row = 0; $row < count($cart); $row++) {
				echo "<tr>";
				echo "<td>" . $cart[$row][1] . "</td>";
				echo "<td>" . $cart[$row][2] . "</td>";
				echo "<td>$" . sprintf('%0.2f', $cart[$row][3]) . "</td>";
				echo "</tr>";
			}
			
			echo "<tr>";
			echo "<td></td>";
			echo "<td>Total</td>";
			echo "<td>$" . sprintf('%0.2f', $total) . "</td>";
			echo "</tr>";
			echo "</tbody>";
			echo "</table>";
		} else {
			echo "<div class='cart-is-empty'>Your cart is empty!</div>";
		}
		?><div class="cart-options">
			<?php if (count($cart) > 0): ?>
			<form action="placeyourorder.php">
				<button type="submit">Place Order</button>
			</form>
			<?php endif; ?>
			<form action="gear.php">
				<button type="submit">Continue Shopping</button>
			</form>
		</div>
	</section>
</article>
<?php include "footer.php";?>
