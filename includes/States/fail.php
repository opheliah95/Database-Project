<html>

<body>

<?php
include("../dbconnection.php");
?>

<?php
session_start();
include("../header.php");
?>


<?php
// if session variables are destroyed
if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
	header("location: ../login.php");
	exit;
}

mysqli_close($conn);
?>


<div class = "pop">
<p>An error occured when changing your password </p>
<p>Please try again later</p>
<button> <a href = "/Database-Project/index.php" class = "a_button">Okay </a></button>
</div>

</body>
</html>
