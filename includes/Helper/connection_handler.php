<?php
// file to handle path
include_once("path_handler.php");

// two important paths
$DB_Path = "../dbconnection.php";
$Header_Path = "../header.php";

// include path for execution
include($DB_Path);
session_start();
include($Header_Path);
?>