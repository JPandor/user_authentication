<?php

$servername = "sql4.freesqldatabase.com";
$username = "sql4499731";
$password = "Vbz7LhP4eY";
$dbname = "sql4499731";

$conn = new mysqli($servername, $username, $password, $dbname); // Create connection

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
