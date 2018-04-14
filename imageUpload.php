<?php

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "sew_sunny";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



?>


<html>
<body>

    <form method="POST" action="getdata.php" enctype="multipart/form-data">
     <input type="file" name="myimage">
     <input type="submit" name="submit_image" value="Upload">
    </form>

</body>
</html>


<?php

    $imagename=$_FILES["myimage"]["name"]; 

    //Get the content of the image and then add slashes to it
    $imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

    //Insert the image name and image content in image_table
    $insert_image="INSERT INTO image_table VALUES('$imagetmp','$imagename')";

    mysql_query($insert_image);

?>
