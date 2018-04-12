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
            <!-- <h2><?php //echo($currentProfile) ?>&#39;s Activity</h2>
            <hr>
            <h3>Projects:</h3>
            <div class='project_container'> -->

            <?php
            // if the current profile user name matchs current session username, display register information and allow edit/update
            if($currentProfile == $_SESSION['username']){
                echo "<h2>".$currentProfile."</h2>";

                echo "<hr>";
                echo "<div class='project_container'>";
                    echo "<div class='detail_left'>";
                    echo "<h3>Profile: <input type='button' name='editProfile' value='EDIT'></h3>";
                        $memInfo = mysqli_query($connection, "SELECT username, name, email, password FROM members WHERE username='".$currentProfile."'");
                        while($row = mysqli_fetch_row($memInfo)){ // add rows to the table
                            echo "<form>";
                                echo "<p>Name:</p>";
                                echo "<input type='text' name='name' value='".$row[1]."' disabled>";
                                echo "<p>Username:</p>";
                                echo "<input type='text' name='username' value='".$row[0]."' disabled>";
                                echo "<p>Email:</p>";
                                echo "<input type='text' name='email' value='".$row[2]."' disabled>";
                                echo "<p>Password:</p>";
                                echo "<input type='text' name='password' value='".$row[3]."' disabled>";
                            echo "</form>";
                        }
                        // echo "<input type='button' name='editProfile' value='EDIT'>";
                    echo "</div>";
                echo "</div>";
            }else {
                echo "<h2>".$currentProfile."&#39;s Activity</h2>";
            };


            ?>


            <!-- <h2><?php //echo($currentProfile) ?>&#39;s Activity</h2>
            <hr>
            <h3>Projects:</h3>
            <div class='project_container'> -->

            <?php
            echo "<hr>";
            echo "<h3>Projects:</h3>";
            echo "<div class='project_container'>";

            $memProjectQ = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID WHERE projects.userID=(SELECT members.userID FROM members WHERE members.username='".$currentProfile."') ORDER BY projects.projectID";

            // echo "<div class='project_container'>";
            $memProjectList = mysqli_query($connection, $memProjectQ);
            if(mysqli_num_rows($memProjectList)){
                // add rows to the table
                while($row = mysqli_fetch_row($memProjectList)){
                    echo "<div class='project_item'>";
                        echo "<div class='project'>";
                        // echo "<div class='img_overlay'></div>";
                        echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . "<div class='overlay'></div>" . "<img src='". $row[4] . "'>" . "</a>";
                        // echo "<img src='". $row[4] . "'><br>";
                        echo "<a href='modeldetails.php?projectCode=". $row[0]."'>" . $row[1] ."</a> </br>";
                        echo "<span class='project_category'> ".$row[5]. "</span> <span class='pinfo'> by </span>";
                        echo "<a class='project_author' href='profile.php?profileCode=". $row[6]."'>".$row[6] . "</a></br>";
                        echo "</div>";
                    echo "</div>";
                }
            }
            else {
                // echo "<div class='project_item'>";
                    echo "<p>".$currentProfile. " does not have any project.</p>";
                // echo "</div>";
            }

                $memComment = mysqli_query($connection, "SELECT members.username, comment.time, comment.comment, projects.projectTitle, projects.projectID FROM comment INNER JOIN projects ON comment.projectID = projects.projectID INNER JOIN members ON comment.userID = members.userID WHERE members.username='".$currentProfile."'");
                if(mysqli_num_rows($memComment)){
                    echo "<div class='detail_left'>";
                    echo "<hr>";
                    echo "<h3>Review:</h3>";
                    while($row = mysqli_fetch_row($memComment)){ // add rows to the table
                        echo "<div class='comment_block'>";
                            echo "<p><span class='comment_name'>" . $row[0] ."</span> commented on <a href='modeldetails.php?projectCode=". $row[4]."'>".$row[3] . "</a><span class='comment_time'> on ".$row[1]."</span></p>";
                            echo "<p class='comment_text'>" . $row[2] . "</p>";
                            echo "<hr>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>".$currentProfile. " did not make any comment.</p>";
                }
            echo "</div>";
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
