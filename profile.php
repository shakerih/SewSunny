<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<?php
    include('header.php');

    if(isset($_SERVER["HTTPS"]))
    {
        header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
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


    //catch connection error
    if(mysqli_connect_errno()) {
        die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
        );
    }

?>


<?php
    if(isset($_SESSION['userID'])){
        $currentProfile = htmlspecialchars($_GET['profileCode']);
?>
        <div class="header_space"></div>
        <div class="content_container">

            <?php
            // if the current profile user name matchs current session username, display register information and allow edit/update
            if($currentProfile == $_SESSION['username']){
                echo "<h2>".$currentProfile."</h2>";

                echo "<hr>";
                echo "<div class='project_container'>";
                    echo "<div class='detail_left'>";
                    echo "<h3>Profile: <form id='updateForm' method='post'><input type='button' id='editFile' name='editProfile' value='EDIT'><input type='submit' id='update' name='update' value='SAVE AND UPDATE'></h3>";
                        $memInfo = mysqli_query($connection, "SELECT username, name, email, password FROM members WHERE username='".$currentProfile."'");
                        while($row = mysqli_fetch_row($memInfo)){ // add rows to the table
                            $name = $row[1];
                            $username = $row[0];
                            $password = $row[3];
                                echo "<p>Name:</p>";
                                echo "<input type='text' name='name' id='name' value='".$row[1]."' disabled>";
                                echo "<p>Username:</p>";
                                echo "<input type='text' name='username' id='username' value='".$row[0]."' disabled>";
                                echo "<p>Email:</p>";
                                echo "<input type='text' name='email' id='email' value='".$row[2]."' disabled>";
                                echo "<p>Password:</p>";
                                echo "<input type='text' name='password' id='password' style='display:none' disabled>";
                                echo "<div id='passConfirm' style='display:none'>";
                                    echo "<p>Confirm Password:</p>";
                                    echo "<input type='text' name='compassword' value=''>";
                                echo "</div>";
                            echo "</form>";
                        }

                        ?><script>
                        $('#updateForm').submit(function(event) {

                            event.preventDefault();
                            // get the form data
                            // there are many ways to get this data using jQuery (you can use the class or id also)
                            var formData = {
                                'name'              : $('#name').val(),
                                'username'          : $('#username').val(),
                                'email'             : $('#email').val(),
                                'password'          : $('#password').val(),

                            };

                            // process the form
                            $.ajax({
                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : 'updateprofile.php', // the url where we want to POST
                                data        : formData, // our data object
                                dataType    : 'html', // what type of data do we expect back from the server
                                encode          : true
                            })
                            // using the done promise callback
                            .done(function(data) {
                              $('#editFile').css({
                                'display' : 'block'
                              })
                              $('#update').css({
                                'display' : 'none'
                              })
                              $('input[name="name"]').attr('disabled', 'true');
                              $('input[name="username"]').attr('disabled', 'true');
                              $('input[name="password"]').css({'display' : 'none'});
                              $('#passConfirm').css({'display' : 'none'});

                            });

                            // stop the form from submitting the normal way and refreshing the page

                        });</script><?php
                    echo "</div>";
                echo "</div>";
            }else {
                echo "<h2>".$currentProfile."&#39;s Activity</h2>";
            };


            ?>


            <?php
            echo "<hr>";
            echo "<h3>Projects:</h3>";
            echo "<div class='project_container'>";

            $memProjectQ = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID WHERE projects.userID=(SELECT members.userID FROM members WHERE members.username='".$currentProfile."') ORDER BY projects.projectID";

            $memProjectList = mysqli_query($connection, $memProjectQ);
            if(mysqli_num_rows($memProjectList)){
                // add rows to the table
                while($row = mysqli_fetch_row($memProjectList)){
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
            }
            else {
                // echo "<div class='project_item'>";
                    echo "<p>".$currentProfile. " does not have any project.</p>";
                // echo "</div>";
            }
            echo "</div>";
            ?>

            <h3>Review:</h3>
            <div class='project_container'>
                <?php
                $memComment = mysqli_query($connection, "SELECT members.username, comment.time, comment.comment, projects.projectTitle, projects.projectID FROM comment INNER JOIN projects ON comment.projectID = projects.projectID INNER JOIN members ON comment.userID = members.userID WHERE members.username='".$currentProfile."'");
                if(mysqli_num_rows($memComment)){
                    echo "<div class='detail_left'>";
                    echo "<hr>";
                    while($row = mysqli_fetch_row($memComment)){ // add rows to the table
                        echo "<div class='comment_block'>";
                            echo "<p><span class='comment_name'>" . $row[0] ."</span> commented on <a href='projectdetails.php?projectCode=". $row[4]."'>".$row[3] . "</a><span class='comment_time'> on ".$row[1]."</span></p>";
                            echo "<p class='comment_text'>" . $row[2] . "</p>";
                            echo "<hr>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>".$currentProfile. " did not make any comment.</p>";
                }
                ?>
            </div>
        </div>
    </div>


<?php } ?>


<script>
    $(document).ready(function(){

      $('#update').css({
        'display' : 'none'
      })
        $('#editFile').click(function() {
                $('#editFile').css({
                  'display' : 'none'
                })
                $('#update').css({
                  'display' : 'block',
                  'width' : '25%'
                })

                $('#password').css({
                  'display' : 'block'
                })
                $('input[name="name"]').removeAttr('disabled');
                $('input[name="username"]').removeAttr('disabled');
                $('input[name="password"]').removeAttr('disabled');
                $('#passConfirm').css({'display' : 'block'});

        });
    });
</script>
