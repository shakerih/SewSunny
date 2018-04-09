<?php require_once('initialize.php');?>
<head>
	<link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<div class="header">
	<div class="nav_container nav_left">
		<h1><a href="index.php">SewSunny</a></h1>
	</div>
	<div class="nav_container nav_right">
		<a href="index.php">HOME</a>

		<a href="showmodels.php">VIEW CRAFTS</a>

		<?php if(is_logged_in()){
			echo "<a href='postproject.php'>POST CRAFT</a>";
			echo "<a href='profile.php'>MY PROFILE</a>";
			echo "<a href='login.php'>LOG OUT</a>";
		} else
		echo "<a href='login.php'>LOGIN / SIGN UP</a>";

		?>
	</div>

</div>
