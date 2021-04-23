<html>

<?php
include("../dbconnection.php");
session_start();
include("../header.php");
?>

<?php
// if session variables are destroyed
if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
	header("location:../login.php");
	exit;
}
?>

<?php
// if user search by driver
if (isset($_GET["driver"])) {
	include("../Entities/People/people.php");
}




// if user search by  vehicle
elseif(isset($_GET["vehicle"])) {
	include("vehicle.php");
}





elseif(isset($_GET["add"])) {
	header("location:../Edit/add_report.php");
	exit;
}





else {
	header("location:../login.php");
	exit;
}

?>



</body>
</html>