<!-- MANY OF THE FUNCTIONS USED IN THIS PROJECT HAVE BEEN MODIFIED OR USED FROM THE WEEK 8 TUTORIAL AND LECTURE -->
<?php
    require_once('initialize.php');
    // Create a database connection
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "sew_sunny";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
?>

<?php include('header.php'); ?>

<div id="content">
    <?php
    if(is_logged_in()){
        echo "<div class='img_cover'></div>";
        echo "<div class='project_container'>";
        echo "<h2>Pinned Projects</h2>";
        $query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL FROM projects INNER JOIN (SELECT projectID FROM favourite_project WHERE userID=".$_SESSION['userID'].") AS fave ON projects.projectID = fave.projectID";

        $result = mysqli_query($connection, $query);
        echo "<div class='project_container'>";
        // add rows to the table
        while($row = mysqli_fetch_row($result)){
            echo "<div class='project_item'>";
            echo "<div class='project'>";
            // echo "<div class='img_overlay'></div>";
            echo "<img src='". $row[4] . "'><br>";
            echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] . "</a><br>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
    else{
        echo "<div class='img_cover'></div>";
        echo "<div class='content_container'>";
        echo "<h2>Highest Rated Projects</h2>";
        $query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL FROM projects INNER JOIN (SELECT projectID FROM ratings ORDER BY rating DESC LIMIT 5) AS top ON projects.projectID = top.projectID";

        $result = mysqli_query($connection, $query);
        echo "<div class='project_container'>";
        // add rows to the table
        while($row = mysqli_fetch_row($result)){
            echo "<div class='project_item'>";
            echo "<div class='project'>";
            // echo "<div class='img_overlay'></div>";
            echo "<img src='". $row[4] . "'><br>";
            echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] . "</a><br>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
