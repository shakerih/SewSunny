<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
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
    echo "<div class='header_space'></div>";
    echo "<div class='content_container'>";
    echo "<h2>Projects</h2>";
?>


<?php
    $searchTxt = "";
    $conditionA = $conditionU = $conditionT = $conditionC = "";
    $allRlt = $userRlt = $titleRlt = $tagRlt = "";
    $catCroRlt = $catCSRlt = $catSewRlt = $catKnitRlt = "";
    $difEasyRlt = $difInterRlt = $difDifRlt = "";
    $rltTxt = $catTxt = $diffTxt = "";
?>

<?php
    if(is_post_request()) {
        if(isset($_POST["searchTxt"])) {
            $searchTxt = $_POST['searchTxt'];
            $searchTxt = str_replace(" ", "%", $searchTxt);
            // echo "search result: ".$searchTxt;
            // $condition = "";
            if(isset($_POST["allRlt"])) {
                $allRlt = $_POST["allRlt"];
                $conditionA = "WHERE projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR category.categoryName LIKE '%".$searchTxt."%' ";
                $rltTxt = "All projects";
            }
            if(isset($_POST["userRlt"])) {
                $userRlt = $_POST["userRlt"];
                $conditionA = "WHERE members.username LIKE '%".$searchTxt."%' ";
                $rltTxt = "Username";
            }
            if(isset($_POST["titleRlt"])) {
                $titleRlt = $_POST["titleRlt"];
                $conditionA = "WHERE projects.projectTitle LIKE '%".$searchTxt."%' ";
                $rltTxt = "Project title";
            }
            if(isset($_POST["tagRlt"])) {
                $tagRlt = $_POST["tagRlt"];
                $conditionA = "WHERE projects.tag LIKE '%".$searchTxt."%' ";
                $rltTxt = "Project tag";
            }

            // check category set
            if(isset($_POST["catCroRlt"])) {
                $catCroRlt = $_POST["catCroRlt"];
                $catTxt = "Crochet";
            }
            if(isset($_POST["catCSRlt"])) {
                $catCSRlt = $_POST["catCSRlt"];
                $catTxt = "Cross Stitch";
            }
            if(isset($_POST["catSewRlt"])) {
                $catSewRlt = $_POST["catSewRlt"];
                $catTxt = "Sewing";
            }
            if(isset($_POST["catKnitRlt"])) {
                $catKnitRlt = $_POST["catKnitRlt"];
                $catTxt = "Knitting";
            }

            if($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt) {
                // $conditionA = "WHERE category.categoryName='Crochet' AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%') ";
                // if all checkbox and category is checked
                if($catTxt != "") {
                    if($allRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR projects.tag LIKE '%".$searchTxt."%') ";
                        $rltTxt = "All projects : ".$catTxt."";
                    }
                    // if username and category is checked
                    if($userRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND members.username LIKE '%".$searchTxt."%' ";
                        $rltTxt = "Username : ".$catTxt."";
                    }
                    // if username and category is checked
                    if($titleRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.projectTitle LIKE '%".$searchTxt."%' ";
                        $rltTxt = "Project title : ".$catTxt."";
                    }

                    // if text in input is empty && checkbox for all, username, title, tag not checked
                    if($searchTxt=="" && !$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {$conditionA = "WHERE category.categoryName='".$catTxt."' ";}
                }

                // if text in input is empty && checkbox for all, username, title, tag not checked
                if($searchTxt=="" && !$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {
                    if (!$diffTxt && $catTxt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' ";
                        $rltTxt = $catTxt;
                    }
                    if($diffTxt && !$catTxt) {
                        $conditionA = "WHERE projects.levelDifficulty='".$diffTxt."' ";

                        $rltTxt = $diffTxt;
                    }
                    if($diffTxt && $catTxt) {
                        $conditionA = "WHERE (category.categoryName='".$catTxt."' AND projects.levelDifficulty='".$diffTxt."') ";
                        $rltTxt = $catTxt." : " .$diffTxt;
                    }
                }
            }


            $searchQuery = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username, projects.userID FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID ";
            $searchQuery.= $conditionA;
            $searchQuery.= "ORDER BY projects.projectID ";
            $result = mysqli_query($connection, $searchQuery);
            echo $searchQuery;
        }

        // if($filter)
    }
    else if (!isset($_POST["search"]) || $searchTxt == "") {
        $searchQuery = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username, projects.userID FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID ORDER BY projects.projectID";
        // $result = mysqli_query($connection, $query);
    }
    // echo "Search: ".$searchTxt;
    // echo $searchQuery;
?>


<form action="" method="post" id="searchForm">
    <div id="searchFilter" class="search_wrapper">


        <div class="post_left">
            <input type="text" name="searchTxt" id="searchInput" value="<?php echo str_replace("%", " ", $searchTxt); ?>">

            <table class="filterTable">
                <tr>
                    <th>
                        <!-- <input type="checkbox" name="allRlt" id="allChk" onclick="checkA()"  <?php //echo isset($_POST["allRlt"]) ? "checked" : ""; ?>> All -->
                        <input type="radio" name="allRlt"  id="allChk" onclick="checkA()"  <?php echo isset($_POST["allRlt"]) ? "checked" : ""; ?>>
                        <label for="allChk"><span></span>All</label>
                    </th>
                    <th>
                        <input type="radio" name="userRlt"  id="userChk" onclick="checkU()"  <?php echo isset($_POST["userRlt"]) ? "checked" : ""; ?>>
                        <label for="userChk"><span></span>Username</label>
                    </th>
                    <th>
                        <input type="radio" name="titleRlt" id="titleChk" onclick="checkT()"  <?php echo isset($_POST["titleRlt"]) ? "checked" : ""; ?>>
                        <label for="titleChk"><span></span>Project Title</label>
                    </th>
                    <th>
                        <input type="radio" name="tagRlt" id="tagChk" onclick="checkTag()"  <?php echo isset($_POST["tagRlt"]) ? "checked" : ""; ?>>
                        <label for="tagChk"><span></span>Project Tag</label>
                    </th>
                </tr>
                <!--- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --->
                <tr>
                    <th>
                        Category:
                    </th>
                    <th>
                        <input type="checkbox" name="catCroRlt" id="catCroChk" onclick="checkC()" <?php echo isset($_POST["catCroRlt"]) ? "checked" : ""; ?>>
                        <label for="catCroChk"><span></span>Crochet</label>
                    </th>
                    <th>
                        <input type="checkbox" name="catCSRlt" id="catCStitchChk" onclick="checkCStitch()" <?php echo isset($_POST["catCSRlt"]) ? "checked" : ""; ?>>
                        <label for="catCStitchChk"><span></span>Cross Stitch</label>
                    </th>
                    <th>
                        <input type="checkbox" name="catSewRlt" id="catSewChk" onclick="checkSew()"  <?php echo isset($_POST["catSewRlt"]) ? "checked" : ""; ?>>
                        <label for="catSewChk"><span></span>Sewing</label>
                    </th>
                    <th>
                        <input type="checkbox" name="catKnitRlt" id="catKnitChk" onclick="checkKnit()"  <?php echo isset($_POST["catKnitRlt"]) ? "checked" : ""; ?>>
                        <label for="catKnitChk"><span></span>Knitting</label>
                    </th>
                </tr>
                <!--- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --->
                <tr>
                    <th>
                        Difficulty:
                    </th>
                    <th>
                        <input type="checkbox" name="difEasyRlt" id="difEasyChk" onclick="checkDifE()" <?php echo isset($_POST["difEasyRlt"]) ? "checked" : ""; ?>>
                        <label for="difEasyChk"><span></span>Easy</label>
                    </th>
                    <th>
                        <input type="checkbox" name="difInterRlt" id="difInterChk" onclick="checkDifI()" <?php echo isset($_POST["difInterRlt"]) ? "checked" : ""; ?>>
                        <label for="difInterChk"><span></span>Intermediate</label>
                    </th>
                    <th>
                        <input type="checkbox" name="difDifRlt" id="difDifChk" onclick="checkDifD()"  <?php echo isset($_POST["difDifRlt"]) ? "checked" : ""; ?>>
                        <label for="difDifChk"><span></span>Difficult</label>
                    </th>
                </tr>
            </table>
        </div>

        <div class="post_right">
            <input type="submit" name="search" id="search" value="Search" onclick="showCheck()">
        </div>
    </div>
</form>


<?php
    echo "<hr>";
    if($searchTxt=="") {
        // echo $rltTxt;
        if(!$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {
            if(!$diffTxt && $catTxt) {
                echo "<p>result for 1 <strong>".$rltTxt." </strong></p>";
            }
            if($diffTxt != "") {
                echo "<p>result for 2 <strong>".$rltTxt." </strong></p>";
                // echo $diffTxt;
            }
        }

        // if(($allRlt || $userRlt || $titleRlt || $tagRlt) ||
        //     ($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt)) {
        //     echo "<p>result for 3 <strong>".$rltTxt." </strong></p>";
        // }
    }

    // if($allRlt || $userRlt || $titleRlt || $tagRlt)
    // if entry box is empty and category is checked
    if(($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt) && $searchTxt==""){
        // echo "<p>result for <strong>".$rltTxt." </strong></p>";
    }
    if((($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt) && $searchTxt!="") && ($allRlt || $userRlt || $titleRlt || $tagRlt)) {
        if ($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt){
            echo '<p>result for <strong> '.$rltTxt.' :</strong> <span class="txtInput"> "'.str_replace("%", " ", $searchTxt).'" </span></p>';
        }
    }

    $result = mysqli_query($connection, $searchQuery);
    if (mysqli_num_rows($result) == 0){
        echo "<div class='project_container'>";
        echo "No result found.";
    }
    else {

        echo "<div class='project_container'>";
        while($row = mysqli_fetch_row($result)){ // add rows to the table
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

    echo "</div>";
    echo "</div>";
?>



<script>
    $(document).ready(function() {
        $('#search').click(function() {
            var txt = $('#searchInput').val();
            console.log(txt);

            if(txt != ""){
                $('#searchFilter').css({
                    'display' : 'block'
                });
            }

            $('#searchFilter').css({
                'display' : 'grid'
            });
        });

    });
</script>
