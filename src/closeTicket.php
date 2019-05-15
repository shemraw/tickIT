<?php
  session_start();
  include("authenticate_session.php");
  require("dbconnect.php");
  
    if($_POST["amount"] == "" || $_POST["charges"] == "" || $_POST["pay_method"] == "" || !is_numeric($_POST["amount"])){
      $_SESSION["transactionMSG"] = "Please fill out required fields (*)";
      header("Location: ./transaction.php");
      exit();
    }else{

	//For email
	$close_query = "select * from Tickets where ticket_number = ".$_SESSION["ticket_number"].";";
	$close_sql = mysqli_query($CSDB, $close_query);
	$close_row = mysqli_fetch_assoc($close_sql);
	$_SESSION['close_email'] 	= $close_row['customer_email'];
	$_SESSION['close_name'] 	= $close_row['customer_name'];
	$_SESSION['close_assignee'] 	= $close_row['username'];
	$_SESSION['close_notes'] 	= $_POST['additionalNotes'];
	$_SESSION['close_issue'] 	= $close_row['issue'];
	$_SESSION['message_type']	= "ticket_closed";

      $amount = filter_var($_POST["amount"], 520);
      $charges = filter_var($_POST["charges"], 513);
      $payMethod = filter_var($_POST["pay_method"], 513);
      $Notes = filter_var($_POST["additionalNotes"], 513);
      
      $ticket_info = "select * from Tickets where ticket_number = ".$_SESSION["ticket_number"].";";
      $retval = mysqli_query($CSDB, $ticket_info);
        
      $infoArray = mysqli_fetch_assoc($retval);
      $ticket_Number = $infoArray["ticket_number"];
      $customer_name = $infoArray["customer_name"];
      $customer_email = $infoArray["customer_email"];
      $issue = $infoArray["issue"];
      $urgency = $infoArray["urgency"];
      $comments = $infoArray["comments"];
      $username = $infoArray["username"];
      $device_brand = $infoArray["device_brand"];
      $device_serial = $infoArray["device_serialNumber"];
      $transactionID = $infoArray["transactionID"];
      
      $datePaid = date("Y-m-d");
      //echo $datePaid;
      
      
      $TransactionQuery = "update Transaction_History set amount='$amount', charges='$charges', payment_method='$payMethod', notes='$Notes', status = 'Paid', date_of_payment = '$datePaid' where transactionID = ".$infoArray['transactionID'].";";
      
      $retval= mysqli_query($CSDB, $TransactionQuery);
      
      $updateStatus = "update Tickets set date_finished = '$datePaid', status='Closed' where ticket_number = ".$infoArray["ticket_number"].";";
      
      $retval = mysqli_query($CSDB, $updateStatus);

	mysqli_close($CSDB);
	header("Location: ./email.php");
	exit;
  }
?>