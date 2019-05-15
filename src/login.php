<?php
	session_start();
	include("favicon.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/login.css">
</head>
<body>
	<div id="login_banner">
	</div>
	<div id="login_input">
		<form action="login_2.php" method="post">
			Username<input type="text" name="username" value="" id="username"> <br>
			<!-- Password<input type="password" name="password" value="" id="password"> <br> -->
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>

