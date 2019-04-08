<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'syi7');
	define('DB_PASSWORD', 'syi7');
	define('DB_NAME', 'syi7');

	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
	// Check connection
	if($link === false) {
    	die("ERROR: Could not connect. " . mysqli_connect_error());
	} else {
		echo "DB works. <br>";
	}

?>