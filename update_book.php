<?php

session_start();

include ("connect.php");

//restricting access for users that are members or not logged in
if ($_SESSION['user'] == false || $_SESSION['user_admin'] == false)
{
	$_SESSION['add'] = true;
    header("Location: login.php");
    die();
}

// updating book
if ($_POST['book_name']){
    
    $book = $_POST['book_name'];
    $years = $_POST['release_year'];
    $genre = $_POST['genre'];
    $age = $_POST['age_group'];
    $author = $_POST['author'];

    $author_sql = "SELECT author_id FROM authors WHERE author_name = '$author'";

    $author_result = mysqli_query($conn, $author_sql);

	//checking if the author exists
    if ($author_result->num_rows > 0){
		//fetching the author id for foreign id 
        $author_result = mysqli_fetch_assoc($author_result);
		//storing author id in a variable 
		$author_id = $author_result['author_id'];

		//sql query for updating the book 
        $sql = "UPDATE books SET book_name = '$book', book_year = $years, book_genre = '$genre', age_group = '$age', authors_id = $author_id WHERE book_name = '$book'";

		//running sql query
		if ($conn->query($sql) === TRUE) {
			$_SESSION['update_book'] = true;
			header("Location: index.php");
		}else {
			echo "<div class='alert alert-danger' role='alert'>
				Error:" . $sql . "<br>" . $conn->error . 
			"</div>";
		}
    }else{
		$_SESSION['update_book_error'] = true;
        header("Location: update_book.php");
	}

}else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>

    <div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-35">
				<form class="login100-form validate-form" action="update_book.php" method="post">
					<span class="login100-form-title p-b-49">
						Update Book Details
					</span>
                <?php
                    if ($_SESSION['update_book_error'] == true){
                        echo "<div class='alert alert-danger mb-3' role='alert'>
					    Something went wrong! Please make sure you put correct book/author names.
				        </div>";
				    $_SESSION['update_book_error'] = false;
                    }
                ?>
					<div class="wrap-input100 validate-input m-b-23" data-validate="Book name is required">
						<span class="label-input100">Book Name</span>
						<input class="input100" type="text" name="book_name" placeholder="Type book name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Release year is required">
						<span class="label-input100">Release year</span>
						<input class="input100" type="number" name="release_year" placeholder="Type the books release year">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Genre is required">
						<span class="label-input100">Genre</span>
						<input class="input100" type="text" name="genre" placeholder="Type book genre">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Recommended Age is required">
						<span class="label-input100">Recommended age</span>
						<input class="input100" type="text" name="age_group" placeholder="Type the recommended age">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Author is required. Please make sure author is already added to the database.">
						<span class="label-input100">Author</span>
						<input class="input100" type="text" name="author" placeholder="Type author's name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Update Book
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
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
