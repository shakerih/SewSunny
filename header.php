<?php require_once('initialize.php');?>
<head>
	<link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div class="header">
	<div class="nav_container nav_logo">
		<h1><a href="index.php">SewSunny</a></h1>
	</div>
	<div class="nav_container nav_left">
		<a href="index.php">HOME</a>

		<a href="showmodels.php">VIEW CRAFTS</a>

		<?php if(is_logged_in()){
			echo "<a href='postproject.php'>POST CRAFT</a>";
		}

		?>
	</div>
	<div class="nav_container nav_right">
		<?php if(is_logged_in()){
			echo "<a href='profile.php?profileCode=".$_SESSION['username']."'> <img src='image/user.png'> &nbsp;".$_SESSION['username']."&nbsp; PROFILE</a>";
			echo "<a href='login.php'>LOG OUT</a>";
		} else
		echo "<a href='login.php'>LOGIN / SIGN UP</a>";

		?>
	</div>

</div>
