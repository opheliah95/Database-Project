<?php

function get_css_path()
{
    $css=' <link href="../../style/style.css" rel="stylesheet">';
    echo $css;
}

// this function will redirect user to homepage
function refresh_to_homepage($time = 5){
    $home = "../index.php";
    echo "This page will refresh in " .$time. " seconds";
    header("refresh:$time; url=$home");
}

?>



<?php
// include css path
get_css_path();
if (isset($_SESSION["user"]) && isset($_SESSION["id"]) && isset($_SESSION["role"])) {
  // if user login
  if ($_SESSION["role"] == "user") {
	echo "<ul>";
	echo "<li id = 'left'>Username: ".$_SESSION['user']." </li>";
	echo "<li id = 'right'>
		<a href = 'changepw.php' class = 'link1'> Change Password </a>
		<a href = 'logout.php' class = 'link1'> Logout </a>
		</li>";
	echo "</ul>";
	echo "<br>";
  }
  // if admin login
  elseif ($_SESSION["role"] == "admin") {
	echo "<ul>";
	echo "<li id = 'left'>Username: ".$_SESSION['user'] ;
	echo "&nbsp;&nbsp;";
	echo "<mark>[Admin]</mark>";
	echo "</li>";
	echo "<li id = 'right'>
		<a href = 'manageuser.php' class = 'link1'> Manage User </a>
		<a href = 'changepw.php' class = 'link1'> Change Password </a>
		<a href = 'logout.php' class = 'link2'> Logout </a>
		</li>";
	echo "</ul>";
	echo "<br>";
  }


 } else {
	echo "<p class = 'notlog'>You are not logged in</p>";
	echo "<br>";
    refresh_to_homepage();
}

?>

