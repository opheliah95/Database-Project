<?php
if (isset($_GET["search"])) {
		
		// if search box is empty
		if($_GET["search"]== "") {
			$sql = "SELECT * FROM People;";
			$result = mysqli_query($conn, $sql);
			echo mysqli_num_rows($result). " people found: ";
			echo "<br><br>";
			
			// get the list of results
			echo "<ul>";
			while ($rows = mysqli_fetch_assoc($result)) {
				$people_id = $rows["People_ID"];
				echo "<li>
					 &nbsp;&nbsp;&nbsp; 				
					 <a href = 'people_found.php?id=$people_id'>" .$rows["People_Name"]. "</a>";
				echo  "(". $rows["People_Address"]. ")"."</li>";
			}
			echo "</ul>";
			// add hyper links and javascript
			
			
		}
		
		// if search box is not empty
		else {
			
			// querying database
			$search = $_GET["search"];
			$sql = "SELECT * FROM People 
					WHERE (People_Name Like '%$search%') 
					OR(People_Licence = '$search');";
			$result = mysqli_query($conn, $sql);
			$total_rows = mysqli_num_rows($result);
			
			// display rows
			echo $total_rows." people found: ";
			echo "<br><br>";
			// display result depends on how many rows we got
			if ($total_rows == 1) {
				$rows = mysqli_fetch_assoc($result);
				$people_id = $rows["People_ID"];
				$count = $total_rows;
				header("location:people_found.php?id=$people_id&num=$count");
			}
			elseif ($total_rows > 1) {
				// get the list of results
				echo "<ul>";
				while ($rows = mysqli_fetch_assoc($result)) {
					$people_id = $rows["People_ID"];
					echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href = 'people_found.php?id=$people_id'>"
						.$rows["People_Name"]. "</a>";
					echo  "(". $rows["People_Address"]. ")"."</li>";
				}
				echo "</ul>";
				
			}
			
		  
		}
		
		// add modification buttons
	}

?>
<br>

<form method = "GET" action = "../../Actions/Add/process_add.php">
<input type = "submit" name = "people" value = "Add new people">
<input type = "submit" name = "cancel" value = "Cancel">
</form>
