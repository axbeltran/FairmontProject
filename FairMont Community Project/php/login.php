<?php
	if (isset($_POST['login-submit'])) {
		require 'dbh.php';
		
		
		if (!empty($_POST['remember'])) {
			setcookie("username",$_POST["username"],time()+(10*365*24*60*60));
			setcookie("password",$_POST["psw"],time()+(10*365*24*60*60));
		}
		
		$username = $_POST['username'];
		$password = $_POST['psw'];
		
		$sql = "SELECT * FROM users WHERE Username=? OR Email=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../main.html?error=sqlerror");
			eixt();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $username, $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$pswCheck = password_verify($password, $row['Password']);
				if ($pswCheck == false) {
					header("Location: ../main.html?error=wrongpsw");
					exit();
				} 
				else if($pswCheck == true) {
					session_start();
					$_SESSION['UID'] = $row['UserID'];
					$_SESSION['fName'] = $row['FirstName'];
					$_SESSION['lName'] = $row['LastName'];
					$_SESSION['UserType'] = $row['AccessLevel'];
					
					
					header("Location: ../main.html?login=success");
					eixt();
				} 
				else {
					header("Location: ../main.html?error=wrongpsw");
					exit();
				}
			}
			else {
				header("Location: ../main.html?error=nouser");
				exit();
			}
		}
	}
	else {
		header("Location: ../main.html");
		exit();
	}
