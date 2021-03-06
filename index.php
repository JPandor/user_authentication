<?php

session_start();


include ("connect.php");

if ($_POST['emails']){
  //getting login inputs
  $email = $_POST['emails'];
  $password = md5($_POST['passwords']);
  //sql query for user 
  $user_sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $_SESSION['email'] = $email;
  //running user sql query
  $result = mysqli_query($conn, $user_sql);
  $users = mysqli_fetch_assoc($result);

  //checking if user details are right
  if ($result->num_rows > 0){
    $_SESSION['user'] = true;
  }else {
    
    $_SESSION['user'] = false;
    $_SESSION['login_error'] = true;
    header ("Location: login.php");
  }

  //seperating user types
  if ($users['librarian']  == 1){
    $_SESSION['user_admin'] = true;
  }else {
    $_SESSION['user_admin'] = false;
  }

}


//sql query for books table 
$books_sql = "";

$sort = $_GET['sort'];

//filter books 
if ($sort == "relevance"){
  $books_sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id";
}else if ($sort == "sort_author"){
  $books_sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id ORDER BY author_name ASC";
}else if ($sort == "sort_books"){
  $books_sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id ORDER BY book_name ASC";
}else if ($sort == "sort_genre"){
  $books_sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id ORDER BY book_genre ASC";
}else if ($sort == "sort_year"){
  $books_sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id ORDER BY book_year DESC";
}else {
  $books_sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id";
}

//running book sql query 
$books_result =  mysqli_query($conn, $books_sql);


if ($_SESSION['user'] == true) {
  
  
  $_SESSION['login_error'] = false;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <title>Library</title>
  <style>
    body {
      background-image: url("images/bg-01.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }

    aside {
      background-color: white;
      margin-right: 1%;
    }

    h1 {
      font-size: 70px !important;
    }
  </style>
</head>

<body class='mx-5'>

  <h1 class='jumbotron text-center m-5'>Library</h1>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          <?php
            if ($_SESSION['user_admin'] == true){ ?>
          <a class="nav-link link-dark" href="add_books.php">Add Book</a>
          <a class="nav-link link-dark" href="add_author.php">Add Author</a>
          <a class="nav-link link-dark" href="delete_book.php">Delete Book</a>
          <a class="nav-link link-dark" href="delete_auth.php">Delete Author</a>
          <a class="nav-link link-dark" href="update_book.php">Update Book</a>
          <?php
            }
          ?>
        </div>
      </div>
      <div class="nav-item dropdown  mx-4">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="login.php">Logout</a></li>
          <li><a class="dropdown-item" href="delete.php">Delete Account</a></li>
        </ul>
      </div>
      <form class="d-flex" role="search" action="search.php" method="post">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-dark" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <br>

  <?php
  //error/success handling
  if ($_SESSION['add_author'] == true){
    echo "<div class='alert alert-success' role='alert'>
					New author successfully added!
				  </div>";
				  $_SESSION['add_author'] = false;
  }else if ($_SESSION['add_book'] == true){
    echo "<div class='alert alert-success' role='alert'>
					New book successfully added!
				  </div>";
				  $_SESSION['add_book'] = false;
  }else if ($_SESSION['delete_auth'] == true){
    echo "<div class='alert alert-success' role='alert'>
					Author successfully deleted.
				  </div>";
				  $_SESSION['delete_auth'] = false;
  }else if ($_SESSION['delete_book'] == true){
    echo "<div class='alert alert-success' role='alert'>
					Book successfully deleted.
				  </div>";
				  $_SESSION['delete_book'] = false;
  }else if ($_SESSION['update_book'] == true){
    echo "<div class='alert alert-success' role='alert'>
					Book successfully updated.
				  </div>";
				  $_SESSION['update_book'] = false;
  }
  ?>

  <!-- filter form -->
  <main style="display: flex;">
    <aside style="width: 16%;" class="mb-4 p-3">
      <form action="index.php" method="get">
        <h2>Sort By</h2>
        <input type="radio" name="sort" id="relevance" value="relevance">
        <label for="relevance" class="p-2">Relevance</label><br>
        <input type="radio" name="sort" id="sort_author" value="sort_author">
        <label for="sort_author" class="p-2">Author</label><br>
        <input type="radio" name="sort" id="sort_books" value="sort_books">
        <label for="sort_books" class="p-2">Book</label><br>
        <input type="radio" name="sort" id="sort_genre" value="sort_genre">
        <label for="sort_genre" class="p-2">Genre</label><br>
        <input type="radio" name="sort" id="sort_year" value="sort_year">
        <label for="sort_year" class="p-2">Year</label><br>
        <div class="d-grid gap-2">
          <button class="btn btn-outline-dark mt-3 btn-block" type="submit">Filter</button>
        </div>
      </form>
    </aside>


    <?php


    //displaying all the books
    echo "<div style='width: 83%;'><table class='table table-light mb-4'><tr>
    <th>Author</th>
    <th>Book Name</th>
    <th>Year</th>
    <th>Genre</th>
    <th>Recommended Age</th>
    </tr>";
    while($row = mysqli_fetch_array($books_result)){
        echo "<tr><td>" . ucwords($row['author_name']) . "</td>
        <td>" . ucwords($row['book_name']) . "</td>
        <td>" . $row['book_year'] . "</td>
        <td>" . ucwords($row['book_genre']) . "</td>
        <td>" . $row['age_group'] . "</td></tr>";
    }
    echo "</table> </div>";

}else {
  header ("Location: login.php");
}

  ?>
  </main>


  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
</body>

</html>