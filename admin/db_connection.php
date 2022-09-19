<?php 
	session_start();
	$dbconnection = mysqli_connect('localhost', 'root', '', 'rm_vurtual_blog');
	mysqli_set_charset($dbconnection, "utf8mb4_general_ci");
	if (!$dbconnection)
	{
		die("Could not connect: " . mysqli_connect_error());
	}
 ?>