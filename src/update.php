<?php 
  session_start();
  require("dbconnect.php");
  include("authenticate_session.php");
  $issueEdit;
  $editQuery;
  $Update;
  $notesEdit;
  $assigneeEdit;
  
  $ticket_number = $_SESSION["ticket_number"];
  
    if(isset($_POST["editIssue"]) && $_POST["editIssue"] != ""){
      $issueEdit = filter_var($_POST["editIssue"], 513);
      $editQuery = "update Tickets set issue = '$issueEdit' where ticket_number = $ticket_number;";
      $Update = mysqli_query($CSDB, $editQuery);
    }
  
    if(isset($_POST["editNotes"]) && $_POST["editNotes"] != ""){
      $notesEdit = filter_var(date("Y-m-d H:i:s") . " " . $_POST["editNotes"] . "~|~", 513);
      $editQuery = "update Tickets set comments = CONCAT(comments, '$notesEdit') where ticket_number = $ticket_number;";
      $Update = mysqli_query($CSDB, $editQuery);
    }
  
    if($_SESSION["user_type"] == "Administrator" && isset($_POST["editAssignee"]) && $_POST["editAssignee"] != ""){
       $assigneeEdit = filter_var($_POST["editAssignee"], 513);
       $editQuery = "update Tickets set username = '$assigneeEdit' where ticket_number = $ticket_number;";
       $Update = mysqli_query($CSDB, $editQuery);
    }
    
    if(isset($_POST["editCustName"]) && $_POST["editCustName"] != ""){
      $custEdit = filter_var($_POST["editCustName"], 513);
      $editQuery = "update Tickets set customer_name = '$custEdit' where ticket_number = $ticket_number;";
      $Update = mysqli_query($CSDB, $editQuery);
    }
    
    if(isset($_POST["editCustEmail"]) && $_POST["editCustEmail"] != ""){
      $custEdit = filter_var($_POST["editCustEmail"], 520);
      $editQuery = "update Tickets set customer_email = '$custEdit' where ticket_number = $ticket_number;";
      $Update = mysqli_query($CSDB, $editQuery);
    }
    
    if(isset($_POST["editBrand"]) && $_POST["editBrand"] != ""){
      $brandEdit = filter_var($_POST["editBrand"], 513);
      $editQuery = "update Tickets set device_brand = '$brandEdit' where ticket_number = $ticket_number;";
      $Update = mysqli_query($CSDB, $editQuery);
    }
    
    if(isset($_POST["editSerial"]) && $_POST["editSerial"] != ""){
      $brandEdit = filter_var($_POST["editSerial"], 513);
      $editQuery = "update Tickets set device_serialNumber = '$brandEdit' where ticket_number = $ticket_number;";
      $Update = mysqli_query($CSDB, $editQuery);
    }
  
    $priorityEdit = $_POST["editUrgency"];
    $editQuery = "update Tickets set urgency = '$priorityEdit' where ticket_number = $ticket_number;";
    $Update = mysqli_query($CSDB, $editQuery);

  if(isset($_POST["email_customer"]) && ($_POST["email_customer"] == 'Yes')){
	$update_query = "SELECT * FROM Tickets WHERE ticket_number='$ticket_number'";
	$update_sql = mysqli_query($CSDB, $update_query);
	$update_row = mysqli_fetch_assoc($update_sql);
	$_SESSION['edit_assignee'] 	= $update_row['username'];
	$_SESSION['edit_notes'] 	= $update_row['comments'];
	$_SESSION['edit_issue'] 	= $update_row['issue'];
	$_SESSION['message_type']	= "ticket_updated";
	mysqli_close($CSDB);
	header("Location: ./email.php");
	exit;
  } else {
    mysqli_close($CSDB);
    header("Location: ./home.php");
    exit;
  }


?>
  
