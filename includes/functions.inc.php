<?php // require_once("sessions.php") ?>
<?php

require_once('session.php');
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat, $companyName, $companyCity, $phone_number){
	$result;
	if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat) || empty($companyName) || empty($companyCity) || empty($phone_number) || empty($username)) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}
function invalidUid($username){
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function invalidEmail($email){
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function pwdMatch($pwd, $pwdRepeat){
	$result;
	if ($pwd !== $pwdRepeat) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function uidExists($conn, $username, $email){
	$sql = "SELECT * FROM business WHERE username = ? OR email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../login.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else{
		$result = false;
		return $result;
	}

mysqli_stmt_close($stmt);
}

function emptyInputLogin($username, $pwd){
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}	

function loginUser($conn, $username, $pwd){
	$uidExists = uidExists($conn, $username, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["password"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	else if ($checkPwd === true) {
		$_SESSION["userid"] = $uidExists["id"];
		$_SESSION["useruid"] = $uidExists["username"];
		if(isset($_SESSION["trackingURL"])){
			header($_SESSION["trackingURL"]);
		}else{
			header("location: ../dashboard.php");
		}
		//exit();
	}
}
function confirmLogin(){
	if(isset($_SESSION['userid'])){
		return true;
	}else{
		//$_SESSION["errorMessage"] = "Login is Required";
		header("location: login.php");
	}
}