<?php 

$conn = mysqli_connect("localhost","root","","admin") or die("Connection Failed");

session_start();

session_unset();

session_destroy();

header("Location: http://localhost/final/admin-login.php");

?>