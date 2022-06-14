<?php

session_start();

include ("connect.php");

if (isset ($_POST)){
    $password = md5($_POST['passwords']);
    $email = $_SESSION['email'];
    $user_sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $user_sql);

    if (mysqli_num_rows($result) > 0){
		//delete sql 
		$sql = "DELETE FROM users WHERE email = '$email'";

		//if account is deleted display html code 
		if (mysqli_query($conn, $sql) == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Goodbye</title>
	<style>
		body {
			background-image: url("images/bg-01.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}

		main {
			width: 50%;
		}
	</style>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="mx-5">

	<main class="bg-light mx-auto mt-5 p-3 border rounded text-center">
		<h1>Goodbye</h1>
		<p>We'll miss you :(</p>
		<p>Feel free to sign up again if you'd like </p>
		<p style="font-size: small;">This page will automatically redirect</p>
	</main>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
		crossorigin="anonymous"></script>
</body>

</html>

<?php
			header ("Refresh:6; url='sign_up.php'");
		}else {
			echo "<div class='alert alert-danger' role='alert'>
				Error:" . $sql . "<br>" . $conn->error . 
			"</div>";
		}
	}
}else {
	$_SESSION['delete_error'] = true;
    header ("Location: delete.php");
}

?>