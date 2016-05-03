<?php 

	include('conn.php');

	$email = mysqli_real_escape_string($link ,$_POST['email']);
	$password = md5(md5($_POST['email']).$_POST['password']);

	$query="SELECT * FROM users WHERE email = '$email'";

	$results = 0;

	if($result = mysqli_query($link, $query)){

		$results = mysqli_num_rows($result);
	}

	if($results)
			$error.="User is already registered. <br />";

	else{
		$query = "INSERT INTO users (email, password) 
				VALUES ('$email', '$password')";

		if(mysqli_query($link, $query)){

			$_SESSION['id'] = mysqli_insert_id($link);

			header("Location:diary.php");
		}
		else{
			$error.="Error in creating user.<br />";
		}

	}

?>