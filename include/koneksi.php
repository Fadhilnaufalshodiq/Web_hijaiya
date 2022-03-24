<?php
#User: bahte407_user2 
#Database: bahte407_mlm2
	$gaSql['user']     = 'root';
	$gaSql['password'] = '';   
	$gaSql['db']       = 'db_hijaiyah';  //Database
	$gaSql['server']   = '127.0.0.1';   
	$gaSql['port']     = 3306; // 3306 is the default MySQL port
	$gaSql['charset']  = 'utf8';
	
	/**
		* MySQL connection
	*/
	$mysqli = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
	if (mysqli_connect_error()) {
		die( 'Error connecting to MySQL server (' . mysqli_connect_errno() .') '. mysqli_connect_error() );
	}
	
	if (!$mysqli->set_charset($gaSql['charset'])) {
		die( 'Error loading character set "'.$gaSql['charset'].'": '.$mysqli->error );
	}
	?>