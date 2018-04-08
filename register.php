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
        echo "<script>console.log('SUCCESSFULLY REGISTERED');</script>";


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

<?php $page_title = 'SIGN UP'; ?>
<?php include('header.php'); ?>
<!-- Check if visitors is loggin or not -->
<!-- if yes, redirect page to landing page after register -->
<?php
    if(is_logged_in()){
        header("Location: index.php");
        die();
    }
?>

<div id="content" class="center_screen">
    <div class="form_container">
        <h2>WELCOME TO SEWSUNNY</h2>

        <?php echo display_errors($errors); ?>

        <form action="register.php" method="post">
            <p>Name:</p>
            <input type="text" name="name" value="" placeholder="Name" autofocus/><br />
            <p>Username:</p>
            <input type="text" name="username" value="" placeholder="Username" /><br />
            <p>Email:</p>
            <input type="text" name="email" value="" placeholder="Email" /><br />
            <p>Password:</p>
            <input type="password" name="password" value="" placeholder="Password" /><br />
            <p>Confirm assword:</p>
            <input type="password" name="confirmPassword" value="" placeholder="Confirm Password" /><br />
            <input type="submit" name="submit" value="SIGN UP"  />
        </form>
        <a href="login.php">Already have an account? <strong>Login here.</strong></a>
    </div>
</div>
