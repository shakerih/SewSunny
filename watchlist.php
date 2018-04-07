<style>table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
</style>
<?php    
require_once('initialize.php');

  // Create a database connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "sew_sunny";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  //catch connection error
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }  
?>
<?php include('header.php'); ?>
<?php

if(is_logged_in()){
	
        $result = mysqli_query($connection, "SELECT * FROM watchlist");
        if (!$result) {
          die("Database query failed 2.");
        }
        echo "<h1>Watchlist:</h1>";
        //create the table and columns
                while($row = mysqli_fetch_row($result)){ // add rows to the table 
         
            echo "<a href='modeldetails.php?productCode=". $row[0]."'>" . $row[1] . "</a><br>";
          
        }
} else{
  $_SESSION['callback_url'] =  $_SERVER['REQUEST_URI'];

  header("location:login.php");
  exit();
}
?>