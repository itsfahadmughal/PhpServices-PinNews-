<?php 
	
	$host = "localhost";
	$user = "id8482197_idiotsthree";
	$password = "pakistan143";
	$database = "id8482197_db";

	// Create Connection
	$conn = mysqli_connect($host, $user, $password, $database);

	// Check Connection
	if(!$conn)
	{
		die("Connection Failed: " . mysqli_connect_error());
	}
?>
