<?php
// get include path
$parent_folder = "Entities";
$include_dir = explode($parent_folder, __DIR__)[0];
?>

<?php
// includes function file and path_handler
include_once($include_dir."functions.php");
include_once($include_dir."Helper\path_handler.php");
// url for process_add.php
$process_add = return_project_path()."Actions\Add\process_add.php";
?>

<?php
if (isset($_GET["search"])) {
		// if serach box is empty
		if ($_GET["search"] == "") {
			$sql = "SELECT * FROM Vehicle;";
			$result = mysqli_query($conn, $sql);
			echo  "Vehicles found: ";
			
			// get the list of results
			echo "<ul>";
			while ($rows = mysqli_fetch_assoc($result)) {
				$id = $rows["Vehicle_ID"];
				echo "<li>";
				echo "&nbsp;&nbsp;&nbsp;";
				echo "<a href ='vehicle_found.php?id=$id'>".$rows["Vehicle_Licence"]. "</a>";
				echo ": ". $rows["Vehicle_Colour"];
				echo ", ". $rows["Vehicle_Type"];
				echo "</li>";
			}
			echo "</ul>";
		}
		else {
			// if vehicle is not empty, search by full number plate, assume number plate is unique
			$plate = $_GET["search"];
			$sql = "SELECT * FROM Vehicle WHERE Vehicle_Licence = '$plate';";
			$result = mysqli_query($conn, $sql);
			
			// if there is only one result
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$id = $row["Vehicle_ID"];
				/* add header to get the result: i.e. id for getting car information
				 * num for display header if vehicle is found through search engine
				*/
				header("location:vehicle_found.php?id=$id&num=1");
			} else {
			   // if no car is found, not possible two have 2 cars since licence is set as unique
			   echo "Vehicle ". $plate. " not found!";
			}
			
		} 
				
			
} else {
		echo "Error message here";
}
?>

<br>
<br>

<form method = 'GET' action = <?php echo $process_add?>>
<input type = "submit" name = "vehicle" value = "Add new vehicle">
<input type = "submit" name = "cancel" value = "Cancel">
</form>

