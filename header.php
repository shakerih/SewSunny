<?php require_once('initialize.php');?>

<div style="color: red">

<a href="index.php">Home</a>

<a href="showmodels.php">View Crafts</a>

<?php if(is_logged_in()){
	echo "<a href='postproject.php'>Post Craft</a>";
	echo "<a href='profile.php'>My Profile</a>";
	echo "<a href='login.php'>Logout</a>";
} else 
	echo "<a href='login.php'>Login/Sign Up</a>";

?>
</div>