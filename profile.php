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
<?php
    include('header.php');
    if(!is_logged_in()){
      header("Location: index.php");
    }
?>

<?php
    if(isset($_SESSION['userID'])){
        $currentProfile = $_GET['profileCode']
?>
        <div class="header_space"></div>
        <div class="content_container">
            <h2><?php echo($currentProfile) ?>&#39;s projects</h2>
            <div class='project_container'>
<!-- WHERE userID=".$_SESSION['userID'] $memProjectQ  $memProjectList-->
            <?php

            $memProjectQ = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID WHERE projects.userID=(SELECT members.userID FROM members WHERE members.username='".$currentProfile."') ORDER BY projects.projectID";

            // echo "<div class='project_container'>";
            $memProjectList = mysqli_query($connection, $memProjectQ);
            // add rows to the table
            while($row = mysqli_fetch_row($memProjectList)){
                echo "<div class='project_item'>";
                    echo "<div class='project'>";
                        // echo "<div class='img_overlay'></div>";
                        echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . "<div class='overlay'></div>" . "<img src='". $row[4] . "'>" . "</a>";
                        // echo "<img src='". $row[4] . "'><br>";
                        echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] ."</a> </br>";
                        echo "<span class='project_category'> ".$row[5]. "</span> <span class='pinfo'> by </span>";
                        echo "<a class='project_author' href='modeldetails.php?projectCode=". $row[0]."'>".$currentProfile. "</a></br>";
                    echo "</div>";
                echo "</div>";
            }
            ?>

            </div>
        </div>


<?php
// echo $currentProfile;
    }
    if(is_logged_in()) {
        // <div>

    }
?>
