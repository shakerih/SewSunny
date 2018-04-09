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


<?php
    echo "<div class='header_space'></div>";
    echo "<div class='content_container'>";
    echo "<h2>Recent Projects</h2>";
    echo "<div class='project_container'>";
	$query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName FROM projects INNER JOIN category ON projects.categoryID = category.categoryID";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_row($result)){ // add rows to the table
        echo "<div class='project_item'>";
            echo "<div class='project'>";
                echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . "<div class='overlay'></div>" . "<img src='". $row[4] . "'>" . "</a>";
                echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] . "</a></br>";
                echo "<a class='project_category' href='modeldetails.php?projectCode=". $row[0]."'>" . $row[5] . "</a></br>";
            echo "</div>";
        echo "</div>";

    }
    echo "</div>";
    echo "</div>";
?>
