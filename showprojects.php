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
    echo "<h2>Recent Projects</h2>";
?>


<?php
    $searchTxt = "";
    $conditionA = $conditionU = $conditionT = $conditionC = "";
    $allRlt = $userRlt = $titleRlt = $catRlt = "";
?>

<?php
    if(isset($_POST["search"])) {
        if(isset($_POST["searchTxt"])) {
            $searchTxt = $_POST['searchTxt'];
            // echo "search result: ".$searchTxt;
            // $condition = "";
            if(isset($_POST["allRlt"])) {
                $allRlt = $_POST["allRlt"];
                $conditionA = "WHERE projects.projectTitle LIKE '%".$searchTxt."%' OR members.username LIKE '%".$searchTxt."%' OR category.categoryName LIKE '%".$searchTxt."%' ";
            }
            if(isset($_POST["userRlt"])) {
                $userRlt = $_POST["userRlt"];
                $conditionA = "WHERE members.username LIKE '%".$searchTxt."%' ";
            }
            if(isset($_POST["titleRlt"])) {
                $titleRlt = $_POST["titleRlt"];
                $conditionA = "WHERE projects.projectTitle LIKE '%".$searchTxt."%' ";
            }
            if(isset($_POST["catRlt"])) {
                $catRlt = $_POST["catRlt"];
                $conditionA = "WHERE category.categoryName LIKE '%".$searchTxt."%' ";
            }

            $searchQuery = "SELECT projects.projectID, projects.projectTitle, projects.description, projects.tag, projects.imgURL, category.categoryName, members.username, projects.userID FROM projects INNER JOIN category ON projects.categoryID = category.categoryID INNER JOIN members ON projects.userID=members.userID ";
            $searchQuery.= $conditionA;
            $searchQuery.= "ORDER BY projects.projectID ";
            $result = mysqli_query($connection, $searchQuery);
            // echo $searchQuery;
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
    <input type="text" name="searchTxt" id="searchInput" value="<?php echo $searchTxt; ?>">


    <div id="searchFilter">
        <input type="checkbox" name="allRlt" id="allChk" onclick="checkA()"  <?php echo isset($_POST["allRlt"]) ? "checked" : ""; ?>> All </br>
        <!-- <input type="radio" name="allRlt" value="Username"> Username </br>
        <input type="radio" name="allRlt" value="Project title"> Project Title  </br>
        <input type="radio" name="allRlt" value="Category"> Category -->
        <!-- allRlt  userRlt  titleRlt  catRlt -->
        <input type="checkbox" name="userRlt"  id="userChk" onclick="checkU()"  <?php echo isset($_POST["userRlt"]) ? "checked" : ""; ?>> Username </br>
        <input type="checkbox" name="titleRlt" id="titleChk" onclick="checkT()"  <?php echo isset($_POST["titleRlt"]) ? "checked" : ""; ?>> Project Title  </br>
        <input type="checkbox" name="catRlt" id="catChk" onclick="checkC()"  <?php echo isset($_POST["catRlt"]) ? "checked" : ""; ?>> Category
    </div>

    <input type="submit" name="search" id="search" value="Search" onclick="showCheck()">
</form>


<?php
    echo "<div class='project_container'>";
    $result = mysqli_query($connection, $searchQuery);
    if (mysqli_num_rows($result) == 0){
        echo "No result found.";
    }
    else {
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
    //         $('input[name="catRlt"]').attr('checked', 'false');
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
        });
    });

    // function showCheck() {
    //     document.getElementsByClassName("searchFilter").style.display="block";
    // }

    function checkA() {
        document.getElementById("allChk").checked = true;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = false;
        document.getElementById("catChk").checked = false;
    }
    function checkU() {
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = true;
        document.getElementById("titleChk").checked = false;
        document.getElementById("catChk").checked = false;
    }
    function checkT() {
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = true;
        document.getElementById("catChk").checked = false;
    }
    function checkC() {
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = false;
        document.getElementById("catChk").checked = true;
    }
</script>
