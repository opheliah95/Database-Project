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
// if session variables are destroyed
if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
	header("location: ../login.php");
	exit;
}
mysqli_close($conn);
?>

<div class = "pop">
<p>You have successfully changed your password</p><br>
<button> <a href = "../User/userpage.php" class = "a_button">Okay </a></button>
</div>

</body>
</html>
