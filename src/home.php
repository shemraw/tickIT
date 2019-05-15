<?php
	session_start();
	include("favicon.php");
	require("dbconnect.php");
	include("authenticate_session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home | tickIT</title>
	<link rel="stylesheet" type="text/css" href="./static/css/home.css">
	<script>
		window.onload = function(){
			document.getElementById("create_ticket_button").onclick = function () {window.location.href='./create.php';};
			//document.getElementById("manage_technician_button").onclick = function () {window.location.href='./manage.php';};
			document.getElementById("settings_button").onclick = function () {window.location.href='./settings.php';};
		}
		function goto_manage(){
			window.location.href='./manage.php';
		}
   
	</script>
</head>
<body>
	<div id="home_banner">
	</div>
	<div>
		<?php
			$username = $_SESSION['username'];
			echo($_SESSION["user_type"] . " " . $_SESSION["username"]);
		?>
	</div>
	<div id="home_sidebar">
		<button id="create_ticket_button">Create Ticket</button>
		<button id="settings_button">Account Settings</button>
		<?php
			if($_SESSION["user_type"] == "Administrator"){
				echo("<button onclick='goto_manage()' id='manage_technician_button'>Manage Technicians</button>");
			}
		?>
	</div>
	<div id="home_main">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<table id="attribute_table">
			<tr><td><input type="checkbox" name="archived_tickets" value="Archived Tickets"> Archived Tickets</td>
		      <td><input type="checkbox" name="date_created" value="Date Created">Date</td></tr>
      <?php
        if($_SESSION["user_type"] == "Technician"){
          echo "<tr><td><input type='checkbox' name='assignee' value='Assignee'>Assignee (Archived only. Fill bellow)<br></td></tr>";
        }else{
          echo "<tr><td><input type='checkbox' name='assignee' value='Assignee'>Assignee (Fill below)<br></td></tr>";
        }
      ?>

			<tr><td><input type="checkbox" name="range_search" value="Priority"> Priority <span id="demo"></span></td></tr>
			<tr><td><input type="range" min="1" max="9" value="5" class="slider" id="priority_range" name="priority"></td></tr>
			<tr><td><input type="text" name="ticket_table_search" value=""></td>
			<td><input type="submit" name="ticket_table_search_submit" value="Search"></td></tr>
		</table>
   </form>
   <!--/*
   <?php
     if($_SESSSION["user_type"] == "Technician"){
       echo '<h2>Tickets in your queue</h2>';
     }else if($_SESSION["user_type"] == "Administrator"){
       echo '<h2>Tickets in global queue</h2>';
     }
   ?>
   */-->
		<div id="ticket_table_div">
			<table id="ticket_table">
				<tr>
					<th>Ticket ID</th>
					<th>Description</th>
       <?php
         if(isset($_POST["archived_tickets"])){
           echo "<th>Date Closed</th>";
         }else{
          echo "<th>Date Created</th>";
         }
 				  echo "<th>Urgency</th>";
         if($_SESSION["user_type"] == "Administrator" || isset($_POST["archived_tickets"])){
           echo "<th>Assignee</th></tr>";
         }?>
		<?php
       $ticket_type;
       $search_date;
       $search_priority;
       $queueQuery;
       $searchValue = filter_var($_POST["ticket_table_search"], 513);
       /*If looking for archived tickets*/
       if(isset($_POST["archived_tickets"])){
       
         if(isset($_POST["date_created"])){
           $queueQuery = "Select ticket_number, issue, date_finished, urgency, username from Tickets where status = 'Closed' and date_finished = '$searchValue';";
         }else if(isset($_POST["assignee"])){
           $queueQuery = "Select ticket_number, issue, date_finished, urgency, username from Tickets where username = '$searchValue' and status = 'Closed';";
         }else if(isset($_POST["range_search"])){
           $queueQuery = "select ticket_number, issue, date_finished, urgency, username from Tickets where urgency = ".$_POST["priority"]." and status='Closed';";
         }else{
           $queueQuery = "Select ticket_number, issue, date_finished, urgency, username from Tickets where status = 'Closed';";
         }
        /*If not looking for archived tickets*/ 
       }else if(!isset($_POST["archived_tickets"])){
         /*searching tickets by date*/
         if(isset($_POST["date_created"])){
         
           if($_SESSION["user_type"] == "Technician"){
             $queueQuery = "Select ticket_number, issue, date_created, urgency from Tickets where username = ".$_SESSION["username"]." and date_created = '$searchValue';";
           }else{
             $queueQuery = "Select ticket_number, issue, date_created, urgency, username from Tickets where date_created = '$searchValue';";
           }
         /*searching tickets by priority*/  
         }else if(isset($_POST["range_search"])){
         
           if($_SESSION["user_type"] == "Technician"){
             $queueQuery = "Select ticket_number, issue, date_created, urgency from Tickets where username = '".$_SESSION["username"]."' and urgency = ".$_POST["priority"]." and status = 'In Progress';";
           }else{
             $queueQuery = "Select ticket_number, issue, date_created, urgency, username from Tickets where urgency = ".$_POST["priority"]." and status = 'In Progress';";
           }
         /*searching tickets by assignee Admin only*/  
         }else if(isset($_POST["assignee"]) && $_SESSION["user_type"] == "Administrator"){
           $queueQuery = "Select ticket_number, issue, date_created, urgency, username from Tickets where username='$searchValue' and status = 'In Progress';";
         /*Default ticket queue*/
         }else{
           if($_SESSION["user_type"] == "Technician"){
             $queueQuery = "Select ticket_number, issue, date_created, urgency from Tickets where username = '".$_SESSION["username"]."' and status = 'In Progress';";
           }else{
              $queueQuery = "Select ticket_number, issue, date_created, urgency, username from Tickets where status = 'In Progress';";
           }
         }
       }
       
       
			//pull info from DB and populate home's table
       	if($_SESSION["user_type"] == "Technician"){
     			$Array = mysqli_query($CSDB, $queueQuery);
				  while($row = mysqli_fetch_assoc($Array)){
              if(!isset($_POST["archived_tickets"])){
                      echo "<tr>";
               				echo "<td>" . $row["ticket_number"] . "</td><td>" . $row["issue"] . "</td><td>" . $row["date_created"] . "</td><td>" . $row["urgency"] . "</td>";
               				echo "<td><form method='post' action='edit.php'><input type='hidden' value=".$row["ticket_number"]." name='ticketNum'>";
                      echo "<input type='submit' id='ticketInfo' value='Edit'></form></td>";
               				echo "</tr>";
              }else{
                echo "<tr>";
                echo "<td>" .$row["ticket_number"]."</td><td>".$row["issue"]."</td><td>".$row["date_finished"]."</td><td>".$row["urgency"]."</td><td>".$row["username"]."</td>";
                echo "<td><form method='post' action='ticketHistory.php'><input type='hidden' value =".$row["ticket_number"]." name='ticketNum'>";
                echo "<input type='submit' id='ticketInfo' value='View'></form></td>";
                echo "</tr>";
 			        }
          }
               
    		}else if($_SESSION["user_type"] == "Administrator"){
             			
   			  $Array = mysqli_query($CSDB, $queueQuery);
			  	while($row = mysqli_fetch_assoc($Array)){
            if(!isset($_POST["archived_tickets"])){
               				echo "<td>" . $row["ticket_number"] . "</td><td>" . $row["issue"] . "</td><td>" . $row["date_created"] . "</td><td>". $row["urgency"]."</td><td>". $row['username']."</td>";
                      
                      echo "<td><form method='post' action='edit.php'><input type='hidden' value=".$row["ticket_number"]." name='ticketNum'>";
                      echo "<input type='submit' id='ticketInfo' value='Edit'></form></td>";
               				echo "</tr>";
            }else{
                echo "</tr>";
                echo "<td>".$row["ticket_number"]."</td><td>".$row["issue"]."</td><td>".$row["date_finished"]."</td><td>".$row["urgency"]."</td><td>".$row["username"]."</td>";
                echo "<td><form method='post' action='ticketHistory.php'><input type='hidden' value=".$row["ticket_number"]." name='ticketNum'>";
                echo "<input type='submit' id='ticketInfo' value='View'></form></td>";
                echo "</tr>";
            }
 			    }
  		  }
     mysqli_close($CSDB);
		?>
			</table>
		</div>
   <script>
      var slider = document.getElementById("priority_range");
			var output = document.getElementById("demo");
			output.innerHTML = slider.value;
			slider.oninput = function() {
			  output.innerHTML = this.value;
			}
   </script>
	</div>
	<div id="home_footer">
		<form id="logout_button" action="logout.php">
			<input type="submit" name="logout" value="logout"/>
		</form>
	</div>
</body>
</html>
