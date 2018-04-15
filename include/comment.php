<!-- THIS IS AN AJAX FILE -->
<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sew_sunny";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!isset($_SESSION)) { session_start(); } //start session in order to access session variables
if(isset($_POST['text'])){  //insert submitted comment into database
    $result = mysqli_query($connection, "INSERT INTO comment (userID, projectID, comment) VALUES(".$_SESSION['userID'].", ".$_SESSION['currproject'].", '".htmlspecialchars($_POST['text'])."')");
}

?>
