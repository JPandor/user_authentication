<?php

session_start();

include ("connect.php");

//restrict access for users that are members or not logged in
if ($_SESSION['user'] == false || $_SESSION['user_admin'] == false)
{
	$_SESSION['add'] = true;
    header("Location: login.php");
    die();
}


//getting results and adding them to db 
if ($_POST['author_name']){

	$author = $_POST['author_name'];
	$age = $_POST['author_age'];
	$genre = $_POST['genre'];

	$sql = "INSERT INTO authors (author_name, age, genre)
	VALUES ('$author', $age, '$genre')";

	if ($conn->query($sql) === TRUE) {
		$_SESSION['add_author'] = true;
		header("Location: index.php");
	} else {
		echo "<div class='alert alert-danger' role='alert'>
				Error:" . $sql . "<br>" . $conn->error . 
			"</div>";
	}
}else{

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Author</title>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="add_author.php" method="post">
					<span class="login100-form-title p-b-49">
						Add author
					</span>
					<?php
					//error handling 
					if ($_SESSION['author_error'] == true){
    					echo "<div class='alert alert-danger mb-3' role='alert'>
						Book not added. Please add the author first and try again.
				 		</div>";
				  		$_SESSION['author_error'] = false;
  					}
  			?>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Author name is required">
						<span class="label-input100">Author Name</span>
						<input class="input100" type="text" name="author_name" placeholder="Type author name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Author age is required">
						<span class="label-input100">Age</span>
						<input class="input100" type="text" name="author_age" placeholder="Type author age">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="m-b-23 p-t-7">
						<span class="txt1">
							Please type null if author has passed
						</span>

					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Genre is required">
						<span class="label-input100">Genre</span>
						<input class="input100" type="text" name="genre" placeholder="Type author genre">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Add Author
							</button>
						</div>
					</div>

					<div class="flex-col-c p-t-30">

						<a href="index.php" class="txt2">
							Back to home?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>



</body>

</html>

<?php

}

?>