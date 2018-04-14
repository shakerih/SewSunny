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
    $allRlt = $userRlt = $titleRlt = $tagRlt = $catCroRlt = "";
    $rltTxt = "";
?>

<?php
    if(is_post_request()) {
        if(isset($_POST["searchTxt"])) {
            $searchTxt = $_POST['searchTxt'];
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
            if(isset($_POST["catCroRlt"])) {
                $catCroRlt = $_POST["catCroRlt"];
                // $conditionA = "WHERE category.categoryName='Crochet' AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%') ";
                // if all checkbox and category is checked
                if($allRlt) {
                    $conditionA = "WHERE category.categoryName='Crochet' AND (projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR projects.tag LIKE '%".$searchTxt."%') ";
                    $rltTxt = "All projects : Crochet";
                }
                // if username and category is checked
                if($userRlt) {
                    $conditionA = "WHERE category.categoryName='Crochet' AND members.username LIKE '%".$searchTxt."%' ";
                    $rltTxt = "Username : Crochet";
                }
                // if username and category is checked
                if($titleRlt) {
                    $conditionA = "WHERE category.categoryName='Crochet' AND projects.projectTitle LIKE '%".$searchTxt."%' ";
                    $rltTxt = "Project title : Crochet";
                }

                // if text in input is empty && checkbox for all, username, title, tag not checked
                if($searchTxt=="" && !$allRlt && !$userRlt && !$titleRlt && !$tagRlt) {$conditionA = "WHERE category.categoryName='Crochet' ";}
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
            <input type="text" name="searchTxt" id="searchInput" value="<?php echo $searchTxt; ?>">

            <table class="filterTable">
                <tr>
                    <th>
                        <!-- <input type="checkbox" name="allRlt" id="allChk" onclick="checkA()"  <?php //echo isset($_POST["allRlt"]) ? "checked" : ""; ?>> All -->
                        <input type="checkbox" name="allRlt"  id="allChk" onclick="checkA()"  <?php echo isset($_POST["allRlt"]) ? "checked" : ""; ?>> All
                    </th>
                    <th>
                        <input type="checkbox" name="userRlt"  id="userChk" onclick="checkU()"  <?php echo isset($_POST["userRlt"]) ? "checked" : ""; ?>> Username
                    </th>
                    <th>
                        <input type="checkbox" name="titleRlt" id="titleChk" onclick="checkT()"  <?php echo isset($_POST["titleRlt"]) ? "checked" : ""; ?>> Project Title
                    </th>
                    <th>
                        <input type="checkbox" name="tagRlt" id="tagChk" onclick="checkTag()"  <?php echo isset($_POST["tagRlt"]) ? "checked" : ""; ?>> Project Tag
                    </th>
                </tr>
                <tr>
                    <th>
                        Category:
                    </th>
                    <th>
                        <input type="checkbox" name="catCroRlt" id="catChk" onclick="checkC()"  <?php echo isset($_POST["catCroRlt"]) ? "checked" : ""; ?>> Crochet
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
    if($allRlt || $userRlt || $titleRlt || $tagRlt)
    // if entry box is empty and category is checked
    if($catCroRlt && $searchTxt==""){
        echo "<p>result for <strong>".$rltTxt." </strong></p>";
    }
    if(($catCroRlt && $searchTxt!="") || $allRlt || $userRlt || $titleRlt || $tagRlt) {
        echo '<p>result for <strong> '.$rltTxt.' :</strong> <span class="txtInput"> "'.$searchTxt.'" </span></p>';
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
    // $(document).ready(function() {
    //     $('form input:checkbox').click(function() {
    //         $('input[name="userRlt"]').attr('checked', 'false');
    //         $('input[name="titleRlt"]').attr('checked', 'false');
    //         $('input[name="catCroRlt"]').attr('checked', 'false');
    //     });
    // });
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

    // function showCheck() {
    //     document.getElementById("searchFilter").style.display="none";
    // }

    function checkA() {
        document.getElementById("allChk").checked = true;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = false;
        // document.getElementById("catChk").checked = false;
        document.getElementById("tagChk").checked = false;
    }
    function checkU() {
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = true;
        document.getElementById("titleChk").checked = false;
        // document.getElementById("catChk").checked = false;
        document.getElementById("tagChk").checked = false;
    }
    function checkT() {
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = true;
        // document.getElementById("catChk").checked = false;
        document.getElementById("tagChk").checked = false;
    }
    // function checkC() {
    //     document.getElementById("allChk").checked = false;
    //     document.getElementById("userChk").checked = false;
    //     document.getElementById("titleChk").checked = false;
    //     document.getElementById("catChk").checked = true;
    //     document.getElementById("tagChk").checked = false;
    // }
    function checkTag() {
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = false;
        // document.getElementById("catChk").checked = false;
        document.getElementById("tagChk").checked = true;
    }
</script>
