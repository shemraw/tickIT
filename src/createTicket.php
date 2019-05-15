<?php
	session_start();
	include("authenticate_session.php");
	include("favicon.php");
	require('dbconnect.php');
 
  if($_POST["customer_name"] == "" || $_POST["customer_email"] == "" || $_POST["issue"] == "" || $_POST["device_brand"] == "" || $_POST["device_serialNumber"] == ""){
    header("Location: ./create.php");
    $_SESSION["createMSG"] = "Please fill out required fields (*)";
    exit;
  }

	if(! get_magic_quotes_gpc() ) {
		$ticket_number 		= addslashes ($_POST['ticket_number']);
		$customer_name 		= addslashes ($_POST['customer_name']);
		$customer_email 	= addslashes ($_POST['customer_email']);
		$issue 			= addslashes ($_POST['issue']);
		$urgency 		= addslashes ($_POST['urgency']);
		$comments 		= addslashes ($_POST['comments']);
		$username 		= addslashes ($_POST['username']);
		$device_brand 		= addslashes ($_POST['device_brand']);
		$device_serialNumber 	= addslashes ($_POST['device_serialNumber']);
	} else {
		$ticket_number 		= ($_POST['ticket_number']);
		$customer_name 		= filter_var($_POST['customer_name'], 513);
		$customer_email 	= filter_var($_POST['customer_email'], 517);
		$issue 			= filter_var($_POST['issue'], 513);
		$urgency 		= filter_var($_POST['urgency'], 513);
		$comments		= filter_var($_POST['comments'], 513);
		$username 		= filter_var($_POST['username'], 513);
		$device_brand 		= filter_var($_POST['device_brand'], 513);
		$device_serialNumber 	= filter_var($_POST['device_serialNumber'], 513);
	}
	$status 		= "In Progress";
	$date_created 		= date("Y-m-d H:i:s");	//time in UTC
	$transactionID = $ticket_number;
//	$urgency = 3;

	$transaction_sql = "INSERT INTO Transaction_History " . 
			"(transactionID,status) VALUES ('$transactionID', 'pending')";
	$transaction_retval = mysqli_query($CSDB, $transaction_sql);

	$ticket_sql = "INSERT INTO Tickets ". 
		"(ticket_number, customer_name, customer_email, issue, urgency, " .
			"comments, username, status, date_created, device_brand, " .
			"device_serialNumber, transactionID, date_finished) VALUES " .
		"('$ticket_number','$customer_name','$customer_email','$issue','$urgency'," .
			"'$comments','$username','$status','$date_created','$device_brand'," .
			"'$device_serialNumber', '$transactionID', null)";
	$ticket_retval = mysqli_query($CSDB, $ticket_sql);
	if(! $ticket_retval ) {
		die('Could not enter data: ' . mysqli_error($CSDB));
	} else {
		echo "Ticket Created! Redirecting to home...";
		$_SESSION['message_type'] = "ticket_created";
		$_SESSION['email'] = $customer_email;
		$_SESSION['customer_name'] = $customer_name;
		$_SESSION['subject'] = $issue;
		header("refresh: 2; url=./email.php");
	}
	mysqli_close($CSDB);
?>
