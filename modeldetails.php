<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<script src="http://antenna.io/demo/jquery-bar-rating/jquery.barrating.js"></script>
<link href="http://antenna.io/demo/jquery-bar-rating/dist/themes/fontawesome-stars.css" rel="stylesheet"/>

<script type="text/javascript">
$( document ).ready(function(){
    $('#example').barrating({
        theme: 'fontawesome-stars'
    });

    console.log($('select').barrating('set', $('[name = "rateform"]').attr("id")));
    $('#example').on("change", function(event) {
        $('select').barrating('readonly', true);
        event.preventDefault();
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
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
        // using the done promise callback
        .done(function(data) {

            // log data to the console so we can see
            console.log(data);
            location.reload();

            // here we will handle errors and validation messages
        });

        // stop the form from submitting the normal way and refreshing the page

    });

    $('#comform').submit(function(event) {
        // console.log('kkkkk');
        event.preventDefault();
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
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
        // using the done promise callback
        .done(function(data) {
            console.log(data);
            location.reload();
        });

        // stop the form from submitting the normal way and refreshing the page

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
<?php include('header.php'); ?>

<?php

// INSERT INTO favourite_project (userID,projectID)
// SELECT 7, 3
//    WHERE NOT EXISTS (SELECT * FROM favourite_project
//                      WHERE userID=7 AND projectID=3)

// object(mysqli_result)#3 (5) {
//   ["current_field"]=&gt;
//   int(0)
//   ["field_count"]=&gt;
//   int(2)
//   ["lengths"]=&gt;
//   NULL
//   ["num_rows"]=&gt;
//   int(1)
//   ["type"]=&gt;
//   int(0)
// }
if(is_logged_in()){
    // check if current project exist in the favourite_project table with same userID and projectID
    $checkPin = mysqli_query($connection, "SELECT * FROM favourite_project WHERE userID=".$_SESSION['userID']." AND projectID=".$_GET['projectCode']);
    // printf(mysqli_num_rows($checkPin));
    // if project exist
    if (mysqli_num_rows($checkPin)){
        $pinText = "ALREADY PINNED";
    } else {
        $pinText = "PIN TO PINBOARD";
    }


    if(isset($_POST['pin']) & !mysqli_num_rows($checkPin)){
        $result = mysqli_query($connection, "INSERT INTO favourite_project (userID,projectID) VALUES(". $_SESSION['userID']. "," . $_GET['projectCode'].")");
        // $result = mysqli_query($connection, "INSERT INTO favourite_project (userID,projectID) SELECT ".$_SESSION['userID'].",".$_GET['projectCode'] . " WHERE NOT EXISTS (SELECT * FROM favourite_project WHERE userID=".$_SESSION['userID']." AND projectID=".$_GET['projectCode'] .")");
        $pinText = "ALREADY PINNED";
    }
}


if(isset($_GET["projectCode"])){
    //send query and catch error
    $_SESSION['currproject'] = $_GET["projectCode"];
    $result = mysqli_query($connection, "SELECT * FROM projects WHERE projectID='".$_GET["projectCode"]."'");
    if (!$result) {
        die("Database query failed 3.");
    }

    $row = mysqli_fetch_row($result);

    echo "<div class='header_space'></div>";
    echo "<div class='content_container'>";
        echo "<h2>".$row[1]."</h2>";
        echo "<div class='project_detail_wrapper'>";
        echo "<div class='detail_left'>";
            echo "<img src='".$row[5]."'>";
            echo "<h3>Description:</h3>";
            echo "<p>".$row[4]."</p>";
        echo "</div>";

        echo "<div class='detail_right'>";
            $author = mysqli_query($connection, "SELECT username FROM members WHERE userID='".$row[3]."'");
            $authorID= mysqli_fetch_row($author);
            echo "<p><strong>Owner: </strong>".$authorID[0]."</p>";
            echo "<p><strong>Posted: </strong>".$row[6]."</p> <hr>";

            $cr = mysqli_query($connection, "SELECT * FROM category WHERE categoryID='".$row[7]."'");
            $cat = mysqli_fetch_row($cr);
            echo "<p><strong>Category: </strong>".$cat[1]."</p>";
            $dif = mysqli_query($connection, "SELECT * FROM difficulty WHERE difficultyID ='".$row[2]."'");
            $ldif = mysqli_fetch_row($dif);
            echo "<p><strong>Difficulty: </strong>".$ldif[1]."</p>";
            echo "<p><strong>Tags: </strong>".$row[8]."</p>";
            if(is_logged_in()){

                echo "<hr>";

                $resultr = mysqli_query($connection, "SELECT rating FROM ratings WHERE projectID='".$_SESSION['currproject']."'");
                $avgrating = 0;
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
                // if($numrows > 0) $avgrating = intdiv( $avgrating ,$numrows);
                //   echo $avgrating;

                echo '<form name="rateform" id="'.$avgrating.'" method="post" action="modeldetails.php"><select id="example">
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
            $result = mysqli_query($connection, "SELECT quantity, unit, materialName FROM materials WHERE projectID='".$_GET["projectCode"]."'");
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
            $result = mysqli_query($connection, "SELECT instructions, instruct_photo FROM steps WHERE projectID='".$_GET["projectCode"]."' ORDER BY stepnumber");
            echo "<ol class='process_list'>";
            while($row = mysqli_fetch_row($result)){ // add rows to the table
                echo "<li>";
                    echo " " . $row[0] . " ";
                    if($row[1]){

                        echo "<img src='".$row[1]."'>";
                    }
                echo "</li>";
            }
            echo "</ol>";
        echo "</div>";

        //Comment
        if(is_logged_in()){
            echo "<div class='detail_left'>";
            echo "<hr>";
            echo "<h3>Comments:</h3>";
                $result = mysqli_query($connection, "SELECT members.username, comment.time, comment.comment FROM comment INNER JOIN members ON comment.userID = members.userID WHERE projectID='".$_GET["projectCode"]."' ");
                while($row = mysqli_fetch_row($result)){ // add rows to the table
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
