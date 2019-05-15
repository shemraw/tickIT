<?php
  session_start();
  require("dbconnect.php");
  include("favicon.php");
  include("authenticate_session.php");
  $_SESSION["editInfo"] = $_SESSION["ticket_number"];
?>

<!Doctype html>
<html>
<head>
  <title>Closing Information</title>
  <link rel="stylesheet" type="text/css" href="./static/css/edit.css">
  <script>

		window.onload = function(){
      document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};

			//document.getElementById("logout_button").onclick = function () {window.location.href='./logout.php'};

			document.getElementById("back_button").onclick = function () {window.location.href='./edit.php'};
		}
	</script>
</head>

<body>
  <div id="home_banner"></div>
  <div id="settings_sidebar">
    <button id="home_button">Home</button>
    <button id="back_button">Back</button>
  </div>
  <div id="edit_main">
  <div id="ticket_info">
    <h1>Transaction Information</h1>
    <form method="post" action="closeTicket.php">
      <table id="transaction_info" width ="800">
        <tr>
          <th>*Amount</th>
          <th>*Charges</th>
          <th>*Payment Method</th>
          <th>Additional Notes</th>
        </tr>
        <tr>
          <td><input type="text" name="amount"></td>
          <td><input type="text" name="charges"></td>
          <td><input type="text" name="pay_method"></td>
          <td><textarea rows='5' cols='20' name="additionalNotes"></textarea></td>
        </tr>
        <tr>
          <td><input type="submit" name="TransactionSubmit" value="Submit"></td>
        </tr>
      </table>
      <?php
        if(isset($_SESSION["transactionMSG"])){
          echo $_SESSION["transactionMSG"];
          $_SESSION["transactionMSG"] = "";
        }
      ?>
  </div>
  </div>
</body>
</html>
  
