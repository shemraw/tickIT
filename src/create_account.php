<?php
	session_start();
	include("authenticate_session.php");
	include("favicon.php");
	//redirects to home if the user's type is not admin
	if($_SESSION["user_type"] != "Administrator"){
		header("Location: ./home.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Account | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/create_account.css">
	<script>
		window.onload = function(){
			document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};
		};
	</script>
</head>
<body>
	<div id="create_account_banner">
		<h2>Create an Account</h2>
		<button id="home_button">Home</button>
	</div>
	<div id="create_account_main">
		<form action="dbcreate_account.php" method="post">
			<table id="info_table">
				<tr>
					<td>Username<input type="text" name="username" value=""></td>
					<td>Password<input type="text" name="password" value=""></td>
					<td>Email<input type="text" name="email" value=""></td>
					<td>Phone<input type="text" name="phone_number" value=""></td>
				</tr>
			</table>
			<input type="hidden" name="new_account" value="true">
			<input type="submit">
		</form>
	</div>
	<div id="create_account_footer">
		<form id="logout_button" action="logout.php">
			<button id="logout_button">Logout</button>
		</form>
	</div>
</body>
</html>
