<?php
// get include path
$parent_folder = "Actions";
$include_dir = explode($parent_folder, __DIR__)[0];

// includes path_handler
include_once($include_dir."Helper\path_handler.php");
$user_dir= return_url_path("/User/userpage.php");
$addfine_url_dir= return_url_path("/Admin/addfine.php");
?>

<?php
if (count($_POST) > 0) {
	$incident = trim(isset($_POST["id"])?$_POST["id"]: "");
	$txt = trim(isset($_POST["des"])?$_POST["des"]: "");
	$p = trim(isset($_POST["point"])?$_POST["point"]: "");
	$f = trim(isset($_POST["fine"])?$_POST["fine"]: "");
	// if cancel is pressed, then go back 
	if (isset($_POST["cancel"])) {
		header("location:". $user_dir);
		exit;
	}
	elseif (isset($_POST["submit"])) {
		// only incident cannot be empty
		if(insert_incident($conn, $incident,$p,$f)) {
			header("location:". $user_dir);
			exit;
			
		} else {
			$_SESSION["error"] = "There is error in your input...";
		}
	}
	
	header("Location: $addfine_url_dir?iid=$incident&des=$txt", true, 303);
    exit;
}
?>