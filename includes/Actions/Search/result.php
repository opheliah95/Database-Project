<html>

<?php
include_once("../Helper/connection_handler.php");
// check session
if (check_session())
{
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