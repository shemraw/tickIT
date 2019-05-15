<?php
	session_start();
	include("authenticate_session.php");
	include("favicon.php");
	require('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Ticket | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/create.css">
	<script>
		window.onload = function(){
			document.getElementById("home_button").onclick = function () {window.location.href='./home.php'};
		};

	</script>
</head>
<body>
	<div id="create_ticket_menu">
		<h1>Create Ticket</h1>
		<form action="createTicket.php" method="post">
			<div id="create_table">
				<table>
					<tr>
						<td><?php
							$ticket_number_sql = "SELECT * FROM Tickets ORDER BY ticket_number DESC LIMIT 1";
							$ticket_number_query = mysqli_query($CSDB, $ticket_number_sql);
							$ticket_number_row = mysqli_fetch_assoc($ticket_number_query);
							$ticket_num = $ticket_number_row['ticket_number'];
							$ticket_num += 1;
							echo("<input type='hidden' name='ticket_number' value='$ticket_num'>");
							?>
							<input type="text" name="customer_name" value=""> <br> *Customer Name
						</td>
						<td><input type="text" name="customer_email" value=""> <br> *Customer Email</td>
						<td><input type="text" name="issue" value=""> <br> *Issue</td>
					</tr>
					<tr>
						<td><input type="range" min="1" max="9" name="urgency" value="5" class="slider" id="priority_range"> <br>
							*Urgency: <span id="demo"></span></td>
						<td><br> Comments: <textarea name="comments" rows="10" cols="50" maxlength="150"></textarea></td>
						<?php $technician = $_SESSION['username']; $_SESSION['message_type'] = "created_ticket";?>
						<td><input type="hidden" name="username" value=<?php echo("$technician"); ?>></td>
            <?php
              if(isset($_SESSION["createMSG"])){
                echo $_SESSION["createMSG"];
                $_SESSION["createMSG"] == "";
              }?> 
					</tr>
					<tr>
						<td><input type="text" name="device_brand" value=""> <br> *Device Brand</td>
						<td><input type="text" name="device_serialNumber" value=""> <br> *Device SN</td>
					</tr>
				<script>
				    	var slider = document.getElementById("priority_range");
				    	var output = document.getElementById("demo");
				    	output.innerHTML = slider.value;
				    	slider.oninput = function() {
		        			output.innerHTML = this.value;
					}
				</script>
				</table>
			</div>
			<input type="submit">
		</form>
	</div>
	<div id="home_banner">
	</div>
	<div id="create_header">
		<button id="home_button">Home</button>
	</div>
</body>
</html>
