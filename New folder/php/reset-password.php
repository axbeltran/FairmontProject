<?php
if (isset($_POST['reset-password-submit'])) {
	$selector = $_POST['selector'];
	$validator = $_POST['validator'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];

	if (empty($password) || empty($passwordRepeat)) {
		header("Location: ../create-new-password.html?newpwd=empty");
		exit();
	}
	else if ($password != $passwordRepeat) {
		header("Location: ../create-new-password.html?newpwd=pwdnotsame");
		exit();
	}

	$currentDate = date("U");
	require 'dbh.php';

	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires>=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error";
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "You need to re-submit your request.1";
			exit();
		}
		else {
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
		}
		if ($tokenCheck === false) {
			echo "You need to re-submit your request.2";
			exit();
		}
		else if ($tokenCheck === true) { 
			$tokenEmail = $row['pwdResetEmail'];
			$sql = "SELECT * FROm users WHERE Email=?;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "There was an error1";
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if (!$row = mysqli_fetch_assoc($result)) {
					echo "There was an error2!";
					exit();
				}
				else {
					$sql = "UPDATE users SET Password=? WHERE  Email=?";
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "There was an error3!";
						exit();
					}
					else {
						$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
						mysqli_stmt_execute($stmt);
						$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "There was an error4";
							exit();
						}
						else {
							mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
							mysqli_stmt_execute($stmt);
							header("Location: ../Main.html?mewpwd=passwordupdated");
							exit();
						}
					}
				}	
			}
		}	
	}
}
else {
	header("Location: ../main.php?error=passwordreset2");
	exit();
}
