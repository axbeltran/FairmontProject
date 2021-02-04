<?php
		if (isset($_POST["signup-submit"])) {
		
		require 'dbh.php';
		
		$username = $_POST['username'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['psw'];
		$passwordRepeat = $_POST['psw-repeat'];
		
		$sql = "SELECT UserID FROM users WHERE UserID=?";
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../Registration.html?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: ../Registration.html?error=usertake&mail=".$email);
				exit();
			}
			else {
				$sql = "INSERT INTO users (username, FirstName, LastName, Email, Password) VALUES(?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../Registration.html?error=sqlerror");
					exit();
				}
				else {
					$hash = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "sssss", $username, $firstName, $lastName, $email, $hash);
					mysqli_execute($stmt);
					header("Location: ../main.html?signup=success");
					exit();
				}
			}
		}
		msqli_stmt_close($stmt);
		mysqli_close($conn);
		
	}
	else {
		header("Location: ../Registration.html");
		exit();
	}