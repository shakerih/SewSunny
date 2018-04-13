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
    // if member is logged in, show pin board
    if(is_logged_in()){
        echo "<div class='header_space'></div>";
        echo "<div class='content_container'>";
        echo "<h2>Pinned Projects</h2>";
        $query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID  INNER JOIN (SELECT projectID FROM favourite_project WHERE userID=".$_SESSION['userID'].") AS fave ON projects.projectID = fave.projectID ORDER BY projects.projectID";

        echo "<div class='project_container'>";
        $result = mysqli_query($connection, $query);
        // add rows to the table
        while($row = mysqli_fetch_row($result)){
            echo "<div class='project_item'>";
                echo "<div class='project'>";
                    // echo "<div class='img_overlay'></div>";
                    echo "<a href='projectdetails.php?projectCode=". $row[0]."'>" . "<div class='overlay'></div>" . "<img src='". $row[4] . "'>" . "</a>";
                    // echo "<img src='". $row[4] . "'><br>";
                    echo "<a href='projectdetails.php?projectCode=". $row[0]."'>" . $row[1] ."</a> </br>";
                    echo "<span class='project_category'> ".$row[5]. "</span> <span class='pinfo'> by </span>";
                    echo "<a class='project_author' href='profile.php?profileCode=". $row[6]."'>".$row[6] . "</a></br>";
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
    // if member is not logged in, show highest rated projects
    else{
        echo "<div class='img_cover'></div>";
        echo "<div class='content_container'>";
        echo "<h2>Highest Rated Projects</h2>";
        $query = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID INNER JOIN (SELECT projectID, sum(rating)/COUNT(*) FROM ratings GROUP BY projectID ORDER BY rating DESC LIMIT 6) AS top ON projects.projectID = top.projectID";
        // this groups the rated project with same id and calculate the rating
        // SELECT projectID, sum(rating)/COUNT(*) FROM ratings GROUP BY projectID


        echo "<div class='project_container'>";
        $result = mysqli_query($connection, $query);
        // add rows to the table
        while($row = mysqli_fetch_row($result)){
            echo "<div class='project_item'>";
                echo "<div class='project'>";
                    // echo "<div class='img_overlay'></div>";
                    echo "<a href='projectdetails.php?projectCode=". $row[0]."'>" . "<div class='overlay'></div>" . "<img src='". $row[4] . "'>" . "</a>";
                    // echo "<img src='". $row[4] . "'><br>";
                    echo "<a href='projectdetails.php?projectCode=". $row[0]."'>" . $row[1] ."</a> </br>";
                    echo "<span class='project_category'> ".$row[5]. "</span> <span class='pinfo'> by </span>";
                    echo "<a class='project_author' href='profile.php?profileCode=". $row[6]."'>".$row[6] . "</a></br>";
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
