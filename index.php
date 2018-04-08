<?php

// MANY OF THE FUNCTIONS USED IN THIS PROJECT HAVE BEEN MODIFIED OR USED FROM THE WEEK 8 TUTORIAL AND LECTURE

require_once('initialize.php');
  // Create a database connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "sew_sunny";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


?>

<?php include('header.php'); ?>

<div id="content" class="content_container">
  <?php
  if(is_logged_in()){
  echo "<h2>Pinned Projects</h2>";
$query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL FROM projects INNER JOIN (SELECT projectID FROM favourite_project WHERE userID=".$_SESSION['userID'].") AS fave ON projects.projectID = fave.projectID";

    $result = mysqli_query($connection, $query);
    echo "<div class='project_container'>";
        while($row = mysqli_fetch_row($result)){ // add rows to the table
            echo "<div class='project_item'>";
            echo "<div class='project'>";
            echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] . "</a><br>";
            echo "<img src='". $row[4] . "'><br>";
            echo "</div>";
            echo "</div>";
        }
    echo "</div>";
  }
  else{
    echo "<h2>Highest Rated Projects</h2>";
    $query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL FROM projects INNER JOIN (SELECT projectID FROM ratings ORDER BY rating DESC LIMIT 5) AS top ON projects.projectID = top.projectID";
        $result = mysqli_query($connection, $query);
        echo "<div class='project_container'>";
            while($row = mysqli_fetch_row($result)){ // add rows to the table
                echo "<div class='project_item'>";
                echo "<div class='project'>";
                echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] . "</a><br>";
                echo "<img src='". $row[4] . "'><br>";
                echo "</div>";
                echo "</div>";
            }
        echo "</div>";
  }
  ?>
</div>
