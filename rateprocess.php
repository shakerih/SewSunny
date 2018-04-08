<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sew_sunny";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!isset($_SESSION)) { session_start(); }
if(isset($_POST['num'])){
    echo $_SESSION['currproject'];
    echo $_SESSION['userID'];
    echo $_POST['num'];

    $result = mysqli_query($connection, "INSERT INTO ratings (userID, projectID, rating) VALUES(".$_SESSION['userID'].", ".$_SESSION['currproject'].", ". $_POST['num'].")");

}
?>
