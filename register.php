<?php

session_start();

include ("connect.php");

$email = $_POST['email'];
$password = md5($_POST['password']);
$user_type = $_POST['user-role'];

if ($user_type == "librarian"){
    $user_type = true;
}else {
    $user_type = 0;
}


$sql = "INSERT INTO users (email, password, librarian)
VALUES ('$email', '$password', $user_type)";

if ($conn->query($sql) === TRUE) {
    $_SESSION['new_user'] = true;
    header("Location: login.php");

  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
  
