<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sew_sunny";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!isset($_SESSION)) { session_start(); }
if(isset($_POST['text'])){
        $searchQuery = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username, projects.userID, projects.levelDifficulty FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID ";
        $searchQuery.= " WHERE category.categoryName='Crochet' ";
        $searchQuery.= "ORDER BY projects.projectID ";
        $result = mysqli_query($connection, $searchQuery);

  }

?>
