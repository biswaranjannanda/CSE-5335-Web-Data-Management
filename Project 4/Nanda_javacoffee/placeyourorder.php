<?php
include "dbconn.php";

$nameErr = $emailErr = $addressErr = $cityErr = $stateErr = $zipErr = $creditErr = $expMonErr = $expYrErr = "";
$name = $email = $address = $city = $state = $zip = $credit = $expMon = $expYr = $orderResult = "";
$showCart = true;

$states	= array(
	'AL' => 'Alabama',
	'AK' => 'Alaska',
	'AZ' => 'Arizona',
	'AR' => 'Arkansas',
	'CA' => 'California',
	'CO' => 'Colorado',
	'CT' => 'Connecticut',
	'DE' => 'Delaware',
	'FL' => 'Florida',
	'GA' => 'Georgia',
	'HI' => 'Hawaii',
	'ID' => 'Idaho',
	'IL' => 'Illinois',
	'IN' => 'Indiana',
	'IA' => 'Iowa',
	'KS' => 'Kansas',
	'KY' => 'Kentucky',
	'LA' => 'Louisiana',
	'ME' => 'Maine',
	'MD' => 'Maryland',
	'MA' => 'Massachusetts',
	'MI' => 'Michigan',
	'MN' => 'Minnesota',
	'MS' => 'Mississippi',
	'MO' => 'Missouri',
	'MT' => 'Montana',
	'NE' => 'Nebraska',
	'NV' => 'Nevada',
	'NH' => 'New Hampshire',
	'NJ' => 'New Jersey',
	'NM' => 'New Mexico',
	'NY' => 'New York',
	'NC' => 'North Carolina',
	'ND' => 'North Dakota',
	'OH' => 'Ohio',
	'OK' => 'Oklahoma',
	'OR' => 'Oregon',
	'PA' => 'Pennsylvania',
	'RI' => 'Rhode Island',
	'SC' => 'South Carolina',
	'SD' => 'South Dakota',
	'TN' => 'Tennessee',
	'TX' => 'Texas',
	'UT' => 'Utah',
	'VT' => 'Vermont',
	'VA' => 'Virginia',
	'WA' => 'Washington',
	'WV' => 'West Virginia',
	'WI' => 'Wisconsin',
	'WY' => 'Wyoming',
	'DC' => 'Washington D.C.'
);

$months	= array(
	'01' => 'January',
	'02' => 'February',
	'03' => 'March',
	'04' => 'April',
	'05' => 'May',
	'06' => 'June',
	'07' => 'July',
	'08' => 'August',
	'09' => 'September',
	'10' => 'October',
	'11' => 'November',
	'12' => 'December'
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
		$nameErr = "title='Name is required' style='border: 1px solid red;'";
	} else {
		$name = $_POST["name"];
		
		if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
			$nameErr = "title='Only letters and white space are allowed' style='border: 1px solid red;'";
		}
	}
	
	if (empty($_POST["email"])) {
		$emailErr = "title='Email is required' style='border: 1px solid red;'";
	} else {
		$email = $_POST["email"];
		
		if (!preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
			$emailErr = "title='Invalid email format' style='border: 1px solid red;'";
		}
	}
	
	if (empty($_POST["address"])) {
		$addressErr = "title='Address is required' style='border: 1px solid red;'";
	} else {
		$address = $_POST["address"];
		
		if (!preg_match("/^[a-z0-9- ]+$/i", $address)) {
			$addressErr = "title='Only letters, numbers, and are white space allowed' style='border: 1px solid red;'";
		}
	}
	
	if (empty($_POST["city"])) {
		$cityErr = "title='City is required' style='border: 1px solid red;'";
	} else {
		$city = $_POST["city"];
		
		if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
			$cityErr = "title='Only letters and white space are allowed' style='border: 1px solid red;'";
		}
	}
	
	if (empty($_POST["state"]) || $_POST["state"] == "") {
		$stateErr = "title='State is required' style='border: 1px solid red;'";
	} else {
		$state = $_POST["state"];
	}
	
	if (empty($_POST["zip"])) {
		$zipErr = "title='Zip Code is required' style='border: 1px solid red;'";
	} else {
		$zip = $_POST["zip"];
		
		if (!(ctype_digit($zip)) || strlen($zip) != 5) {
			$zipErr = "title='Invalid Zip Code format' style='border: 1px solid red;'";
		}
	}
	
	if (empty($_POST["credit"])) {
		$creditErr = "title='Credit Card is required' style='border: 1px solid red;'";
	} else {
		$credit = $_POST["credit"];
		
		if (!(ctype_digit($credit)) || strlen($credit) != 16) {
			$creditErr = "title='Invalid Credit Card Number' style='border: 1px solid red;'";
		}
	}
	
	if (empty($_POST["expMon"]) || $_POST["expMon"] == "") {
		$expMonErr = "title='Expiration Month is required' style='border: 1px solid red;'";
	} else {
		$expMon = $_POST["expMon"];
	}
	
	if (empty($_POST["expYr"])) {
		$expYrErr = "title='Expiration Year is required' style='border: 1px solid red;'";
	} else {
		$expYr = $_POST["expYr"];
		
		if (!(ctype_digit($expYr)) || strlen($expYr) != 4) {
			$expYrErr = "title='Invalid Expiration Year' style='border: 1px solid red;'";
		}
	}
	
	if ($nameErr == "" && $emailErr == "" && $addressErr == "" && $cityErr == "" &&
	$stateErr == "" && $zipErr == "" && $creditErr == "" && $expMonErr == "" && $expYrErr == "") {
		$sql = "INSERT INTO orders (Name, EmailID, Address, City, State, Zip, Credit_Card, Month, Year)" .
		" VALUES ('$name', '$email', '$address', '$city', '$state', '$zip', '$credit', '$expMon', '$expYr')";
		
		if ($conn->query($sql) === TRUE) {
			$orderId = $conn->insert_id;
			
			for ($i = 1; $i < 5; $i++) {
				if (isset($_COOKIE[$i])) {
					$sql2 = "INSERT INTO orderedcontent (OrderId, ProductId, Quantity) VALUES ('$orderId', '$i', '" . $_COOKIE[$i] . "')";
					$conn->query($sql2);
					setcookie($i, 0, time() - 3600, "/");
				}
			}
			
			$orderResult = "<span style='color: green;'>Your order was processed successfully!</span>";
			$showCart = false;
		} else {
			$orderResult = "<span style='color: red;'>An error occurred while trying to process your order.</span>";
		}
	}
}

$cart = array();
$total = 0;

$sql = "SELECT * FROM Product";
$result = $conn->query($sql);

if ($showCart && $result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if (isset($_COOKIE[$row["ProductId"]])) {
			$price = $row["Price"] * $_COOKIE[$row["ProductId"]];
			$total = $total + $price;
			array_push($cart, array($row["ProductId"], $row["Name"], $_COOKIE[$row["ProductId"]], $price));
		}
	}
}

$conn->close();

$title = "Order - JavaJam Coffee House";
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
		} else if ($orderResult != "") {
			echo "<div class='cart-is-empty'>" . $orderResult . "</div>";
		} else {
			echo "<div class='cart-is-empty'>Your cart is empty!</div>";
		}
		?>
		<?php if (count($cart) > 0): ?>
		<div>
			<form name="orderForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validate_order_form()">
				<fieldset class="order-f">
					<legend>Fill Details:</legend>
					<div class="single">
						<span>Name</span>
						<input name="name" type="text" <?php echo $nameErr;?> required>
					</div>
					<div class="single">
						<span>Email</span>
						<input name="email" type="text" <?php echo $emailErr;?> required>
					</div>
					<div class="single">
						<span>Address</span>
						<input name="address" type="text" <?php echo $addressErr;?> required>
					</div>
					<div class="single">
						<span>City</span>
						<input name="city" type="text" <?php echo $cityErr;?> required>
					</div>
					<div class="double">
						<div>
							<span>State</span>
							<select name="state" <?php echo $stateErr;?> required>
								<option value="" selected>(Select)</option>
								<?php
								foreach ($states as $value => $label):
									echo "<option value='" . $value . "'>" . $label . "</option>";
								endforeach;
								?>
							</select>
						</div>
						<div>
							<span>Zip</span>
							<input name="zip" type="number" <?php echo $zipErr;?> required>
						</div>
					</div>
					<div class="single">
						<span>Credit Card</span>
						<input name="credit" type="number" <?php echo $creditErr;?> required>
					</div>
					<div class="double">
						<div>
							<span>Expire Month</span>
							<select name="expMon" <?php echo $expMonErr;?> required>
								<option value="" selected>(Select)</option>
								<?php
								foreach ($months as $value => $label):
									echo "<option value='" . $value . "'>" . $label . "</option>";
								endforeach;
								?>
							</select>
						</div>
						<div>
							<span>Year</span>
							<input name="expYr" type="number" <?php echo $expYrErr;?> required>
						</div>
					</div>
					<input type="submit" name="place_order" value="Order Now">
					<br>
					<?php echo $orderResult;?>
				</fieldset>
			</form>
		</div>
		<?php else: ?>
		<div class="cart-options">
			<form action="gear.php">
				<button type="submit">Continue Shopping</button>
			</form>
		</div>
		<?php endif; ?>
	</section>
</article>
<?php include "footer.php";?>
