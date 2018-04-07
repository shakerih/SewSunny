<?php

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

<h1>Projects:</h1>

<?php 
	$query = "SELECT projectID, projectTitle, description, tag, imgURL FROM projects";
    $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_row($result)){ // add rows to the table 
         
            echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] . "</a><br>";
            echo "<img src='". $row[4] . "'><br>";
          
        }
?>