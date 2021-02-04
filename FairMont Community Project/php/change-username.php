<?php
if (isset($_POST["username-submit"])) {	
	include_once 'dbh.php';
	session_start();
	
	$UserName = $_POST['changeusername'];
	$UID = $_SESSION['UID'];

	$sql = "UPDATE users SET username=? WHERE UserID=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../Profile.html?error=sqlerror");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "ss", $UserName, $UID);
		mysqli_execute($stmt);
		$_SESSION['userName'] = $UserName;
		header("Location: ../Profile.html?UsernameChange=success");
		exit();
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	header("Location: ../Profile.html?error=AccessDenied");
		exit();
}