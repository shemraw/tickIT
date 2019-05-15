<?php
	session_start();
	include("favicon.php");
	require('dbconnect.php');
	include("authenticate_session.php");
	//redirects to home if the user's type is not admin
	if($_SESSION["user_type"] != "Administrator"){
		header("Location: ./home.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo($_POST['username_to_del']); ?> | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/delete_user.css">
</head>
<body>
	<div id="delete_user_banner">
		<?php echo("<h2>Are you sure you would like to delete " . $_POST['username_to_del'] . "?</h2>"); ?>
	</div>
	<div id="delete_user_main">
		<?php
			echo(
			"<form action='dbdelete_user.php' method='post'>" . 
				"<input type='hidden' name='delete_user_bool' value='false'/>" . 
				"<input type='hidden' name='username_to_del' value='" . $_POST['username_to_del'] . "'/>" . 
				"<input type='submit' value='Do NOT Delete User'/>" . 
			"</form>");
			echo(
			"<form action='dbdelete_user.php' method='post'>" . 
				"<input type='hidden' name='delete_user_bool' value='true'/>" . 
				"<input type='hidden' name='username_to_del' value='" . $_POST['username_to_del'] . "'/>" . 
				"<input type='submit' value='Yes, Delete User'/>" . 
			"</form>");
		?>
	</div>
	<div id="delete_user_footer">
	</div>
</body>
</html>
