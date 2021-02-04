<?php
	require_once 'PHPMailer\PHPMailer.php';
	require_once 'PHPMailer\Exception.php';
	require_once 'PHPMailer\SMTP.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
if (isset($_POST['reset-request-submit'])) {
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);
	$url ="http://localhost:8080/FairMont%20Community%20Project/create-new-password.html?selector=".$selector."&validator=".bin2hex($token);
	$expires = date("U") + 1800;

	require 'dbh.php';

	$userEmail = $_POST["email"];
	$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was and error!";
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

	$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was and error!";
		exit();
	}
	else {
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);
	mysqli_close($stmt);


	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->Username = 'FairmontCommunityGroup@gmail.com';
	$mail->Password = 's4tQ{gGQ+B)"p66(';

	$mail->setFrom($userEmail,'Fairmont Community Group Website');
	$mail->addAddress($userEmail);

	$mail->isHTML(true);
	$mail->Subject = 'Password reset request';
	$mail->Body = '<p>We recieve a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email</p>'.'<p>Here is your password rest link: </br>'.'<a href='.$url.'">'.$url.'</a></p>';

	$mail->send();
	$mail->smtpClose();

	header("Location: ../main.html?reset=sent");
	exit();
}
else {
	header("Location: ../main.html?error=passwordreset");
	exit();
} 