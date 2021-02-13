<?php
// MUTE NOTICES
error_reporting(E_ALL & ~E_NOTICE);
 
// DATABASE SETTINGS - CHANGE THESE TO YOUR OWN
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fairmont community group');
define('DB_CHARSET', 'utf8');

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
//set_charset($DB_CHARSET);

if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
}
// AUTO PATH
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);
?>