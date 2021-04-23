<html>
<body>

<?php
// get include path
$parent_folder = "Entities";
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
// keep path to process_add.php
$process_add = return_project_path()."Actions\Add\process_add.php";
$people_found= return_project_path()."Entities\People\people_found.php";
?>

<?php
// if vehicle is found through search engine
if (isset($_GET['num'])) {
	echo "Vehicle found: ";
	echo "<br><br>";
}

?>


<?php
// when exact one match
echo "<div class = 'd1'>";

if (isset($_GET['id'])) {
	$vehicle_id = $_GET['id'];
	$sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = '$vehicle_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		// format the result as a list
		echo "<ul>";
		echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;License: ". $row['Vehicle_Licence']. "</li>";
		echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;Color: ". $row['Vehicle_Colour']. "</li>";
		echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;Type: ". $row["Vehicle_Type"]. "</li>";
		echo "</ul><br><br>";
				
		// search for owners of the vehicle
		$vehicle_id = $row['Vehicle_ID'];
		$sql = "SELECT * FROM People
				WHERE People_ID IN
				(SELECT People_ID FROM Ownership WHERE Vehicle_ID = '$vehicle_id');";
		$result = mysqli_query($conn, $sql);
				
		if (mysqli_num_rows($result) > 0) {
			echo "<ul>";
			while ($rows = mysqli_fetch_assoc($result)) {
			$people_id = $rows["People_ID"];
				echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;Owner: ";
				echo  $rows["People_Name"];
				echo " (";
				echo "<a href = '$people_found?id=$people_id'>".$rows["People_Licence"]. "</a>";
				echo ")";
				echo "</li>";
			}
			echo "</ul>";
					
		} else {
			echo "<ul>";
			echo "<li>Owner: </li>";
		    echo "</ul>";
		}
		
		// when exact one car found, press edit, you can edit them
		echo "<br><br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <button><a href = 'edit_vehicle.php?vid=$vehicle_id'class = 'a_button'>Edit </a></button>";
		
	} else {
		echo "no results found, please go back";
	}
	
} else {
	echo "id variable unset, please go back";
}

?>



<br><br><br>
<form method = "GET" action = <?php echo $process_add?>>
<input type = "submit" name = "vehicle" value = "Add new vehicle">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type = "submit" name = "cancel" value = "Cancel">
</form>

</div>
</body>
</html>