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
	//send query and catch error
      $result = mysqli_query($connection, "SELECT * FROM watchlist WHERE productCode='".$_GET["productCode"]."'");
      if (mysqli_num_rows($result) == 0){
        $result = mysqli_query($connection, "SELECT * FROM products WHERE productCode='".$_GET["productCode"]."'");
        if (!$result) {
          die("Database query failed 3.");
        }
        $row =  mysqli_fetch_row($result);
         $r = mysqli_query($connection, "INSERT INTO watchlist (productCode, productName, productLine, productScale, productVendor, productDescription, quantityInStock, buyPrice, MSRP) VALUES('".$row[0]."','".$row[1]."','".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."')");
        if (!$r) {
          die("Error inserting to watchlist");
        }
      }
      echo "<h3>Successfully added to watchlist.</h3>";
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