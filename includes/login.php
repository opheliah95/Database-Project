<?php
include_once "header.php";
include_once "dbconnection.php";
?>

<?php
// check whether variables are set or null
if (isset($_POST["name"]) && isset($_POST["password"])) {
	// if the username is empty
	if ($_POST["name"] == "") {
		$name_error = "Username cannot be empty";
		header("Location: ../index.php?login=failed&error=$name_error");
	}
	// if password is empty
	if ($_POST["password"] == "") {
		$password_error = "Password cannot be empty";
		header("Location: ../index.php?login=failed&error=$password_error");
	}

	/* when user entered both username and password
	 * check whether the information is correct
	 */
	if ($_POST["name"]!= ""&& $_POST["password"] != "") {
		$username = $_POST["name"];
		$password = $_POST["password"];

		// sql query to check whether there is matching result
		$sql = "SELECT * FROM Officer WHERE Officer_Username = '$username' AND Officer_Password = '$password';";
		$result = mysqli_query($conn, $sql);
		$total_row = mysqli_num_rows($result); # count number of rows

		// if there is exact match then move on to user's page
		if ($total_row == 1) {
			# get the role of the user
			$row = mysqli_fetch_assoc($result);
			session_start();
			$_SESSION["user"] = $username;
			$_SESSION["role"] = $row["Officer_Role"];
			$_SESSION["id"] = $row["Officer_ID"];
			header("location: User/userpage.php");
			exit;

		} else {
			$login_error = "Incorrect username or password...";
			header("Location: ../index.php?login=failed&error=$login_error");
		}
	}

}

mysqli_close($conn);
?>
