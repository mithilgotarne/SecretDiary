<?php 

	session_start();

	include('conn.php');

	if(isset($_SESSION['id'])){

		$id = $_SESSION['id'];
		$entry = mysqli_real_escape_string($link,$_POST['entry']);

		$query = "UPDATE users SET entry = '$entry' WHERE id = '$id'";

		mysqli_query($link, $query);

	} 

 ?>