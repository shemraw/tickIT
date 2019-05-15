<?php
//checking if user was authenticated by checking if they have a usertype
if(empty($_SESSION["user_type"])){
	//echo("user_type is NOT set");
	header("Location: ./login.php"); exit;
}
if(!empty($_SESSION["user_type"])){
	$expireAfter = $_SESSION['time_out'];
	if(isset($_SESSION['last_action'])){
		$secondsInactive = time() - $_SESSION['last_action'];
		$expireAfterSeconds = $expireAfter * 60;
		if($secondsInactive >= $expireAfterSeconds){
			header("Location: ./logout.php");
		}
	}
	$_SESSION['last_action'] = time();
}
?>
