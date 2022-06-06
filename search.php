<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Library</title>
</head>
<body>
     <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();
include("connect.php");

$search = $_POST['search'];


if ($_SESSION['user_type'] == "admin"){
    $sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id WHERE book_name LIKE '%$search%' OR author_name LIKE '%$search%'";
    $results = mysqli_query($conn, $sql);
    if($results->num_rows > 0){
        echo "<table class='table table-light mb-4'><tr><th>Author</th><th>Book Name</th><th>Year</th><th>Genre</th><th>Recommended Age</th></tr>";
        while($row = mysqli_fetch_array($results)){
            echo "<tr><td>" . $row['author_name'] . "</td><td>" . $row['book_name'] . "</td><td>" . $row['year'] . "</td><td>" . $row['book_genre'] . "</td><td>" . $row['age_group'] . "</td> </tr>";
        }
        echo "</table";
    }else {
        echo "<p>No results found</p>";
    }   
}else {
    $sql = "SELECT * FROM authors JOIN books ON author_id = books.authors_id WHERE book_name LIKE '%$search%'";
    $results = mysqli_query($conn, $sql);
    if($results->num_rows > 0){
        echo "<table class='table table-light mb-4'><tr>
        <th>Author</th>
        <th>Book Name</th>
        <th>Year</th>
        <th>Genre</th>
        <th>Recommended Age</th>
        </tr>";
        while($row = mysqli_fetch_array($results)){
            echo "<tr><td>" . $row['author_name'] . "</td>
            <td>" . $row['book_name'] . "</td>
            <td>" . $row['year'] . "</td>
            <td>" . $row['book_genre'] . "</td>
            <td>" . $row['age_group'] . "</td> </tr>";
        }
        echo "</table";
    }else {
        echo "<p>No results found</p>";
    }    

}

?>