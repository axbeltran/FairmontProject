<?php
if (isset($_POST["add-service-submit"])) {	
	include_once 'dbh.php';
	
	$title = $_POST['serviceTitle'];
	$description = $_POST['serviceDescription'];

	$sql = "INSERT INTO services (ServiceTitle, ServiceDescription) VALUES(?, ?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../Add-Service.html?error=sqlerror");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "ss", $title, $description);
		mysqli_execute($stmt);
		header("Location: ../services.html?AddService=success");
		exit();
	}
	msqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	header("Location: ../Add-Service.html?error=AccessDenied");
		exit();
}