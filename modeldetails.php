<style>table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<script src="http://antenna.io/demo/jquery-bar-rating/jquery.barrating.js"></script>
<link href="http://antenna.io/demo/jquery-bar-rating/dist/themes/fontawesome-stars.css" rel="stylesheet"/>

<script type="text/javascript">
$( document ).ready(function(){
  $('#example').barrating({
    theme: 'fontawesome-stars'
  });

  $('#example').change(function(event) {
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

                // here we will handle errors and validation messages
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

if(isset($_POST['pin'])){
    $result = mysqli_query($connection, "INSERT INTO favourite_project (userID, projectID) VALUES(".$_SESSION['userID'].", ".$_GET["projectCode"].")");

}


if(isset($_GET["projectCode"])){
	//send query and catch error
        $_SESSION['currproject'] = $_GET["projectCode"];
        $result = mysqli_query($connection, "SELECT * FROM projects WHERE projectID='".$_GET["projectCode"]."'");
        if (!$result) {
          die("Database query failed 3.");
        }

        $row = mysqli_fetch_row($result);

        echo "<h1>".$row[1]."</h1><br>";

        if(is_logged_in()){
       echo "<form method='post'> <input type='submit' name='pin'  value='Pin to Pinboard'/><br/></form>";
       echo '<form name="rateform" method="post"><select id="example">
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
       </select></form>';
        }

        echo "<p>Difficulty: ".$row[2]."</p><br><br>";
        echo "<p>".$row[4]."</p><br><br>";
        echo "<img src='".$row[5]."'><br>";
         $cr = mysqli_query($connection, "SELECT * FROM category WHERE categoryID='".$row[7]."'");
         $cat = mysqli_fetch_row($cr);
        echo "<p>Category: ".$cat[1]."</p><br>";
        echo "<p>Tags: ".$row[8]."</p><br>";
        echo "<h3>Materials:</h3><br>";
        //create the table and columns

         $result = mysqli_query($connection, "SELECT * FROM materials WHERE projectID='".$_GET["projectCode"]."'");
       echo "<table>";
        while($row = mysqli_fetch_row($result)){ // add rows to the table
          echo "<tr>";
          foreach($row as $i){  //with values separated by column
            echo "<td >" . $i . "</td>";
          }
          echo "</tr>";
        }
        echo "</table>";

        echo "<h3>Steps:</h3><br>";
            $result = mysqli_query($connection, "SELECT * FROM steps WHERE projectID='".$_GET["projectCode"]."' ORDER BY stepnumber");
       echo "<table>";
        while($row = mysqli_fetch_row($result)){ // add rows to the table
          echo "<tr>";
          foreach($row as $i){  //with values separated by column
            echo "<td >" . $i . "</td>";
          }
          echo "</tr>";
        }
        echo "</table>";
}
?>
