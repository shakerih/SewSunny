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

if(isset($_GET['update'])){
    $projectCode = $_GET['update'];
    $projectID = $_GET['update'];
    $result = mysqli_query($connection, "SELECT * FROM projects WHERE projectID='".$_GET["update"]."'");
    $project = mysqli_fetch_row($result);
    if($project[3] != $_SESSION['userID']) die("You cannot edit this page.");

}else{
  $projectID = mysqli_insert_id($connection);
}

if(is_post_request()) {

    $title = $_POST['title'] ?? '';
    $shortdes = $_POST['shortdes'] ?? '';
    $category = $_POST['category'] ?? '';
    $difficulty = $_POST['difficulty'] ?? '';
    $tags = $_POST['tags'] ?? '';
    $imageURL = $_POST['fileToUpload'] ?? '';


    // Validations
    if(is_blank($title)) {
        $errors[] = "Title cannot be blank.";
    }
    if(is_blank($shortdes)) {
        $errors[] = "Short Description cannot be blank.";
    }
    if(is_blank($category)) {
        $errors[] = "Category cannot be blank.";
    }
    if(is_blank($difficulty)) {
        $errors[] = "Difficulty cannot be blank.";
    }
    if(is_blank($imageURL)) {
        // $imageURL = "image/no_image_available.jpeg";
    }


    if(empty($errors)){
        // set time to Canada Pacific time
        date_default_timezone_set("Canada/Pacific");

        if(isset($_GET['update'])){
          $query = "DELETE FROM steps WHERE projectID=".$projectID;
          $result = mysqli_query($connection, $query);
        }

        if(isset($_POST["submit"])) {
            $target_dir = "uploads/";
            // if no image is uploaded, show image not available
            if(basename($_FILES["fileToUpload"]["name"]) == ""){
                $target_file = "image/no_image_available.jpeg";
            }else {
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            }

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            if(isset($projectCode)){
              $query = "UPDATE projects SET projectTitle=".$title." levelDifficulty=".$difficulty." description=".$shortdes." imgURL=".$target_file." categoryID=".$category." tag=".$tags." WHERE projectID=".$projectCode;
            $result = mysqli_query($connection, $query);
            }else {
              $query = "INSERT INTO projects (projectTitle, levelDifficulty, userID, description, imgURL, time, categoryID, tag ) VALUES ('".$title."', ".$difficulty.", ".$_SESSION['userID'].", '".$shortdes."', '".$target_file."', '".date('Y-m-d H:i')."', '".$category."', '".$tags."')";

            $result = mysqli_query($connection, $query);
            $projectID = mysqli_insert_id($connection);
            }


                    $s = 1;

                    while(isset($_POST[$s.'inst'])){
                        //  array_push($steps, [ $_POST[$s.'inst'], $_POST[$s.'url'] ?? '']);

                        $query = "INSERT INTO steps (projectID, stepnumber, instructions) VALUES (".$projectID.", ".$s.", '".$_POST[$s.'inst']."')";
                        $result = mysqli_query($connection, $query);

                        $s++  ;

                    }

                    $m = 1;
                    if(isset($projectCode)){
                      $query = "DELETE FROM materials WHERE projectID=".$projectCode;
                      $result = mysqli_query($connection, $query);
                    }
                    while(isset($_POST[$m.'quant'])){
                        //  array_push($steps, [ $_POST[$s.'inst'], $_POST[$s.'url'] ?? '']);

                        $query = "INSERT INTO materials ( materialName, quantity, unit, projectID) VALUES ('".$_POST[$m.'name']."', '".$_POST[$m.'quant']."', '".$_POST[$m.'units']."', ".$projectID.")";
                        $result = mysqli_query($connection, $query);
                        echo $m;
                        $m++  ;

                    }
             echo $projectID;
            // redirect to new posted project if posted project successfully
           header("Location: projectdetails.php?projectCode=".$projectID);
        }
    }
}
?>


<div class="header_space"></div>
<div class="content_container">
    <form id="all" name="all" method="post" enctype= "multipart/form-data">

        <h2>The Basics</h2> <p>*indicates required fields</p>
        <?php echo display_errors($errors); ?>
        <div class="post_wrapper">
            <!-- display error -->
            <?php if (isset($_GET['error'])) { //read error from URL?>
                <span style="color:red">
                    <?php echo str_replace(",","<br>",$_GET['error'])."<br>"; ?>
                </span>

                <?php echo $_GET['error']; } ?>

                <div class="post_left">
                    <h3>Project Title *</h3>
                    <input type="text" name="title" autofocus value="<?php
                    if(isset($_GET['update'])){
                      echo $project[1];
                    }
                    else
                    echo htmlspecialchars($title);

                    ?>">

                    <h3>Short Description *</h3>
                    <textarea name="shortdes" rows="5" id="shortdes" form="all" placeholder="Enter description here..." ><?php
                    if(isset($_GET['update'])){
                      echo $project[4];
                    }
                    ?></textarea>
                    <h3>Tags</h3>
                    <input type="text" name="tags" value="<?php
                    if(isset($_GET['update'])){
                      echo $project[8];
                    }
                    ?>">
                    <hr>

                    <h3 id="mainstep"> Instructions *</h3>
                    <input type="button" id="stepAdd" value="Add Step" onclick="addstep" class="bt" />
                    <?php

                    if(isset($_GET['update'])){
                    $result = mysqli_query($connection, "SELECT instructions, instruct_photo FROM steps WHERE projectID='".$projectCode."' ORDER BY stepnumber");

                  ?>
                <script>
                 sCnt = 0;
                        var scontainer = $(document.createElement('div'));
                  <?php while($row = mysqli_fetch_row($result)){ ?>
                    console.log("scontainer");

                    sCnt++;

                    // ADD TEXTBOX.
                    $(scontainer).append('Step '+sCnt+' <br><textarea name="'+sCnt+'inst"  rows="8" placeholder="Enter instructions here..." ><?php echo $row[0]; ?></textarea>Image URL<input type="text" name="'+sCnt+'url" ><br>');

                    // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                    $('#mainstep').after(scontainer);
                      <?php }?>
                </script>
              <?php }?>

                </div>
                <div class="post_right">
                    <h3>Project Image</h3>
                    <!-- <input type="text" name="purl" > -->
                    <input type="file" name="fileToUpload" id="fileToUpload" value="<?php
                    if(isset($_GET['update'])){
                      echo $project[5];
                    }
                    ?>">

                    <h3>Category *</h3>
                    <select name="category" size="0" >
                        <option value=""  <?php
                        if(!isset($_GET['update'])){
                          echo "selected";
                        }
                        ?>>-- Select One --</option>
                        <option value="CAT_0" <?php
                        if(isset($_GET['update']) && $project[7] == 'CAT_0'){
                          echo "selected";
                        }
                        ?>>Crochet</option>
                        <option value="CAT_1"  <?php
                        if(isset($_GET['update']) && $project[7] == 'CAT_1'){
                          echo "selected";
                        }
                        ?>>Cross Stich</option>
                        <option value="CAT_2"  <?php
                        if(isset($_GET['update']) && $project[7] == 'CAT_2'){
                          echo "selected";
                        }
                        ?>>Sewing</option>
                        <option value="CAT_3"  <?php
                        if(isset($_GET['update']) && $project[7] == 'CAT_3'){
                          echo "selected";
                        }
                        ?>>Knitting</option>
                    </select>
                    <h3>Difficulty *</h3>
                    <select name="difficulty" size="0" >
                        <option value=""  <?php
                        if(!isset($_GET['update'])){
                          echo "selected";
                        }
                        ?>>-- Select One --</option>
                        <option value="1"  <?php
                        if(isset($_GET['update']) && $project[2] == '1'){
                          echo "selected";
                        }
                        ?>>Easy</option>
                        <option value="2"  <?php
                        if(isset($_GET['update']) && $project[2] == '2'){
                          echo "selected";
                        }
                        ?>>Intermediate</option>
                        <option value="3"  <?php
                        if(isset($_GET['update']) && $project[2] == '3'){
                          echo "selected";
                        }
                        ?>>Difficult</option>
                    </select>

                    <h3 id="main">Tools and Materials *</h3>
                    <input type="button" id="btAdd" name="materials" value="Add Item" class="bt" />
                    <?php

                    if(isset($projectCode)){
                  $result = mysqli_query($connection, "SELECT quantity, unit, materialName FROM materials WHERE projectID='".$projectCode."'");
                  ?>
                <script>
                 iCnt = 0;
                // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
                var container = $(document.createElement('div'));


                  <?php while($row = mysqli_fetch_row($result)){ ?>
                                console.log(container);

                                iCnt++;

                                // ADD TEXTBOX.
                                $(container).append('Material '+iCnt+' <br><input type="number" name="'+iCnt+'quant" value="<?php echo $row[0];?>"><select name="'+iCnt+'units" size="0" ><option value="" <?php if(!isset($_GET['update'])){ echo "selected";}?>>-- Select One --</option><option value="pounds" <?php if(isset($_GET['update']) && $row[1] == "pounds"){ echo "selected";}?>>lbs</option><option value="cm" <?php if(isset($_GET['update']) && $row[1] == "cm"){ echo "selected";}?>>cm</option><option value="meter" <?php if(isset($_GET['update']) && $row[1] == "meter"){ echo "selected";}?>>meters</option><option value="pcs" <?php if(isset($_GET['update']) && $row[1] == "pcs"){ echo "selected";}?>>pcs</option> <option value="rolls" <?php if(isset($_GET['update']) && $row[1] == "rolls"){ echo "selected";}?>>rolls</option><option value="kg" <?php if(isset($_GET['update']) && $row[1] == "kg"){ echo "selected";}?>>kg</option><option value="items" <?php if(isset($_GET['update']) && $row[1] == "items"){ echo "selected";}?>>items</option><option value="mm"   <?php if(isset($_GET['update']) && $row[1] == "mm"){ echo "selected";}?>>mm</option></select><input type="text" name="'+iCnt+'name" value="<?php echo $row[2];?>"><br>');


                                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                                $('#main').after(container);
                      <?php }?>
                </script>
              <?php }?>
                </div>
                <div class="post_left">
                    <input type="submit" name="submit" value="SUBMIT POST">
                </div>
            </div>
        </form>
    </div>


    <script>
    <?php if(!isset($projectCode)){?>
             sCnt = 0;
            <?php } ?>
            var scontainer = $(document.createElement('div'));
    function addstep() {


      console.log("scontainer");

      sCnt++;

      // ADD TEXTBOX.
      $(scontainer).append('Step '+sCnt+' <br><textarea name="'+sCnt+'inst"  rows="8" placeholder="Enter instructions here..." ></textarea>Image URL<input type="text" name="'+sCnt+'url" ><br>');

      // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
      $('#mainstep').after(scontainer);

    }

    <?php if(!isset($projectCode)){?>
             iCnt = 0;
            <?php } ?>
            // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
    var container = $(document.createElement('div'));

    function addmat(){

                console.log(container);

                iCnt = iCnt + 1;

                // ADD TEXTBOX.
                $(container).append('Material '+iCnt+' <br><input type="number" name="'+iCnt+'quant" value="enter quantity"><select name="'+iCnt+'units" size="0" ><option value="" selected>-- Select One --</option><option value="pounds">lbs</option><option value="cm">cm</option><option value="meter">meters</option><option value="pcs">pcs</option> <option value="rolls">rolls</option><option value="kg">kg</option><option value="items">items</option><option value="mm">mm</option></select><input type="text" name="'+iCnt+'name" value="material name"><br>');


                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                $('#main').after(container);

            }

    $(document).ready(function() {

        $('#btAdd').click(addmat);

        $("#stepAdd").click(addstep);


    })
    // PICK THE VALUES FROM EACH TEXTBOX WHEN "SUBMIT" BUTTON IS CLICKED.
    var divValue, values = '';

    function GetTextValue() {
        $(divValue)
        .empty()
        .remove();

        values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Your selected values</b></p>' + values);
        $('body').append(divValue);
    }
</script>
