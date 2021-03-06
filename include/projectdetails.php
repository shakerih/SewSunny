<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<script src="http://antenna.io/demo/jquery-bar-rating/jquery.barrating.js"></script>
<link href="http://antenna.io/demo/jquery-bar-rating/dist/themes/fontawesome-stars.css" rel="stylesheet"/>

<script type="text/javascript">
$( document ).ready(function(){
    $('#example').barrating({
        theme: 'fontawesome-stars'
    });

    $('#example').on("change", function(event) { //when rating changes, send the info to rateprocess.php to be processed
        $('select').barrating('readonly', true);
        event.preventDefault();
        var formData = {
            'num'              : $('#example').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'rateprocess.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'html', // what type of data do we expect back from the server
            encode          : true
        })
        .done(function(data) {
            location.reload();

        });

    });

    $('#comform').submit(function(event) { //submit the comment through ajax with comment.php
        event.preventDefault();
        var formData = {
            'text'              : $('#comment').val(),
        };
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'comment.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'html', // what type of data do we expect back from the server
            encode          : true
        })
        .done(function(data) {
            location.reload();
        });

    });
});
</script>

</script>
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
<?php include('header.php');

if(isset($_SERVER["HTTPS"]))
{
    header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
?>


<?php

if(is_logged_in()){
    // check if current project exist in the favourite_project table with same userID and projectID
    $checkPin = mysqli_query($connection, "SELECT * FROM favourite_project WHERE userID=".$_SESSION['userID']." AND projectID=".htmlspecialchars($_GET['projectCode']));
    // if project exist
    if (mysqli_num_rows($checkPin)){
        $pinText = "ALREADY PINNED";
    } else { //if not, allow user to pin project
        $pinText = "PIN TO PINBOARD";
    }

    if(isset($_POST['updatePost'])){ //allow post to be updated
      header("Location: postproject.php?update=".htmlspecialchars($_GET['projectCode']));
    }

    if(isset($_POST['pin']) & !mysqli_num_rows($checkPin)){
        $result = mysqli_query($connection, "INSERT INTO favourite_project (userID,projectID) VALUES(". $_SESSION['userID']. "," . htmlspecialchars($_GET['projectCode']).")");
        $pinText = "ALREADY PINNED";
    }
}

if(isset($_GET["projectCode"])){
    //send query and catch error
    $_SESSION['currproject'] = htmlspecialchars($_GET["projectCode"]);
    $result = mysqli_query($connection, "SELECT * FROM projects WHERE projectID='".htmlspecialchars($_GET["projectCode"])."'");
    if (!$result) {
        die("Database query failed 3.");
    }

    $row = mysqli_fetch_row($result);
    //display this project
    echo "<div class='header_space'></div>";
    echo "<div class='content_container'>";

        echo "<div class='project_detail_wrapper'>";
            echo "<div class='detail_left'>";
                echo "<h2>".$row[1]."</h2>";
            echo "</div>";

            echo "<div class='detail_right'>";
                $author = mysqli_query($connection, "SELECT username FROM members WHERE userID='".$row[3]."'");
                $authorID= mysqli_fetch_row($author);
                if(is_logged_in() && $authorID[0]==$_SESSION['username'])
                echo "<form id='update' method='post'><input type='submit' id='updatePost' name='updatePost' value='EDIT POST'></form>";
            echo "</div>";
        echo "</div>";

        echo "<div class='project_detail_wrapper'>";

        echo "<div class='detail_left'>";
            echo "<img src='".$row[5]."'>";
            echo "<h3>Description:</h3>";
            echo "<p>".$row[4]."</p>";
        echo "</div>";

        echo "<div class='detail_right'>";

            echo "<p><strong>Owner: </strong><a href='profile.php?profileCode=".$authorID[0]."'>".$authorID[0]."</a></p>";
            echo "<p><strong>Posted: </strong>".$row[6]."</p> <hr>";

            $cr = mysqli_query($connection, "SELECT * FROM category WHERE categoryID='".$row[7]."'");
            $cat = mysqli_fetch_row($cr);
            echo "<p><strong>Category: </strong>".$cat[1]."</p>";
            $dif = mysqli_query($connection, "SELECT * FROM difficulty WHERE difficultyID ='".$row[2]."'");
            $ldif = mysqli_fetch_row($dif);
            echo "<p><strong>Difficulty: </strong>".$ldif[1]."</p>";
            echo "<p><strong>Tags: </strong>".$row[8]."</p>";
            if(is_logged_in()){ //if user is signed in, allow them to rate the project

                echo "<hr>";
                $resultr = mysqli_query($connection, "SELECT rating FROM ratings WHERE projectID='".$_SESSION['currproject']."'");
                $avgrating = $rateDisplay = 0;
                $numrows = 0;
                while($r = mysqli_fetch_row($resultr)){ // add rows to the table
                    foreach($r as $i){  //with values separated by column
                        $avgrating += $i;
                        $numrows += 1;
                    }
                }
                if($numrows > 0) {
                    $rateDisplay = bcdiv( $avgrating, $numrows, 2);
                    $avgrating = intdiv( $avgrating, $numrows);
                }

                echo '<form name="rateform" id="'.$avgrating.'" method="post" action="projectdetails.php"><select id="example">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select></form>';
                echo "<p>".number_format($rateDisplay, 1). " average based on " . $numrows . " reviews. </p>";

                echo "<hr>";
                echo "<form method='post'> <input class='pin_button' type='submit' name='pin' value='".$pinText."'/></form>";
            }
        echo "</div>";

        //Material details
        echo "<div class='detail_left'>";
            echo "<h3>Materials:</h3>";
            $result = mysqli_query($connection, "SELECT quantity, unit, materialName FROM materials WHERE projectID='".htmlspecialchars($_GET["projectCode"])."'");
            echo "<ul class='material_list'>";
            while($row = mysqli_fetch_row($result)){ // add rows to the table
                echo "<li>";
                foreach($row as $i){  //with values separated by column
                    echo " " . $i . " ";
                }
                echo "</li>";
            }
            echo "</ul>";
        echo "</div>";

        //Process details
        echo "<div class='detail_left'>";
            echo "<h3>Steps:</h3>";
            $result = mysqli_query($connection, "SELECT instructions, instruct_photo FROM steps WHERE projectID='".htmlspecialchars($_GET["projectCode"])."' ORDER BY stepnumber");
            echo "<ol class='process_list'>";
            while($row = mysqli_fetch_row($result)){ // add rows to the table
                echo "<li>";
                    echo "" . $row[0] . " ";
                    if($row[1]){

                        echo "<img src='".$row[1]."'>";
                    }
                echo "</li>";
                echo "<hr class='dotline'>";
            }
            echo "</ol>";
            echo "<p style='text-align: center;'>THE END</p>";
        echo "</div>";

        //Comment
        if(is_logged_in()){
            echo "<div class='detail_left'>";
            echo "<hr>";
            echo "<h3>Comments:</h3>";
                $result = mysqli_query($connection, "SELECT members.username, comment.time, comment.comment FROM comment INNER JOIN members ON comment.userID = members.userID WHERE projectID='".htmlspecialchars($_GET["projectCode"])."' ");
                while($row = mysqli_fetch_row($result)){ 
                    echo "<div class='comment_block'>";
                        echo "<p class='comment_name'>" . $row[0] . "</p>";
                        echo "<p class='comment_time'>" . $row[1] . "</p>";
                        echo "<p class='comment_text'>" . $row[2] . "</p>";
                        echo "<hr>";
                    echo "</div>";
                }
                echo "<br><h3>Leave a Comment:</h3><br>";
                echo "<form method='post' id='comform'><textarea name='comment' id='comment' rows='8' cols='100' placeholder='Enter your comment here...'></textarea><br><input type='submit' name='submit' value='SUBMIT COMMENT'></input></form>";
                echo "</div>";
            echo "</div>";
        }

    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>
