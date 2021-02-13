<?php
if (isset($_POST["name-submit"])) {	
	include_once 'dbh.php';
	session_start();
	
	$firstName = $_POST['changefname'];
	$lastName = $_POST['changelname'];
	$UID = $_SESSION['UID'];

	$sql = "UPDATE users SET FirstName=?, LastName=? WHERE UserID=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../Profile.html?error=sqlerror");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "sss", $firstName,$lastName, $UID);
		mysqli_execute($stmt);
		$_SESSION['fName'] = $firstName;
		$_SESSION['lName'] = $lastName;
		header("Location: ../Profile.html?NameChange=success");
		exit();
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	header("Location: ../Profilehtml?error=AccessDenied");
		exit();
}