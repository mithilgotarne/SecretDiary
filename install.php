<?php 

	include('conn.php');
	
	$query = "CREATE TABLE IF NOT EXISTS `users` (
	  	`email` text NOT NULL,
  		`password` text NOT NULL,
		`id` int(11) AUTO_INCREMENT PRIMARY KEY,
  		`name` text NOT NULL,
  		`entry` text NOT NULL
	) ";

	if(mysqli_query($link, $query)){
		echo "Install successfull! Tables created. Now delete this file.";
	}

 ?>