<?php require_once("sessions.php") ?>
<?php 
	require_once 'dbh.php';
	require_once 'functions.inc.php';
?>
<?php
	
	if (isset($_POST["submit"])) {
	
		$username = $_POST["uid"];
		$pwd = $_POST["pwd"];

		

		if (emptyInputLogin($username, $pwd) !== false) {
			header("location: ../login.php?error=emptyinput");
			exit();
		}

		if(loginUser($conn, $username, $pwd)){
			header("location: ../dashboard.php");
		}
	}
	else{
		header("location: ../login.php");
		exit();
	}