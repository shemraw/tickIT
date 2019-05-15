<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "tickit.capstone@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Capstone1'";
//Set who the message is to be sent from
$mail->setFrom('tickit.capstone@gmail.com', 'tickIT');
//Set an alternative reply-to address
$mail->addReplyTo('tickit.capstone@gmail.com', 'tickIT');
//Set who the message is to be sent to
//$mail->addAddress('iwhitese@kent.edu', 'John Doe');
//$mail->addAddress($_POST['email'], $_POST['name']);
//Set the subject line
//$mail->Subject = "Your tickIT for" . ' [' . $_POST['description'] . '] ';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('createdTicketEmail.html'), __DIR__);
//Replace the plain text body with one created manually
/*$mail->Body = 	'Greetings ' . $_POST['name'] . ',' . "<br><br>" . 
		'Our technician [ADD TECHNICIAN NAME HERE] has created a tickIT for your issue [' . $_POST['description'] . '].' . "<br>" . 
		'You can expect email updates from this address on the progress of your tickIT.' . "<br><br>" . 
		'Best,' . "<br>" . 
		'[ADD DEPARTMENT HERE]' . "<br>" . 
		'[ADD UNIVERSITY HERE]';
$mail->AltBody = 'ERROR: altbody message sent.';
*/
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
/*if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	header("refresh: 5; url=./create.php");
} else {
	echo "Email sent to " . $_POST["name"] . "<br>" . 
	" at email address " . $_POST["email"] . "<br>" . 
	"Redirecting to home...";
	//sending ticket info to DB, should all be in POST
	//redirects page to home.html after 3 seconds
	header("refresh: 2; url=./home.php");
	exit();
}
*/
?>
