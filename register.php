<?php
require_once('initialize.php');

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "sew_sunny";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


$errors = [];
$username = '';
$password = '';

if(is_post_request()) {
 $name = $_POST['name'] ?? '';

  $username = $_POST['username'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $confirmpassword = $_POST['confirmPassword'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($name)) {
    $errors[] = "name cannot be blank.";
  }

  if(is_blank($email)) {
    $errors[] = "Email cannot be blank.";
  }

  if(is_blank($password) || is_blank($confirmpassword)) {
    $errors[] = "Password cannot be blank.";
  }

  $addUser = "INSERT INTO members (name, username, email, password, avgRating)
VALUES ('".$name."', '".$username."', '".$email."', '".password_hash($password, PASSWORD_BCRYPT)."', 0)";

mysqli_query($connection, $addUser);
echo "SUCCESSFULLY REGISTERED";


 $admin = find_admin_by_username($username);
 log_in_admin($admin);

 // if(isset($_SESSION['username']) && isset($_SESSION['callback_url'])){
 //  header("location: http://". $_SERVER['SERVER_NAME'] . $_SESSION['callback_url']);
 //  exit();
 //  echo $_SESSION['callback_url'];
 // }else{
 //  header("location:  http://". $_SERVER['SERVER_NAME'] ."/hshakeri/a4/hshakeri/a4/showmodels.php");
 //  exit();
 //}

}

?>

<?php $page_title = 'Log in'; ?>
<?php include('header.php'); ?>

<div id="content">
  <h1>Register:</h1>

  <?php echo display_errors($errors); ?>

  <form action="register.php" method="post">
    Name:<br />
    <input type="text" name="name" value="" /><br />
     User Name:<br />
    <input type="text" name="username" value="" /><br />
     Email:<br />
    <input type="text" name="email" value="" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    Confirm password:<br />
    <input type="password" name="confirmPassword" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>
</div>

