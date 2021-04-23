<html>
<?php
include_once("../Helper/connection_handler.php");
?>

<?php
include("../Helper/session_handler.php");
// if session variables are destroyed -- then leave the page
if (check_session())
{
	exit;
}
?>

<?php
include("../functions.php");
?>

<body>
<form action = "../Actions/Search/result.php" method = "GET" class = "bt1">
Enter search term: <input type = "text" name = "search" placeholder= "Search..." size = "35">
<input type = "submit" name = "driver" value = "Driver">
<input type = "submit" name = "vehicle" value = "Vehicle">
<input type = "submit" name = "add" value = "Add report"  >
</form>

<?php
$self = $_SERVER['PHP_SELF'];
echo "<form action = $self method = 'GET' class = 'bt1'>";
if ($_SESSION["role"] == "admin") {
	echo "<input type = 'submit' name = 'viewall' value = 'View all reports' >";
	echo "</form>";

}
elseif ($_SESSION["role"] == "user") {
	echo "<input type = 'submit' name = 'view' style = 'width: 160px'";
	echo "value = \"View ".$_SESSION['user']. "'s report\">";
	echo "</form>";
}

?>



<?php
// view all fines
if ($_SESSION["role"] == "admin") {
	echo "<form action = 'userpage.php' method = 'GET' class = 'bt2'>";
	echo "<input type = 'submit' name = 'viewfine' value = 'View fines'>";
	echo "</form>";
}

// add fines
if ($_SESSION["role"] == "admin") {
	echo "<form action = 'addfine.php' method = 'GET' class = 'bt2'>";
	echo "<input type = 'submit' name = 'addfine' value = 'Add fines'>";
	echo "</form>";
}

echo "<br><br><br><br><br>";

if (isset($_GET["viewfine"])) {
	view_fines($conn);
}
?>






<?php
// view for normal officers
if (isset($_GET["view"])) {
	$user_id = $_SESSION["id"];
	indv_report($conn, $user_id);
}

?>


<?php
// view reports for admin
if (isset($_GET["viewall"])) {
	all_report($conn);
}

?>


</body>
</html>
