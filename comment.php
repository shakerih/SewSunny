<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sew_sunny";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!isset($_SESSION)) { session_start(); }
if(isset($_POST['text'])){
    $result = mysqli_query($connection, "INSERT INTO comment (userID, projectID, comment) VALUES(".$_SESSION['userID'].", ".$_SESSION['currproject'].", '".$_POST['text']."')");
    // echo "jjjjjjjjjjjjjjjj";
  }

?>
