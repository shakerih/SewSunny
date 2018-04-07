<style>table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
</style>
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

        $result = mysqli_query($connection, "SELECT * FROM projects WHERE projectID='".$_GET["projectCode"]."'");
        if (!$result) {
          die("Database query failed 3.");
        }

        $row = mysqli_fetch_row($result);

        echo "<h1>".$row[1]."</h1><br>";

        if(is_logged_in()){
       echo "<form method='post'> <input type='submit' name='pin'  value='Pin to Pinboard'/><br/></form>";
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