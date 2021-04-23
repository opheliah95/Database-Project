<html>

<?php
// get include path
$parent_folder = "Actions";
$include_dir = explode($parent_folder, __DIR__)[0];

?>

<?php
// add helper path
include_once($include_dir."Helper/connection_handler.php");
//include session handler
include($include_dir."Helper/session_handler.php");

// check session
if (check_session())
{
	exit;
}
?>

<?php
// if user search by driver
if (isset($_GET["driver"])) {
	$report_path_rel = "Entities/People/people.php";
	$report_path_abs = generate_path_comm($report_path_rel);
	include($report_path_abs);
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