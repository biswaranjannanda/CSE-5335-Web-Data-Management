<?php
include "dbconn.php";

$nameErr = $emailErr = $experienceErr = "";
$name = $email = $experience = $result = "";

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
	
	if (empty($_POST["experience"])) {
		$experienceErr = "title='Experience is required' style='border: 1px solid red;'";
	} else {
		$experience = $_POST["experience"];
		
		if (!preg_match("/^[a-z0-9- ]+$/i", $experience)) {
			$experienceErr = "title='Only letters, numbers, and are white space allowed' style='border: 1px solid red;'";
		}
	}
	
	if ($nameErr == "" && $emailErr == "" && $experienceErr == "") {
		$sql = "INSERT INTO job (Name, Email, Experience) VALUES ('$name', '$email', '$experience')";
		
		if ($conn->query($sql) === TRUE) {
			$result = "<span style='color: green;'>Your application was sent successfully!</span>";
		} else {
			$result = "<span style='color: red;'>An error occurred while trying to send your application.</span>";
		}
	}
}

$conn->close();

$title = "Jobs - JavaJam Coffee House";
include "header.php";
?>
<article class="jobs-a">
	<section>
		<h1>Jobs at JavaJam</h1>
		<p>Want to work at JavaJam? Fill out the form below to start your application. Required fields are marked with an asterisk (*).</p>
	</section>
	<section class="last">
		<form name="jobForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validate_job_form()">
			<table>
				<tbody>
					<tr>
						<td class="pull-right">*Name:</td>
						<td>
							<input type="text" name="name" <?php echo $nameErr;?> required>
						</td>
					</tr>
					<tr>
						<td class="pull-right">*E-mail:</td>
						<td>
							<input type="text" name="email" value="" <?php echo $emailErr;?> required>
						</td>
					</tr>
					<tr>
						<td class="pull-right">*Experience:</td>
						<td>
							<textarea name="experience" <?php echo $experienceErr;?> required></textarea>
						</td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Apply Now"></td>
					</tr>
				</tbody>
			</table>
		</form>
		<?php echo $result;?>
	</section>
</article>
<?php include "footer.php";?>
