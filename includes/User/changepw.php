<html>

<body>
<?php
include_once("../dbconnection.php");
?>

<?php
session_start();
include_once("../header.php");
?>

<?php
include_once("../functions.php");
?>


<?php
	if (isset($_SESSION["user"]) && isset($_SESSION["id"])) {
		if (count($_POST) > 0) {

		// if user choose to cancel the process
		if (isset($_POST["cancel"])) {
			header("location: userpage.php");
			exit;
		}
		// if user pressed okay
		elseif (isset($_POST["ok"])) {
			$user_id = $_SESSION["id"];
			// check whether inputs contain nulls or not
			if (isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["repeatpass"])) {

				// make sure each field is not empty
				if($_POST["oldpass"] == "") {
					$_SESSION["oldpass_error"] = "* Old password required";
				} elseif (!password_match($conn, $_POST["oldpass"], $user_id)) {
					$_SESSION["oldpass_error"] = "* Old password did not match original password";
				}

				if($_POST["newpass"]== "") {
					$_SESSION["newpass_error"] =  "* New password required";
				}

				if($_POST["repeatpass"]== "") {
					$_SESSION["repeatpass_error"] =  "* Repeat required";
				}
				elseif ($_POST["newpass"] != $_POST["repeatpass"]) {
					// check whether new password entered matches with the repetition
					$_SESSION["repeatpass_error"] = "* Did not match newly entered password";
				}

				/* if none of the fields are empty, check whether old password is correct
				 * whether new password match the repeated password
				 * if all criteria met then change the password
				 */
				 if ($_POST["oldpass"] != "" && $_POST["newpass"] != ""
					&& $_POST["repeatpass"] != ""
					&& password_match($conn, $_POST["oldpass"], $user_id)
					&& $_POST["newpass"] == $_POST["repeatpass"]) {

					// when exact match is found can change password
					$id = $_SESSION['id'];
					$password = $_POST['newpass'];
					$sql = "UPDATE Officer
								SET Officer_Password = '$password'
								WHERE Officer_ID = '$id';";
					$result = mysqli_query($conn, $sql);

					// check if change is successful
					if ($result) {
						header("location: ../States/success.php");
						exit;
					} else {
						header("location: ../States/fail.php");
						exit;
					}

				 }


			}


		}


			// redirect user
			header("Location: changepw.php?" , true, 303);
			exit;
		}


	}
	else {
		// if session variables are destroyed
		header("location: login.php");
	}

	mysqli_close($conn);
?>


<form action = "changepw.php" method = "POST">
Old password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type = "password" name = "oldpass" placeholder = "old password">
<?php
	if (isset($_SESSION["oldpass_error"])) {
		echo $_SESSION["oldpass_error"];
		unset($_SESSION["oldpass_error"]);
	}
?>

<br>

New password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type = "password" name = "newpass" placeholder = "new password">
<?php
if(isset($_SESSION["newpass_error"])) {
	echo $_SESSION["newpass_error"];
	unset($_SESSION["newpass_error"]);
}
?>

<br>

Repeat password:&nbsp; <input type = "password" name = "repeatpass" placeholder = "repeat password">
<?php
if(isset($_SESSION["repeatpass_error"])) {
	echo $_SESSION["repeatpass_error"];
	unset($_SESSION["repeatpass_error"]);
}
?>
<br><br>

<input type = "submit" value = "Ok" name = "ok">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type = "submit" value = "Cancel" name = "cancel">
</form>


</body>
</html>
