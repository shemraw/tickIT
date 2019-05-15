<?php
session_start();
require("dbconnect.php");

$postUser = filter_var($_POST['username'], 515);
$postPass = filter_var($_POST['password'], 515);

$sessionSQL = "SELECT * FROM Users WHERE username = '$postUser';";
$retval = mysqli_query($CSDB, $sessionSQL);
$rowArray = mysqli_fetch_assoc($retval);

$account_name_SQL = "SELECT * FROM Users WHERE username = '$postUser';";
$account_name_retval = mysqli_query($CSDB, $account_name_SQL);
$account_name_row = mysqli_fetch_assoc($account_name_retval);

if(mysqli_num_rows($retval) > 0 && password_verify($postPass, $rowArray["password"])){	//if record of user exists in CSDB
	if($rowArray['role'] == 'Administrator'){
		$_SESSION['user_type'] = 'Administrator';
	}else if ($rowArray['role'] == 'Technician'){
		$_SESSION['user_type'] = 'Technician';
	}
	$_SESSION['username'] = $postUser;
	$_SESSION['password'] = $postPass;
	$_SESSION['time_out'] = $account_name_row['time_out'];
	//mark time into last_login in CSDB
	$date = date("Y-m-d H:i:s");	//time in UTC
	$date_query = mysqli_query($CSDB, "UPDATE Users SET last_login='$date', failed_logins=0 WHERE username='$postUser'");
	//echo($date);
	header("Location: ./home.php");
  //$_SESSION["wrong_password"] = "";
	exit;
} else if(mysqli_num_rows($retval) > 0 && !password_verify($postPass, $rowArray["password"])){	//if account name exists but password doesn't match it
	$failed_login_sql = "UPDATE Users SET failed_logins = failed_logins + 1 WHERE username='$postUser'";
	$failed_login_retval = mysqli_query($CSDB, $failed_login_sql);
	$failed_login_row = mysqli_fetch_assoc($failed_login_retval);
	$failed = $failed_login_row['failed_logins'];
	header("Location: ./login.php");
	exit;
} else if(mysqli_num_rows($retval) <= 0){
	header("Location: ./login.php");
  //$_SESSION["wrong_password"] = "Login Failed: Incorrect password";
	exit;
}
mysqli_close($CSDB);
?>
<!--
/*
if(isset($_POST["username"]) && isset($_POST["password"])){
     $_SESSION["username"] = filter_var($_POST["username"], 515);
     $_SESSION["password"] = filter_var($_POST["password"], 515);
     $sessionUser = filter_var($_POST["username"], 515);
     $sessionPass = filter_var($_POST["password"], 515);
     
     //echo phpinfo();
     
     //$hashPass = password_hash('$sessionPass', PASSWORD_BCRYPT);
     //echo $hashPass;
     //echo '<br>';
     //echo password_hash('$sessionPass', PASSWORD_BCRYPT);
     /*
     echo $hashPass;
     echo '<br>';
     //echo password_hash('password1', );  
     if(password_verify('$sessionPass', $hashPass)){
       echo "yes";
     }else{
       echo "NOOOOOOOO";
      }  
     
     $sessionID = (int)$sessionUser + time();
     $lastLogin = date('Y-m-d');
     $retval
 */
 
//checks to see if user is in the database
  
/*
}else{
  echo("You did not enter your credentials properly, redirecting to login...");
  header("refresh: 3; url= ./login.php");
  exit;
}
  mysqli_close($CSDB);
*/
-->
