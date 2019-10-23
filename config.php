<?php 
	session_start();
	setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
	// connect to database
	$conn = mysqli_connect("localhost", "root", "", "dione");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
       // coming soon...

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://dione/');
?>