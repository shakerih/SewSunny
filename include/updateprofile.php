<!-- THIS IS AN AJAX FILE -->
<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sew_sunny";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!isset($_SESSION)) { session_start(); }
  //update member info in the DB
  $updateProfile = "UPDATE members SET username='".htmlspecialchars($_POST['username'])."', name='".htmlspecialchars($_POST['name'])."',password='".password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT)."' WHERE username='".$_SESSION['username']."'";
  mysqli_query($connection, $updateProfile);
  $_SESSION['username'] = htmlspecialchars($_POST['username']);
  echo "";


?>
