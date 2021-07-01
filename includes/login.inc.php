<?php require_once("sessions.php") ?>
<?php 
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
?>
<?php
	
	if (isset($_POST["submit"])) {
	
		$username = $_POST["uid"];
		$pwd = $_POST["pwd"];

		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		if (emptyInputLogin($username, $pwd) !== false) {
			header("location: ../login.php?error=emptyinput");
			exit();
		}

		if(loginUser($conn, $username, $pwd)){
			header("location: ../dashboard.php");
		}
		loginUser($conn, $username, $pwd);
	}
	else{
		header("location: ../login.php");
		exit();
	}