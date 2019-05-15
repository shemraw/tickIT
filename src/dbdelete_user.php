<?php
	session_start();
	require('dbconnect.php');
	include("authenticate_session.php");
	//redirects to home if the user's type is not admin
	if($_SESSION["user_type"] != "Administrator"){
		header("Location: ./home.php");
		exit();
	}

	if($_POST['delete_user_bool'] == 'true'){
		if(! get_magic_quotes_gpc() ) {
			$username = addslashes ($_POST['username_to_del']);
		} else {
			$username = ($_POST['username_to_del']);
		}
		$sql = "DELETE FROM Users WHERE username='$username'";
		$retval = mysqli_query($CSDB, $sql);
		if(! $retval ) {
			die('Could not enter data: ' . mysqli_error($CSDB));
		} else {
			echo($_POST['username_to_del'] . "'s Account Has Been Deleted. Redirecting...");
			header("refresh: 2; url=./manage.php");
		}
	} else if($_POST['delete_user_bool'] == 'false'){
		header("Location: ./manage.php");
	}
	mysqli_close($CSDB);
?>
