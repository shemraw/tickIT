<?php
//	include("authenticate_session.php");
$servername = "localhost";  // if you run on local server the name is "localhost:3306". If you run on cs server, use only "localhost"
$username = "root";
$password = "tickitpassword_1";
$dbname = "tickIT_DB";
$CSDB;

$CSDB = @new mysqli($servername, $username, $password, $dbname);
/*
try {
	$AzureDB = new PDO("mysql:server=$servername; dbname=$dbname", $username, $password);
	$AzureDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}
*/
//Test to see if connection was successful	

 if(!$CSDB){
    die('Connection to CS DB Failed') . mysqli_error($CSDB);
  }
/*
//Localhost database parameters
 $servername2 = "localhost/phpmyadmin";
 $username2 = "root";
 $password2 = "root";
 $dbname2 = "tickIT_db";
 
 $LocalDB = @new mysqli($servername2, $username2, $password2, $dbname2);
 
 //test to see if connection was successful
 if(!$LocalDB){
	 die('Connection to local DB failed' . mysqli_error($LocalDB));
 }
 
 //initialize buffer for Azure connection failure
 */
 $SqlBuffer = array();
 $SqlBufferIndex = 0;
?>
