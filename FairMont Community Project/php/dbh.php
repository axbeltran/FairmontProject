<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "usbw" ;
$dBName = "fairmont community group";

$conn = mysqli_connect($servername, $dBUsername,$dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}