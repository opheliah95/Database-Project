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
// check whether user pressed add buttons or cancels or they just open the page by accident
if(isset($_GET["people"])) {
	$userpath = USER_DIR_PATH.USER_PAGE_PATH;
	//header("location:".$userpath);
}
elseif(isset($_GET["vehicle"])) {
	header("location:add_vehicle.php");
}
elseif(isset($_GET["report"])) {
	echo "Welcome report";
}
elseif(isset($_GET["cancel"])) {
	$userpath = PROJ_PATH."User/userpage.php";
	header("location: ".$userpath);
}
else {
	echo '<html>
			<body>
				<p> You just arrive on this page by accident! </p>
				<p> You will be redirected to login page </p>
			</body>
		  </html>';

	refresh_to_homepage();

}


?>
