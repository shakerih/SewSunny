<html>
  <body>

  <?php
  include('header.php');
  if(!is_logged_in()){
	  header("Location: index.php");
  }
  ?>

  <div class="header_space"></div>
  <div class="content_container">
	  <h2>

  <?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "sew_sunny";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $errors = [];
    $title = '';
    $shortdes = '';
	$purl = '';
    $category = '';
    $difficulty = '';
    $materials = [];
    $steps = [];
    $tags = '';
    $imageURL = '';

    if(is_post_request()) {

      $title = $_POST['title'] ?? '';
      $shortdes = $_POST['shortdes'] ?? '';
	  $purl = $_POST['purl'] ?? '';
      $category = $_POST['category'] ?? '';
      $difficulty = $_POST['difficulty'] ?? '';
      $tags = $_POST['tags'] ?? '';
      $imageURL = $_POST['purl'] ?? '';


      // Validations
      if(is_blank($title)) {
        $errors[] = "Title cannot be blank.";
      }
      if(is_blank($shortdes)) {
        $errors[] = "Short Description cannot be blank.";
      }
	  if(is_blank($purl)) {
        $errors[] = "Project Image (URL) cannot be blank.";
      }
      if(is_blank($category)) {
        $errors[] = "Category cannot be blank.";
      }
      if(is_blank($difficulty)) {
        $errors[] = "Difficulty cannot be blank.";
      }



    }
    if(empty($errors)){
      $query = "INSERT INTO projects (projectTitle, levelDifficulty, userID, description, imgURL, time, categoryID, tag ) VALUES ('".$title."', ".$difficulty.", ".$_SESSION['userID'].", '".$shortdes."', '".$imageURL."', '".time()."', '".$category."', '".$tags."')";
      $result = mysqli_query($connection, $query);
      $projectID = mysqli_insert_id($connection);
      $s = 1;

      while(isset($_POST[$s.'inst'])){
      //  array_push($steps, [ $_POST[$s.'inst'], $_POST[$s.'url'] ?? '']);

        $query = "INSERT INTO steps (projectID, stepnumber, instructions) VALUES (".$projectID.", ".$s.", '".$_POST[$s.'inst']."')";
        $result = mysqli_query($connection, $query);

        $s++  ;

      }

        $m = 1;

      while(isset($_POST[$m.'quant'])){
      //  array_push($steps, [ $_POST[$s.'inst'], $_POST[$s.'url'] ?? '']);

        $query = "INSERT INTO materials ( materialName, quantity, unit, projectID) VALUES ('".$_POST[$m.'name']."', '".$_POST[$m.'quant']."', '".$_POST[$m.'units']."', ".$projectID.")";
        $result = mysqli_query($connection, $query);

        $m++  ;

      }

      echo "SUCCESSFULLY POSTED";


  } else {
	  // header("Location: {$_SERVER['HTTP_REFERER']}");
	  // exit;
	  echo $errors[0];

  }
  ?>
</h2>
</div>
  </body>
</html>
