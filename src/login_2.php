<?php
	session_start();
	include("favicon.php");
	require("dbconnect.php");
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
		<?php
			$login_username = $_POST['username'];
			$time_query = mysqli_query($CSDB, "SELECT last_login, failed_logins FROM Users WHERE username='$login_username'");
			$row = mysqli_fetch_assoc($time_query);
			echo("<span>" . "$login_username" . "</span>" . "<br>");
			echo("Your last successful login was at: " . $row["last_login"] . "<br>");
			echo("Failed logins since last login: " . $row["failed_logins"]);
		?>
		<form action="authenticate.php" method="post">
			<!-- Username<input type="text" name="username" value="" id="username"> <br> -->
			<?php
				echo("<input type='hidden' name='username' value='$login_username'>");
			?>
			Password<input type="password" name="password" value="" id="password"> <br>
			<input type="submit" value="Login">
		</form>
		<form action="login.php"><input type="submit" value="Back"></form>
	</div>
</body>
</html>

