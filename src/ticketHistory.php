<?php
	session_start();
	include("favicon.php");
	include("authenticate_session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket History | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/edit.css">
	<script>
		window.onload = function(){
		      document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};
		}
	</script>
</head>
<body>
	<div id="home_banner">
	</div>
 <div id="settings_sidebar">
		<button id="home_button">Home</button>
	</div>
	<div id="edit_main">

		<h1>Description of Ticket</h1>

		<div id="ticket_info">
    <?php
      require("dbconnect.php");
      $ticket_number = $_POST["ticketNum"];
      $infoQuery = "select * from Tickets where ticket_number='$ticket_number';";
      $ticketInfo = mysqli_query($CSDB, $infoQuery);
      $infoArray = mysqli_fetch_assoc($ticketInfo);
      echo $_POST["ticketNum"];
			echo "<b>| Ticket info |</b>";
      echo "<table id = 'ticket info table' width='800'>";
        echo "<tr>";
          echo "<th>Ticket Number</th>";
          echo "<th>Date Closed</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$infoArray["ticket_number"]."</td>";
          echo "<td>".$infoArray["date_finished"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Customer Name</th>";
          echo "<th>Customer Email</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$infoArray["customer_name"]."</td>";
          echo "<td>".$infoArray["customer_email"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Issue</th>";
          echo "<th>Urgency</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$infoArray["issue"]."</td>";
          echo "<td>".$infoArray["urgency"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Status</th>";
          echo "<th>Device Brand</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$infoArray["status"]."</td>";
          echo "<td>".$infoArray["device_brand"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Device Serial #</th>";
          echo "<th>Assignee</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$infoArray["device_serialNumber"]."</td>";
          echo "<td>".$infoArray["username"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Notes</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$infoArray["comments"]."</td>";
        echo "</tr>";
      echo "</table>";
    ?>
		</div>
   
    <br><br>
    
		<div id='ticket_info'>
    <?php
      $transactionInfo = "Select * from Transaction_History where transactionID=".$infoArray["transactionID"].";";
      $transaction = mysqli_query($CSDB, $transactionInfo);
      $transactionArray = mysqli_fetch_assoc($transaction);
			echo "<b>| Transaction Information |</b>";
      echo "<table id = 'ticket info table' width='800'>";
        echo "<tr>";
          echo "<th>Transaction ID</th>";
          echo "<th>Amount</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$transactionArray["transactionID"]."</td>";
          echo "<td>$".$transactionArray["amount"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Charges</th>";
          echo "<th>Date of Payment</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$transactionArray["charges"]."</td>";
          echo "<td>".$transactionArray["date_of_payment"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Payment Method</th>";
          echo "<th>Status</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$transactionArray["payment_method"]."</td>";
          echo "<td>".$transactionArray["status"]."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<th>Notes</th>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>".$transactionArray["notes"]."</td>";
        echo "</tr>";
      echo "</table>";
      mysqli_close($CSDB);
    ?>
		</div>
	</div>
</body>
</html>
