<?php
	session_start();
	include("favicon.php");
	require('dbconnect.php');
	include("authenticate_session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Account | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/settings.css">
	<script>
		window.onload = function(){
			document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};
		};
	</script>
</head>
<body>
	<div id="settings_banner">
		<h2><?php echo($_SESSION['username']); ?> Account Settings</h2>
	</div>
	<div id="settings_sidebar">
		<button id="home_button">Home</button>
	</div>
	<div id="settings_main">
		<?php
			$username = $_SESSION['username'];
			$queueQuery = "SELECT * FROM Users WHERE username = '$username'";
			$Array = mysqli_query($CSDB, $queueQuery);
		?>
		<table>
			<th>User</th><th>Email</th><th>Phone</th><th>Department</th><th>Role</th><th>Locked Status</th><th>Session Period</th>
			<?php
				while($row = mysqli_fetch_assoc($Array)){
					echo("<tr><td>" . $username . " " . "</td><td>" . $row["email"] . " " 
					. "</td><td>" . $row["phone_number"] . " " . "</td><td>" . $row["department"] . " " 
					 . "</td><td>" . $row["role"] . " " . "</td><td>" . "Locked: " . $row["locked"] . " "
					. "</td><td>" . $row["time_out"] . " Minutes</td></tr>");
				}
			?>
		</table>
		<table>
			<th><u>Change Settings</u></th>
			<tr>
			<form action="edit_pass.php" method="post">
				<input type="hidden" name="update_account_type" value="password">
				<td><input type="submit" value="Password"></td>
			</form>
			<form action="edit_phone.php" method="post">
				<input type="hidden" name="update_account_type" value="phone">
				<td><input type="submit" value="Phone"></td>
			</form>
			<form action="edit_email.php" method="post">
				<input type="hidden" name="update_account_type" value="email">
				<td><input type="submit" value="Email"></td>
			</form>
			<form action="edit_time.php" method="post">
				<input type="hidden" name="update_account_type" value="time_out">
				<td><input type="submit" value="Session Time"></td>
			</form>
			</tr>
		</table>
	</div>
	<div id="home_footer">
		<form id="logout_button" action="logout.php">
			<input type="submit" name="logout" value="logout"/>
		</form>
	</div>
</body>
</html>
