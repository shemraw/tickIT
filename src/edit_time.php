<?php
	session_start();
	include("favicon.php");
	include("authenticate_session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Timeout | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/edit_account.css">
	<script>
		window.onload = function(){
			document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};
		};
	</script>
</head>
<body>
	<div id="edit_account_banner">
		<h2>Change Session Time-Out Period</h2>
		<button id="home_button">Home</button>
	</div>
	<div id="edit_account_main">
		<form action="dbcreate_account.php" method="post">
			<table id="info_table">
				<th>New Session Time-Out Period</th>
				<tr>
					<td><input type="range" id="time_range" name="time_out" min="10" max="120" value="30"><span id="demo"></span></td>
				</tr>
			</table>
			<input type="hidden" name="new_account" value="false">
			<input type="hidden" name="update_account_type" value=<?php echo("'" . $_POST['update_account_type'] . "'"); ?>>
			<input type="submit">
		</form>
	<script>
		var slider = document.getElementById("time_range");
		var output = document.getElementById("demo");
		output.innerHTML = slider.value;
		slider.oninput = function() {
			output.innerHTML = this.value;
		}
	</script>

	</div>
	<div id="edit_account_footer">
		<form id="logout_button" action="logout.php">
			<button id="logout_button">Logout</button>
		</form>
	</div>
</body>
</html>
