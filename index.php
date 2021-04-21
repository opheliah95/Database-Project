<?php
include_once "includes/header.php";
include_once "includes/login.php";

// check whether a session has started
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style/style.css">
<head>
    <title>Vehicle Database Project</title>
</head>
<body>
<form method = "post" action = "includes/login.php">
Username: &nbsp; <input type = "text" name = "name" placeholder = "username">
<br>
Password:&nbsp;&nbsp;&nbsp;
<input type = "password" name = "password" placeholder = "password">
<br>
<input type = "submit" value = "Login">
</form>

<br>
<?php echo isset($_GET["error"] )? "*".$_GET["error"] : "";?>
</body>
</html>




