
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

<?php //require './header.php';?>
<?php
include('header.php');
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
        if(isset($_POST["submit"])) {
            echo "ssssssss";
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
            if ($_FILES["fileToUpload"]["size"] > 500000) {
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

            $query = "INSERT INTO projects (projectTitle, levelDifficulty, userID, description, imgURL, time, categoryID, tag ) VALUES ('".$title."', ".$difficulty.", ".$_SESSION['userID'].", '".$shortdes."', '".$target_file."', '".date('Y-m-d H:i')."', '".$category."', '".$tags."')";
            $result = mysqli_query($connection, $query);
            $projectID = mysqli_insert_id($connection);


            // echo $projectID;
            // redirect to new posted project if posted project successfully
            header("Location: projectdetails.php?projectCode=".$projectID);
        }
    }
}
?>


<div class="header_space"></div>
<div class="content_container">
    <form id="all" name="all" action="postproject.php" method="post" enctype= "multipart/form-data">

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
                    <input type="text" name="title" autofocus value="<?php echo htmlspecialchars($title); ?>">

                    <h3>Short Description *</h3>
                    <textarea name="shortdes" rows="5" id="shortdes" form="all" placeholder="Enter description here..." ></textarea>
                    <h3>Tags</h3>
                    <input type="text" name="tags" >
                    <hr>

                    <h3 id="mainstep"> Instructions *</h3>
                    <input type="button" id="stepAdd" value="Add Step" class="bt" />
                </div>
                <div class="post_right">
                    <h3>Project Image URL</h3>
                    <!-- <input type="text" name="purl" > -->
                    <input type="file" name="fileToUpload" id="fileToUpload">

                    <h3>Category *</h3>
                    <select name="category" size="0" >
                        <option value="" selected>-- Select One --</option>
                        <option value="CAT_0">Crochet</option>
                        <option value="CAT_1">Cross Stich</option>
                        <option value="CAT_2">Sewing</option>
                        <option value="CAT_3">Knitting</option>
                    </select>
                    <h3>Difficulty *</h3>
                    <select name="difficulty" size="0" >
                        <option value="" selected>-- Select One --</option>
                        <option value="0">Easy</option>
                        <option value="1">Intermediate</option>
                        <option value="2">Difficult</option>
                    </select>

                    <h3 id="main">Tools and Materials *</h3>
                    <input type="button" id="btAdd" name="materials" value="Add Item" class="bt" />
                </div>
                <div class="post_left">
                    <input type="submit" name="submit" value="SUBMIT POST">
                </div>
            </div>
        </form>
    </div>


    <script>
    $(document).ready(function() {

        var iCnt = 0;
        var sCnt = 0;
        // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
        var container = $(document.createElement('div'));

        $('#btAdd').click(function() {

            console.log(container);

            iCnt = iCnt + 1;

            // ADD TEXTBOX.
            $(container).append('Material '+iCnt+' <br><input type="number" name="'+iCnt+'quant" value="enter quantity"><select name="'+iCnt+'units" size="0" ><option value="" selected>-- Select One --</option><option value="pounds">lbs</option><option value="cm">cm</option><option value="meter">meters</option><option value="pcs">pcs</option> <option value="rolls">rolls</option><option value="kg">kg</option><option value="items">items</option><option value="mm">mm</option></select><input type="text" name="'+iCnt+'name" value="material name"><br>');


            // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
            $('#main').after(container);

        });

        var scontainer = $(document.createElement('div'));
        $('#stepAdd').click(function() {

            console.log(scontainer);

            sCnt = sCnt + 1;

            // ADD TEXTBOX.
            $(scontainer).append('Step '+sCnt+' <br><textarea name="'+sCnt+'inst"  rows="8" placeholder="Enter instructions here..." ></textarea>Image URL<input type="text" name="'+sCnt+'url" ><br>');


            // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
            $('#mainstep').after(scontainer);

        });
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
