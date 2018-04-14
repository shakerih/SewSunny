<?php

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function get_and_clear_session_message() {
  if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

function display_session_message() {
  $msg = get_and_clear_session_message();
  if(!is_blank($msg)) {
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>






<script>
    function checkA() {
        if(document.getElementById("allChk").checked){
            document.getElementById("allChk").checked = true;
        }else {
            document.getElementById("allChk").checked = false;
        }
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = false;
        document.getElementById("tagChk").checked = false;
    }
    function checkU() {
        if(document.getElementById("userChk").checked){
            document.getElementById("userChk").checked = true;
        }else {
            document.getElementById("userChk").checked = false;
        }
        document.getElementById("allChk").checked = false;
        document.getElementById("titleChk").checked = false;
        document.getElementById("tagChk").checked = false;
    }
    function checkT() {
        if(document.getElementById("titleChk").checked){
            document.getElementById("titleChk").checked = true;
        }else {
            document.getElementById("titleChk").checked = false;
        }
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = false;
        document.getElementById("tagChk").checked = false;
    }
    function checkTag() {
        if(document.getElementById("tagChk").checked){
            document.getElementById("tagChk").checked = true;
        }else {
            document.getElementById("tagChk").checked = false;
        }
        document.getElementById("allChk").checked = false;
        document.getElementById("userChk").checked = false;
        document.getElementById("titleChk").checked = false;
    }

    // category check ----------------------------------------------------------------
    function checkC() {
        if(document.getElementById("catCroChk").checked){
            document.getElementById("catCroChk").checked = true;
        }else {
            document.getElementById("catCroChk").checked = false;
        }
        document.getElementById("catCStitchChk").checked = false;
        document.getElementById("catSewChk").checked = false;
        document.getElementById("catKnitChk").checked = false;

        // document.getElementById('searchForm').method('post');
        // document.getElementById("searchForm").submit();
    }
    function checkCStitch() {
        if(document.getElementById("catCStitchChk").checked){
            document.getElementById("catCStitchChk").checked = true;
        }else {
            document.getElementById("catCStitchChk").checked = false;
        }
        document.getElementById("catCroChk").checked = false;
        document.getElementById("catSewChk").checked = false;
        document.getElementById("catKnitChk").checked = false;
    }
    function checkSew() {
        if(document.getElementById("catSewChk").checked){
            document.getElementById("catSewChk").checked = true;
        }else {
            document.getElementById("catSewChk").checked = false;
        }
        document.getElementById("catCroChk").checked = false;
        document.getElementById("catCStitchChk").checked = false;
        document.getElementById("catKnitChk").checked = false;
    }
    function checkKnit() {
        if(document.getElementById("catKnitChk").checked){
            document.getElementById("catKnitChk").checked = true;
        }else {
            document.getElementById("catKnitChk").checked = false;
        }
        document.getElementById("catCroChk").checked = false;
        document.getElementById("catCStitchChk").checked = false;
        document.getElementById("catSewChk").checked = false;
    }

    // difficulty checks -----------------------------------------------------------
    function checkDifE() {
        if(document.getElementById("difEasyChk").checked){
            document.getElementById("difEasyChk").checked = true;
        }else {
            document.getElementById("difEasyChk").checked = false;
        }
        document.getElementById("difInterChk").checked = false;
        document.getElementById("difDifChk").checked = false;
    }
    function checkDifI() {
        if(document.getElementById("difInterChk").checked){
            document.getElementById("difInterChk").checked = true;
        }else {
            document.getElementById("difInterChk").checked = false;
        }
        document.getElementById("difEasyChk").checked = false;
        document.getElementById("difDifChk").checked = false;
    }
    function checkDifD() {
        if(document.getElementById("difDifChk").checked){
            document.getElementById("difDifChk").checked = true;
        }else {
            document.getElementById("difDifChk").checked = false;
        }
        document.getElementById("difEasyChk").checked = false;
        document.getElementById("difInterChk").checked = false;
    }
</script>
