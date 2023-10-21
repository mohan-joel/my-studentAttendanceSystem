<?php 
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname = "attendance_system_db";

	// create database connection
	$con = new mysqli($hostname, $username, $password, $dbname);

	// check connection
	if($con->connect_error){
		die("Conenction Failed:".$con->connect_error);
	}


?>