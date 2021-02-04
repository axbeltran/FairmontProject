<?php
if (isset($_POST["email-submit"])) {	
	include_once 'dbh.php';
	session_start();
	
	$eMail = $_POST['changeemail'];
	$UID = $_SESSION['UID'];

	$sql = "UPDATE users SET Email=? WHERE UserID=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../Profile.html?error=sqlerror");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "ss", $eMail, $UID);
		mysqli_execute($stmt);
		$_SESSION['mail'] = $eMail;
		header("Location: ../Profile.html?UsernameChange=success");
		exit();
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	header("Location: ../Profilehtml?error=AccessDenied");
		exit();
}