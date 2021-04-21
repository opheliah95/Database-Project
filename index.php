<?php
    include_once "includes/dbconnection.php";
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style/style.css">
<head>
    <title>Vehicle Database Project</title>
</head>
<body>
<form method = "post" action = "login.php">
Username: &nbsp; <input type = "text" name = "name" placeholder = "username">
<?php echo isset($name_error)? "*".$name_error : "";?><br>


Password:&nbsp;&nbsp;&nbsp;
<input type = "password" name = "password" placeholder = "password">
<?php echo isset($password_error )? "*".$password_error : "";?><br><br><br>
<input type = "submit" value = "Login">
</form>

<?php echo isset($login_error )? "*".$login_error : "";?>

</body>
</html>




