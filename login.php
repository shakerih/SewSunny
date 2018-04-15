<?php
    require_once('initialize.php');
    //ensure that login uses HTTPS
    if($_SERVER["HTTPS"] != "on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }

    if(is_logged_in()){ //this logs the user out
        session_destroy();
    }

    $errors = [];
    $username = '';
    $password = '';

    if(is_post_request()) {

        $username = htmlspecialchars($_POST['username']) ?? '';
        $password = htmlspecialchars($_POST['password']) ?? '';

        // Validations
        if(is_blank($username)) {
            $errors[] = "Username cannot be blank.";
        }
        if(is_blank($password)) {
            $errors[] = "Password cannot be blank.";
        }

        // if there were no errors, try to login
        if(empty($errors)) {
            // Using one variable ensures that msg is the same
            $login_failure_msg = "Log in was unsuccessful.";

            $admin = find_admin_by_username($username);
            if($admin) {

                if(password_verify($password, $admin['password'])) {
                    // password matches
                    log_in_admin($admin);
                    header("showprojects.php");
                } else {
                    // username found, but password does not match
                    $errors[] = $login_failure_msg;
                }

            } else {
                // no username found
                $errors[] = $login_failure_msg;
            }

        }

    }

?>

<?php $page_title = 'LOG IN'; ?>
<?php include('header.php'); ?>
<!-- Check if visitors is logged in or not -->
<!-- if yes, redirect page to landing page after login -->
<?php
    if(is_logged_in()){
        header("Location: index.php");
        die();
    }
?>

<div id="content" class="center_screen">
    <div class="form_container">
        <h2>WELCOME</h2>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo htmlspecialchars("login.php");?>" method="post">
            <p>Username:</p>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username" autofocus/><br />
            <p>Password:</p>
            <input type="password" name="password" value="" placeholder="Password"/><br />
            <input type="submit" name="submit" value="LOGIN"  /><br/>
        </form>
        <a href="register.php">Don't have an account yet? <strong>Sign up here.</strong></a> 
    </div>
</div>
