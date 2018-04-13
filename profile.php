<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<?php
    include('header.php');
    if(!is_logged_in()){
      header("Location: index.php");
    }
?>

<?php
    // Create a database connection
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "sew_sunny";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // $name = $username = $password = $confirmpassword = '';

    //catch connection error
    if(mysqli_connect_errno()) {
        die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
        );
    }

    // if(is_post_request()) {
    //     // $name = $_GET['name'];
    //     // $username = $_GET['username'];
    //     // $password = $_GET['password'];
    //     // $confirmpassword = $_GET['confirmPassword'] ?? '';
    //     //
    //     // echo $name;
    //
    //     $updateProfile = "UPDATE members SET name='".$name."', username='".$username."', password='".password_hash($password, PASSWORD_BCRYPT)."' WHERE username='".$_SESSION['username']."'";
    //     mysqli_query($connection, $updateProfile);
    // }
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
                    echo "<h3>Profile: <form id='updateForm'><input type='button' id='editFile' name='editProfile' value='EDIT'></form></h3>";
                        $memInfo = mysqli_query($connection, "SELECT username, name, email, password FROM members WHERE username='".$currentProfile."'");
                        while($row = mysqli_fetch_row($memInfo)){ // add rows to the table
                            $name = $row[1];
                            $username = $row[0];
                            $password = $row[3];
                            echo "<form>";
                                echo "<p>Name:</p>";
                                echo "<input type='text' name='name' value='".$row[1]."' disabled>";
                                echo "<p>Username:</p>";
                                echo "<input type='text' name='username' value='".$row[0]."' disabled>";
                                echo "<p>Email:</p>";
                                echo "<input type='text' name='email' value='".$row[2]."' disabled>";
                                echo "<p>Password:</p>";
                                echo "<input type='text' name='password' value='".$row[3]."' disabled>";
                                echo "<div id='passConfirm' style='display:none'>";
                                    echo "<p>Confirm Password:</p>";
                                    echo "<input type='text' name='compassword' value=''>";
                                echo "</div>";
                            echo "</form>";
                        }
                        // echo "<input type='button' name='editProfile' value='EDIT'>";
                        if(is_post_request()) {
                            echo "name: ".$name;

                            // $updateProfile = "UPDATE members SET name='".$row[1]."', username='".$row[0]."', password='".password_hash($row[3], PASSWORD_BCRYPT)."' WHERE username='".$_SESSION['username']."'";
                            // mysqli_query($connection, $updateProfile);
                        }
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


<?php } ?>


<script>
    $(document).ready(function(){
        $('#editFile').click(function() {
            var editButtonValue = $('#editFile').val();
            // alert(editButtonValue);
            if(editButtonValue == "EDIT") {
                $('#editFile').val("SAVE AND UPDATE");
                $('#editFile').css({
                    'width' : '25%',
                    'background' : '#FFAFA1',
                    'color' : '#FFFFFF',
                    'border' : 'none'
                });
                $('#updateForm').attr('method', 'post');
                $('input[name="name"]').removeAttr('disabled');
                $('input[name="username"]').removeAttr('disabled');
                $('input[name="password"]').removeAttr('disabled');
                $('#passConfirm').css({'display' : 'block'});
            } else {
                $('#editFile').val("EDIT");
                $('#editFile').css({
                    'width' : '10%',
                    'background' : 'lightGray',
                    'color' : '#333847'
                });
                // $('#updateForm').removeAttr('method');
                $('input[name="name"]').attr('disabled', 'disabled');
                $('input[name="username"]').attr('disabled', 'disabled');
                $('input[name="password"]').attr('disabled', 'disabled');
                $('#passConfirm').css({'display' : 'none'});


            }
        });
    });
</script>