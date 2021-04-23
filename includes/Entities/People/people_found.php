<html>

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
// includes path_handler
include_once($include_dir."Helper\path_handler.php");
// url for process_add.php
$process_add = return_project_path()."Actions\Add\process_add.php";
$vehicle_found =return_project_path()."Entities\Vehicle\\vehicle_found.php";
?>

<?php
if (isset($_GET['num'])) {
	echo $_GET['num']. " people found";
	echo "<br><br>";
}

?>

<?php
if (isset($_GET['id'])) {
	$people_id = $_GET['id'];
	$sql = "SELECT * FROM People WHERE People_ID = '$people_id'";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		echo "<ul>";
		echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;
		      Name: ". $row['People_Name']. "</li>";
		echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;
		     Address: ". $row['People_Address']. "</li>";
		echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;
		     Driving licence: ". $row['People_Licence']. "</li>";
		echo "</ul><br><br>";
		
		// get information of vehicles if they have any
		
		$sql = "SELECT * FROM Vehicle
				WHERE Vehicle_ID IN 
				(SELECT Vehicle_ID FROM Ownership WHERE People_ID ='$people_id');";
		$result = mysqli_query($conn, $sql);
		$vehicle_rows = mysqli_num_rows($result);
				
		if ($vehicle_rows > 0) {
			echo "<ul>";
			while ($rows = mysqli_fetch_assoc($result)) {
			$id = $rows["Vehicle_ID"];
			echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;
				  Vehicle: " .$rows["Vehicle_Colour"]. ", ";
			echo  $rows["Vehicle_Type"]. "  ";
			echo  "(";
			echo "<a href = $vehicle_found?id=$id'>".$rows["Vehicle_Licence"]. "</a>";
			echo ") </li>";
			}
			echo "</ul>";
		} else {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  Vehicle: ";
		}
		echo "<br><br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <button><a href = 'edit_people.php?id=$people_id'class = 'a_button'>Edit </a></button>";
		
		
	}
	else {
		echo "There is an error, please go back";
	}
}
else {
	echo "error in this page";
}

?>

<body>
<br>
<br>
<form method = "GET" action = <?php $process_add?>>
<input type = "submit" name = "people" value = "Add new people">
<input type = "submit" name = "cancel" value = "Cancel">
</form>


</body>
</html>

