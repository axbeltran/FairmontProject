<?php
if (isset($_POST["search-submit"])) {	
	$search = $_POST['search'];
	header("Location: ../services.html?search=".$search);
	exit();
}
else {
	header("Location: ../services.html?error=AccessDenied");
	exit();
}