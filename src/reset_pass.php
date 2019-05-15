<?php
	session_start();
	include("authenticate_session.php");
	require('dbconnect.php');

	$username = filter_var($_POST['username_to_reset'], 513);

	$new_pass = password_hash("tickit_tech", PASSWORD_DEFAULT);

	$sql = "UPDATE Users SET password='$new_pass' WHERE username='$username'";
	$retval = mysqli_query($CSDB, $sql);

	if(! $retval ) {
		die('Could not enter data: ' . mysqli_error($CSDB));
	} else {
		$_SESSION['message_type'] = "password_reset";
		$_SESSION['reset_pass_username'] = $username;
		header("Location: ./email.php");
	}
	mysqli_close($CSDB);
?>
