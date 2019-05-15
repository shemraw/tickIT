<?php
	session_start();
	include("favicon.php");
	include("authenticate_session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/edit_account.css">
	<script>
		window.onload = function(){
			document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};
		};
	</script>
</head>
<body>
	<div id="edit_account_banner">
		<h2>Change Password</h2>
		<button id="home_button">Home</button>
	</div>
	<div id="edit_account_main">
		<form action="dbcreate_account.php" method="post">
			<table id="info_table">
				<th>Old Password</th><th>Confirm Password</th><th>New Password</th>
				<tr>
					<td><input type="password" name="old_password" value=""></td>
					<td><input type="password" name="confirm_old_password" value=""></td>
					<td><input type="password" name="password" value=""></td>
				</tr>
			</table>
			<input type="hidden" name="new_account" value="false">
			<input type="hidden" name="update_account_type" value=<?php echo("'" . $_POST['update_account_type'] . "'"); ?>>
			<input type="submit">
		</form>
	</div>
	<div id="edit_account_footer">
		<form id="logout_button" action="logout.php">
			<button id="logout_button">Logout</button>
		</form>
	</div>
</body>
</html>
