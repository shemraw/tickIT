<?php
require("dbconnect.php");
/*
$techName = $_SESSION["username"];
$queueQuery = "select ticket_number, issue, date_created from Tickets where username='$techName';";
$Array = mysqli_query($CSDB, $queueQuery);
if($Array){
  echo 'Ticket query successful';
}else{
  echo 'Ticket query failed';
}
   */
   
  echo password_hash('password1', PASSWORD_DEFAULT);       
?>