<html>

<?php
// get include path
$parent_folder = "Admin";
$include_dir = explode($parent_folder, __DIR__)[0];
?>

<?php
// added db connection
include_once("../Helper/connection_handler.php");
// includes function file and path_handler
include_once($include_dir."functions.php");
include_once($include_dir."Helper/path_handler.php");
// directory path for process_add.php
$add_fine_path = "Actions/Add/process_fine.php";
$process_fine = $include_dir.$add_fine_path;
echo $process_add;
?>

<?php
include_once("../Helper/session_handler.php");
// if session variables are destroyed -- then leave the page
if (check_session())
{
	exit;
}
?>


<body>
<?php
	$self = $_SERVER['PHP_SELF'];
	// only admins are allowed on this page
	if ($_SESSION["role"] == "admin") {
		// set a variable for storing incident id, initial point in case user filled these first
		$txt=$id = "";
		
		// if later an incident id is send back
		if (isset($_GET["iid"])) {
			$id = $_GET["iid"];
		}
		
		
		// form 
		echo "<h2>Add Fine </h2>";
		
		echo "<form action = $self method = 'POST'>";
		// information about incident
		
		echo "Incident: ";
		// if there is information on incident
		if (isset($_GET["des"])) {
			$txt = $_GET["des"];
			echo $_GET["des"];
		}
		
		echo "<br>";
		
		// information about fine
		echo "&nbsp;&nbsp;&nbsp;Fine: <input type = 'text' name = 'fine'>";
		echo "<br>";
		
		// information about points
		echo "Points: <input type = 'text' name = 'point'>";
		echo "<br>";
		
		echo "<input type = 'hidden' name = 'id' value = '$id'>";
		echo "<input type = 'hidden' name = 'des' value = '$txt'>";
		echo "<br>";
		echo "<a href = 'select_incident.php?words=$txt&inci=$id' id = 'rightalign'> Select Incident </a>";
		echo "<input type = 'submit' name = 'submit' value = 'Save'>";
		echo "&nbsp;&nbsp;"; 
		echo "<input type = 'submit' name = 'cancel' value = 'Cancel'>";
		echo "</form>";
		
		
		// if there is error on the inputs
		 if (isset($_SESSION["error"])) {
			echo "*". $_SESSION["error"];
			unset($_SESSION["error"]);
		}
		
		
	}
?>

<?php
	include($process_fine); // add fine 
?>
</body>
</html>