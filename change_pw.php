<?php

	session_start();
	include ("connect.php");

	//updating user password
	if($_POST['password']){
		$email = $_POST['emails'];
		$password = md5($_POST['password']);
		$security = $_POST['security'];

		//checking security question
		$check_sql = "SELECT * FROM users WHERE email = '$email' AND colour = '$security'";

		$result = mysqli_query($conn, $check_sql);

		if ($result->num_rows > 0){
			$sql = "UPDATE users SET password = '$password' WHERE email = '$email'";

			if ($conn->query($sql) === TRUE) {
				$_SESSION['change_password'] = true;
				header('Location: login.php');

			} else {
				echo "<div class='alert alert-danger' role='alert'>
				Error:" . $sql . "<br>" . $conn->error . 
			"</div>";
			}
		}else {
			$_SESSION['forget_error'] = true;
            header ("Location: forgot.php");
		}
	}
?>