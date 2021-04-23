<html>

<?php
// get include path
$parent_folder = "Admin";
$include_dir = explode($parent_folder, __DIR__)[0];
$self = $_SERVER['PHP_SELF'];
?>

<?php
// added db connection
include_once("../Helper/connection_handler.php");

// includes function file and path_handler
include_once($include_dir."functions.php");
include_once($include_dir."Helper/path_handler.php");

// url for process_add.php
$process_add = return_project_path()."Actions/Add/process_add.php";
$add_fine = return_project_path()."Admin/addfine.php";

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
// only adminstrators can access this page
if ($_SESSION["role"] == "admin") {
	// get list of values so when user press back the previous values are still avaliable
	$txt = trim(isset($_GET["words"])?$_GET["words"]: "");
	$report = trim(isset($_GET["inci"])?$_GET["inci"]: "");
	
	echo "<form action = $self method = 'GET'>";
	echo "Search driver or driver licence: ";
	echo "&nbsp;&nbsp;"; 
	echo "<input type = 'text' name = 'search' placeholder = 'Search...' size = '35'>";
	echo "<br>";
	// hidden values
	echo "<input type = 'hidden' name = 'words' value = '$txt'>";
	echo "<input type = 'hidden' name = 'inci' value = '$report'>";
	echo "<input type = 'submit' name = 'submit' value = 'Search'>";
	echo "&nbsp;&nbsp;&nbsp;"; 
	echo "<input type = 'submit' name = 'cancel' value = 'Cancel'>";
	echo "</form>";	
}
?>


<?php
// see whether user did an empty search or not
if (isset($_GET["submit"])) {
	// if search box is empty
		if($_GET["search"]== "") {
			$sql = "SELECT * FROM People
					NATURAL JOIN Incident
					NATURAL JOIN Offence;";
			$result = mysqli_query($conn, $sql);
			// get the list of results
			echo "<ul>";
			while ($rows = mysqli_fetch_assoc($result)) {
				// get incident id
				$people = $rows["People_Name"];
				$people_address = $rows["People_Address"];
				$people_licence = $rows["People_Licence"];
				$date = $rows["Incident_Date"];
				$time = $rows["Incident_Time"];
				$incident_id = $rows["Incident_ID"];
				$offence = $rows["Offence_Description"];
				
				$str = $people. "(".$date. " ". $time. ") - ".$offence;
				echo "<li>";
				echo "<a href = '$add_fine?des=$str&iid=$incident_id'>";
				echo $date. " ". $time;
				echo "</a>";
				echo " - ".$offence;
				echo "<br>";
				echo $people. " , ". $people_address. " , ". $people_licence;
				echo "</li>";
			}
			echo "</ul>";
			
		} else {
			// if search is not empty
			// querying database by matching people's name or licence
			$search = $_GET["search"];
			$sql = "SELECT * FROM People 
					WHERE (People_Name Like '%$search%') 
					OR(People_Licence = '$search');";
			$result01 = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result01) != 0) {
				while ($people_rows = mysqli_fetch_assoc($result01)) {
					$pid = $people_rows["People_ID"]; # check one person at a time
					$pname = $people_rows["People_Name"];
					$paddress = $people_rows["People_Address"];
					$plicence = $people_rows["People_Licence"];
					
					
					// check if the people has report associated to them
					$sql = "SELECT * FROM Incident WHERE People_ID = '$pid'";
					$result = mysqli_query($conn, $sql);
					
					// if the people is associated with a report
					if (mysqli_num_rows($result) != 0) {
						while ($incident_rows = mysqli_fetch_assoc($result)) {
							// since one report records one offence, so can get the offence through offence id
							$oid = $incident_rows["Offence_ID"];
							$offence = select_offence($conn, $oid);
							$date = $incident_rows["Incident_Date"];
							$time = $incident_rows["Incident_Time"];
							$incident_id = $incident_rows["Incident_ID"];
							
							$str = $pname. "(".$date. " ". $time. ") - ".$offence;
							echo "<a href = '$add_fine?des=$str&iid=$incident_id'>";
							echo $date. " ". $time;
							echo "</a>";
							echo " - ".$offence;
							echo "<br>";
							echo $pname. " , ". $paddress. " , ". $plicence;
							echo "<br><br>";
							
						}
						
						
					} else {
						echo "No report about ". $pname. " is found <br>";
					}
					
				}
				
			} else {
				echo "Person not found";
			}
			
			
		}
	
}
elseif(isset($_GET["cancel"])) {

	header("location: $add_fine?des=$txt&iid=$report");
	exit;
	
}

?>