<?php
if (isset($_POST["password-submit"])) {	
	include_once 'dbh.php';
	session_start();
	
	$password = $_POST['pwd'];
	$repeatPassword = $_POST['pwd-repeat'];
	$UID = $_SESSION['UID'];
	
	if($password != $repeatPassword) {
		header("Location: ../change-password.html?Password=notsame");
		exit();
	}
	else {
		$sql = "UPDATE users SET password=? WHERE UserID=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../Profile.html?error=sqlerror");
			exit();
		}
		else {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt, "ss", $hash, $UID);
			mysqli_execute($stmt);
			header("Location: ../Profile.html?.PasswordChange=success");
			exit();
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
}
else {
	header("Location: ../Profilehtml?error=AccessDenied");
		exit();
}