<?php

session_start();
include ("connect.php");


if (isset ($_POST['book'])){
    $book = $_POST['book'];

    $sql = "SELECT * FROM books WHERE book_name = '$book'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0){
        $delete_sql = "DELETE FROM books WHERE book_name = '$book'";

        if ($conn->query($delete_sql) === TRUE){
            $_SESSION['delete_book'] = true;
            header ("Location: index.php");
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else {
        $_SESSION['delete_book_error'] = true;
    }
}


    

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>


	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="delete_book.php" method="post">
					<span class="login100-form-title p-b-49">
						Delete Book
					</span>

                    <?php
                    if ($_SESSION['delete_book_error'] == true){
                        echo "<div class='alert alert-danger' role='alert'>
                        Book was not found
                        </div>";
                        $_SESSION['delete_book_error'] = false;
                    }else if ($_SESSION['delete_author_error'] == true){
                        echo "<div class='alert alert-danger' role='alert'>
                        Please delete all books of author before trying to delete the author.
                        </div>";
                        $_SESSION['delete_error'] = false;
                    }
                    ?>
					<div class="wrap-input100 validate-input m-b-23" data-validate="Book name is required">
						<span class="label-input100">Book Name</span>
						<input class="input100" type="text" name="book" placeholder="Type book to delete">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Delete Book
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
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
		crossorigin="anonymous"></script>

</body>

</html>