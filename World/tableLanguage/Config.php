<?php

	$servername = "Localhost";
	$username = "hcytn1_mysqlgirl";
	$password = "Mysqlgirls12345";
	$dbname = "hcytn1_world";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 


?>