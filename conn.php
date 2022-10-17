<?php 
	$conn=mysqli_connect("localhost", "root", "", "signup");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>