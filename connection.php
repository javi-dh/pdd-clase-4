<?php

	$host = 'mysql:host=localhost; dbname=movies_db; charset=utf8mb4';
	$user = 'root';
	$pass = '';
	$opt= [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

	try{
		$conn = new PDO($host, $user, $pass, $opt);
	}catch( PDOException $Exception ) {
   	echo $Exception->getMessage();
	}
