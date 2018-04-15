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
<?php include('header.php');

if(isset($_SERVER["HTTPS"]))
{
    header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
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
            $searchTxt = htmlspecialchars($_POST['searchTxt']);
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

            // check difficulty set
            if(isset($_POST["difEasyRlt"])) {
                $difEasyRlt = $_POST["difEasyRlt"];
                $diffTxt = "1";
            }
            if(isset($_POST["difInterRlt"])) {
                $difInterRlt = $_POST["difInterRlt"];
                $diffTxt = "2";
            }
            if(isset($_POST["difDifRlt"])) {
                $difDifRlt = $_POST["difDifRlt"];
                $diffTxt = "3";
            }

            if($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt) {
                // if all checkbox and category is checked
                if($catTxt != "" && !$diffTxt) {
                    if($allRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR projects.tag LIKE '%".$searchTxt."%') ";
                        $rltTxt = "All projects : ".$catTxt."";
                    }
                    // if username and category is checked
                    if($userRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND members.username LIKE '%".$searchTxt."%' ";
                        $rltTxt = "Username : ".$catTxt."";
                    }
                    // if title and category is checked
                    if($titleRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.projectTitle LIKE '%".$searchTxt."%' ";
                        $rltTxt = "Project title : ".$catTxt."";
                    }
                    // if tag and category is checked
                    if($tagRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.tag LIKE '%".$searchTxt."%' ";
                        $rltTxt = "Project tag : ".$catTxt."";
                    }
                }

                // if text in input is empty && checkbox for all, username, title, tag not checked
                if($searchTxt=="" && !$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {
                    if ($catTxt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' ";
                        $rltTxt = $catTxt;
                    }
                }
            }

            if($difEasyRlt || $difInterRlt || $difDifRlt) {
                if($diffTxt != "" && !$catTxt) {
                    // if all checkbox and difficulty is checked
                    if($allRlt) {
                        $conditionA = "WHERE projects.levelDifficulty='".$diffTxt."' AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR projects.tag LIKE '%".$searchTxt."%') ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "All projects : ".$diffTxt."";
                    }
                    // if username and difficulty is checked
                    if($userRlt) {
                        $conditionA = "WHERE projects.levelDifficulty='".$diffTxt."' AND members.username LIKE '%".$searchTxt."%' ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "Username : ".$diffTxt."";
                    }
                    // if username and difficulty is checked
                    if($titleRlt) {
                        $conditionA = "WHERE projects.levelDifficulty='".$diffTxt."' AND projects.projectTitle LIKE '%".$searchTxt."%' ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "Project title : ".$diffTxt."";
                    }
                    // if tag and difficulty is checked
                    if($tagRlt) {
                        $conditionA = "WHERE projects.levelDifficulty='".$diffTxt."' AND projects.tag LIKE '%".$searchTxt."%' ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "Project tag : ".$diffTxt."";
                    }
                }

                // if text in input is empty && checkbox for all, username, title, tag not checked
                if($searchTxt=="" && !$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {
                    if($diffTxt && !$catTxt) {
                        $conditionA = "WHERE projects.levelDifficulty='".$diffTxt."' ";
                        if($diffTxt=="1") {
                            $rltTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $rltTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $rltTxt = "Difficult";
                        }
                    }
                }
            }


            if(($catCroRlt || $catCSRlt || $catSewRlt || $catKnitRlt) && ($difEasyRlt || $difInterRlt || $difDifRlt)) {
                if($diffTxt && $catTxt){
                    // if category and difficulty selected
                    if($searchTxt=="" && !$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.levelDifficulty='".$diffTxt."' ";
                        if($diffTxt=="1") {
                            $rltTxt = $catTxt. " : Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $rltTxt = $catTxt. " : Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $rltTxt = $catTxt. " : Difficult";
                        }
                    }

                    // if all checkbox and difficulty is checked
                    if($allRlt) {
                        $conditionA = "WHERE (category.categoryName='".$catTxt."' AND projects.levelDifficulty='".$diffTxt."') AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR projects.tag LIKE '%".$searchTxt."%') ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "All projects : ".$catTxt. " : ".$diffTxt."";
                    }
                    // if username and difficulty is checked
                    if($userRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.levelDifficulty='".$diffTxt."' AND members.username LIKE '%".$searchTxt."%' ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "Username : ".$catTxt. " : ".$diffTxt."";
                    }
                    // if username and difficulty is checked
                    if($titleRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.levelDifficulty='".$diffTxt."' AND projects.projectTitle LIKE '%".$searchTxt."%' ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "Project title : ".$catTxt. " : ".$diffTxt."";
                    }
                    // if tag and difficulty is checked
                    if($tagRlt) {
                        $conditionA = "WHERE category.categoryName='".$catTxt."' AND projects.levelDifficulty='".$diffTxt."' AND projects.tag LIKE '%".$searchTxt."%' ";
                        if($diffTxt=="1") {
                            $diffTxt = "Easy";
                        }
                        elseif ($diffTxt=="2") {
                            $diffTxt = "Intermediate";
                        }
                        elseif ($diffTxt=="3") {
                            $diffTxt = "Difficult";
                        }
                        $rltTxt = "Project tag : ".$catTxt. " : ".$diffTxt."";
                    }
                }
            }


            $searchQuery = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username, projects.userID, projects.levelDifficulty FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID ";
            $searchQuery.= $conditionA;
            $searchQuery.= "ORDER BY projects.projectID ";
            $result = mysqli_query($connection, $searchQuery);
            // echo $searchQuery;
        }

        // if($filter)
    }
    else if (!isset($_POST["search"]) || $searchTxt == "") {
        $searchQuery = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username, projects.userID, projects.levelDifficulty FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID ORDER BY projects.projectID";
        // $result = mysqli_query($connection, $query);
    }
    // echo "Search: ".$searchTxt;
    // echo $searchQuery;
?>


<form action="" method="post" id="searchForm">
    <div id="searchFilter" class="search_wrapper">


        <div class="post_left">
            <input type="text" name="searchTxt" id="searchInput" value="<?php echo str_replace("%", " ", htmlspecialchars($searchTxt)); ?>">

            <table class="filterTable">
                <tr>
                    <th>
                        Refine by:
                    </th>
                    <th>
                        <!-- <input type="checkbox" name="allRlt" id="allChk" onclick="checkA()"  <?php //echo isset($_POST["allRlt"]) ? "checked" : ""; ?>> All -->
                        <input type="checkbox" name="allRlt"  id="allChk" onclick="checkA()"  <?php echo isset($_POST["allRlt"]) ? "checked" : ""; ?>>
                        <label for="allChk"><span></span>All</label>
                    </th>
                    <th>
                        <input type="checkbox" name="userRlt"  id="userChk" onclick="checkU()"  <?php echo isset($_POST["userRlt"]) ? "checked" : ""; ?>>
                        <label for="userChk"><span></span>Username</label>
                    </th>
                    <th>
                        <input type="checkbox" name="titleRlt" id="titleChk" onclick="checkT()"  <?php echo isset($_POST["titleRlt"]) ? "checked" : ""; ?>>
                        <label for="titleChk"><span></span>Project Title</label>
                    </th>
                    <th>
                        <input type="checkbox" name="tagRlt" id="tagChk" onclick="checkTag()"  <?php echo isset($_POST["tagRlt"]) ? "checked" : ""; ?>>
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
        if($allRlt || $userRlt || $titleRlt || $tagRlt) {
            echo "<p>result for <strong>".$rltTxt." </strong></p>";
        }
        // echo $rltTxt;
        if(!$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {
            // echo "catTxt: " . $catTxt . " diffTxt: " . $diffTxt;
            // echo "rltTxt: " . $rltTxt;
            if(!$diffTxt && $catTxt) {
                echo "<p>result for <strong>".$rltTxt." </strong></p>";
            }
            if($diffTxt != "") {
                echo "<p>result for <strong>".$rltTxt." </strong></p>";
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
        $numprojects = mysqli_num_rows($result);
        $counter = 0;
        while($row = mysqli_fetch_row($result)){ // add rows to the table
            echo "<div class='project_item' id='proj".$counter."'>";
            echo "<div class='project'>";
            // echo "<div class='img_overlay'></div>";
            echo "<a href='projectdetails.php?projectCode=". $row[0]."'>" . "<div class='overlay'></div>" . "<img src='". $row[4] . "'>" . "</a>";
            // echo "<img src='". $row[4] . "'><br>";
            echo "<a href='projectdetails.php?projectCode=". $row[0]."'>" . $row[1] ."</a> </br>";
            echo "<span class='project_category'> ".$row[5]. "</span> <span class='pinfo'> by </span>";
            echo "<a class='project_author' href='profile.php?profileCode=". $row[6]."'>".$row[6] . "</a></br>";
            echo "</div>";
            echo "</div>";
            $counter++;

        }
    }

    echo "</div>";
    echo "</div>";

    $numpages = ceil($numprojects /10);


?>
<div class="pagination">
  <?php for($i=1; $i<=$numpages; $i++){
  echo '<button class="pagenum" id="'.$i.'">'.$i .'</button>';
} ?>
</div>


<script>

function page(event){
  console.log(event.target.id);
  $(".project_item").hide();
  for(var i = (event.target.id*10)-10; i < event.target.id*10; i++){
    $("#proj"+i).show();
  }
};
    $(document).ready(function() {

      $(".pagenum").click(page);
      $(".project_item").hide();
      for(var i = 0; i < 10; i++){
        $("#proj"+i).show();
      }

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

        // $('input[type=checkbox]').click(function() {
        //     $("#searchForm").submit();
        // });
        $('#catCroChk').click(function() {
            $("#searchForm").submit();
            // alert("hi");
            // var crotch = {
            //     "text" : $('#catCroChk').val(),
            // };
            // console.log(crotch);
            // $.ajax({
            //     type: "POST",
            //     url: "search.php",
            //     data: crotch,
            //     dataType : "html"
            // })
            // .done(function(data) {
            //     console.log(data);
            //     location.reload();
            // });

        });

        $('#catCStitchChk').click(function() {
            $("#searchForm").submit();
        });

        $('#catSewChk').click(function() {
            $("#searchForm").submit();
        });

        $('#catKnitChk').click(function() {
            $("#searchForm").submit();
        });


        $('#difEasyChk').click(function() {
            $("#searchForm").submit();
        });

        $('#difInterChk').click(function() {
            $("#searchForm").submit();
        });

        $('#difDifChk').click(function() {
            $("#searchForm").submit();
        });
    });
</script>
