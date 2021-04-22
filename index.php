<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style/style.css">
<head>

</head>
<body>
<h1> Traffic Record Database</h1>
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




