<?php 

	$host = "localhost"; //LocalHost
	$user = "root";		//username
	$pass = "root";		//passworf
	$db_name = "diary"; //datanase name
	$port = "8889";		//host
	$error ="";			//for collecting error through out the site

	//Create a mysqli object for connection with database
	$link = new mysqli($host,$user,$pass,$db_name,$port);

	if(mysqli_connect_error()){
		$error.="Could not connect to the database.<br />";
	}

?>