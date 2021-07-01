<?php require_once("functions.inc.php") ?>
<?php require_once("sessions.php") ?>
<?php 
	$_SESSION["userid"] = null;
	session_destroy();
	header("location: ../login.php");
?>