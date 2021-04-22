<?php

function check_people($conn, $id) {
	$sql = "SELECT * FROM People WHERE People_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	// happen to have one match, i.e. one unique corrosponding person
	if (mysqli_num_rows($result)== 1){
		return True;
	}else {
		return False; // no or multiple corrospondence
	}
}

// check if vehicle is valid
function check_vehicle($conn, $id) {
	$sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	// happen to have one match, i.e. one unique corrosponding vehicle
	if (mysqli_num_rows($result)== 1){
		return True;
	}else {
		return False; // no or multiple corrospondence
	}
}

// check if offence is valid 
function check_offence($conn, $id) {
	$sql = "SELECT * FROM Offence WHERE Offence_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	// happen to have one match, i.e. one unique corrosponding vehicle
	if (mysqli_num_rows($result)== 1){
		return True;
	}else {
		return False; // no or multiple corrospondence
	}
	
}

// check if incident is valid 
function check_incident($conn, $id) {
	$sql = "SELECT * FROM Incident WHERE Incident_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	// happen to have one match, i.e. one unique corrosponding vehicle
	if (mysqli_num_rows($result)== 1){
		return True;
	}else {
		return False; // no or multiple corrospondence
	}
	
}

// selects name that corrosponds to a people id
function select_people($conn, $id) {
	$name = "";
	$sql = "SELECT * FROM People WHERE People_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	// happen to have one match, i.e. one unique corrosponding person
	if (mysqli_num_rows($result)== 1){
		$row = mysqli_fetch_assoc($result);
		$name = $row["People_Name"];
	}
	return $name;
}


// assign ownership
function assign_ownership($conn,$vid, $pid){
	$sql = "INSERT INTO Ownership (People_ID, Vehicle_ID)
			VALUES ('$pid', '$vid');";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return True;
	} else {
		return False;
	}
}



// check whether plate repeats
function plate_norepeat($conn, $plate) {
	$sql = "SELECT * FROM Vehicle WHERE Vehicle_Licence = '$plate'";
	$result = mysqli_query($conn, $sql);
	// check if there is same one in database or not 
	if (mysqli_num_rows($result) == 0) {
		return True;
	} else {
		return False;
	}
}

// check if licence number repeats
function licence_norepeat($conn, $licence) {
	$sql = "SELECT * FROM People WHERE People_Licence = '$licence'";
	$result = mysqli_query($conn, $sql);
	// check if there is same one in database or not 
	if (mysqli_num_rows($result) == 0) {
		return True;
	} else {
		return False;
	}
	
}


// insert new vehicle
function insert_vehicle($conn, $plate, $color, $type) {
	$sql = "INSERT INTO Vehicle (Vehicle_Licence, Vehicle_Colour,Vehicle_Type)
			VALUES ('$plate', '$color', '$type');";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return True;
	} else {
		return False;
	}
}

// insert new person
function insert_people($conn, $licence, $address, $name) {
	$sql = "INSERT INTO People (People_Licence, People_Address,People_Name)
			VALUES ('$licence', '$address', '$name');";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return True;
	} else {
		return False;
	}
}

// get vehicle id
function get_vehicle_id($conn, $plate) {
	$id = ""; # initialize id
	$sql = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_Licence = '$plate';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$id = $row[0];
	return $id;
}

// get people id
function get_people_id($conn, $licence) {
	$id = ""; # initialize id
	$sql = "SELECT People_ID FROM People WHERE People_Licence = '$licence';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$id = $row[0];
	return $id;
	
}


// get an array of vehicle properties
function vehicle_properties($conn, $vid) {
	$sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = '$vid';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}




// select offence description
function select_offence($conn, $id) {
	$sql = "SELECT * FROM Offence WHERE Offence_ID = '$id';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row["Offence_Description"];
}
// individual report
function indv_report($conn, $user){
	$sql = "SELECT * FROM Incident WHERE Officer_ID = '$user';"; 
	$result = mysqli_query($conn, $sql);
	while ($rows = mysqli_fetch_assoc($result)) {
		$incident_id = $rows["Incident_ID"];
		$people_id = $rows["People_ID"];
		$vehicle_id = $rows["Vehicle_ID"];
		$offence_id = $rows["Offence_ID"];
		echo "<a href = 'single_report.php?id=$incident_id'>";
		echo $rows["Incident_Date"]. "&nbsp;&nbsp;". $rows["Incident_Time"];
		echo "</a>";
		echo "<br>";
		echo "Name: ".select_people($conn, $people_id);
		echo "                        ";
		echo "Vehicle: ";
		$vcontent = vehicle_properties($conn, $vehicle_id );
		echo $vcontent["Vehicle_Licence"]."-".$vcontent["Vehicle_Colour"]."-".$vcontent["Vehicle_Type"];
		echo "<br>";
		echo "Offence: ". select_offence($conn, $offence_id). "<br>";
		echo "Report: ";
		echo $rows["Incident_Report"];
		echo "<hr><br><br>";
	}
}


// view all reports
function all_report($conn) {
	$sql = "SELECT * FROM Incident;"; 
	$result = mysqli_query($conn, $sql);
	while ($rows = mysqli_fetch_assoc($result)) {
		$incident_id = $rows["Incident_ID"];
		$people_id = $rows["People_ID"];
		$vehicle_id = $rows["Vehicle_ID"];
		$offence_id = $rows["Offence_ID"];
		$officer_id = $rows["Officer_ID"];
		$row = officer_properties($conn,$officer_id);
		$role = $row["Officer_Role"];
		$name = $row["Officer_Username"];
		echo "<a href = 'single_report.php?id=$incident_id'>";
		echo $rows["Incident_Date"]. "&nbsp;&nbsp;". $rows["Incident_Time"];
		echo "</a>";
		echo "&nbsp;&nbsp";
		echo ($role == "admin")? "Adminstrator: ": "Officer: ";
		echo "<mark id = 'officer'>".$name."</mark>";
		echo "<br>";
		echo "Name: ".select_people($conn, $people_id);
		echo "                        ";
		echo "Vehicle: ";
		$vcontent = vehicle_properties($conn, $vehicle_id );
		echo $vcontent["Vehicle_Licence"]."-".$vcontent["Vehicle_Colour"]."-".$vcontent["Vehicle_Type"];
		echo "<br>";
		echo "Offence: ". select_offence($conn, $offence_id). "<br>";
		echo "Report: ";
		echo $rows["Incident_Report"];
		echo "<hr><br><br>";
	}
	
}


// get officer name
function officer_properties($conn, $id) {
	$sql = "SELECT * FROM Officer WHERE Officer_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}




// generate new reports
function insert_report($conn, $user, $pid, $vid, $oid, $txt) {
	$date = date("Y-m-d");
	$time = date("h:i:s");
	$sql = "INSERT INTO Incident
			(Incident_Date, Incident_Time,Incident_Report, 
			Offence_ID, Officer_ID, Vehicle_ID, People_ID)
			VALUES ('$date', '$time','$txt','$oid','$user','$vid','$pid');";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return True;
	} else {
		return False;
	}
	
	
}

// view all fines
function view_fines($conn) {
	// joining 
	$sql = "SELECT * FROM Fines
			NATURAL JOIN Incident
			NATURAL JOIN People
			NATURAL JOIN Vehicle
            NATURAL JOIN Offence;";
	$result = mysqli_query($conn, $sql);
	// fetch each result
	while ($rows = mysqli_fetch_assoc($result)) {
		// get a list of needed detail
		$people = $rows["People_Name"];
		$people_licence = $rows["People_Licence"];
		$date = $rows["Incident_Date"];
		$time = $rows["Incident_Time"];
		$incident_id = $rows["Incident_ID"];
		$offence = $rows["Offence_Description"];
		$fine = $rows["Fines_Amount"];
		$point = $rows["Fines_Points"];
		
		// put the results on the screen
		echo $people. " (". $people_licence . ") <br>";
		echo $date. " ". $time. " (incident #".$incident_id. " ) - ".$offence."<br>";
		echo "Fine: £". $fine. " (".$point. " points)";
		echo "<br><hr><br>";
		
	}
	
}

// insert fine
function insert_incident($conn, $incident,$point,$fine) {
	$sql = "INSERT INTO Fines (Incident_ID, Fines_Amount, Fines_Points)
			VALUES ('$incident','$fine','$point');";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return True;
	} else {
		return False;
	}
}

// show a list of users
function show_users($conn) {
	$sql = "SELECT * FROM Officer;";
	$result = mysqli_query($conn, $sql);
	echo "<table>";
	echo "<tr>";
	echo "<th>Username </th>";
	echo "<th> Role </th>";
	echo "</tr>";
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row["Officer_Username"];
		$role = $row["Officer_Role"];
		echo "<tr>";
		echo "<td>". $name. "</td>";
		echo "<td>". $role. "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
}

// check whether username exists already
function name_exist($conn, $username) {
	$sql = "SELECT * FROM Officer WHERE Officer_Username = '$username';";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		return True;
	} else {
		return False;
	}
}

// insert officer
function insert_officer ($conn, $username, $role, $password) {
	$sql = "INSERT INTO Officer (Officer_Username, Officer_Role, Officer_Password)
			VALUES('$username', '$role', '$password');";
	$result = mysqli_query($conn, $sql);
	// check if result is successful 
	if ($result) {
		return True;
	} else {
		return False;
	}
	
}

// check matching password
function password_match($conn, $password, $id) {
	/* check old password: 1. select userID so to get their password for following reasons:
	 * it is possible that two users might have same password
	 * can also be done by select username since username is also unique
	*/
	$sql = "SELECT Officer_Password FROM Officer WHERE Officer_ID = '$id';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$origpass = $row[0];
	// return false if passwords does not match
	if ($origpass != $password) {
		return False;
	} else {
		return True;
	}
}

// select single incident
function select_incident($conn, $id) {
	$sql = "SELECT * FROM Incident WHERE Incident_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}

// select single people
function people_properties($conn, $id) {
	$sql = "SELECT * FROM People WHERE People_ID = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
	
}

// update incident
function update_incident($conn, $iid, $pid, $vid, $oid, $txt) {
	$sql = "UPDATE Incident
			SET Incident_Report = '$txt' , People_ID = '$pid', 
				Offence_ID = '$oid', Vehicle_ID = '$vid'
			WHERE Incident_ID = '$iid' ";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return True;
	} else {
		return False;
	}
	
}

?>