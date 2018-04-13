<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sew_sunny";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!isset($_SESSION)) { session_start(); }
//if(isset($_POST['update'])) {
  $updateProfile = "UPDATE members SET username='".$_POST['username']."', name='".$_POST['name']."',password='".password_hash($_POST['password'], PASSWORD_BCRYPT)."' WHERE username='".$_SESSION['username']."'";
  mysqli_query($connection, $updateProfile);
  $_SESSION['username'] = $_POST['username'];
  echo "";
//}

?>
