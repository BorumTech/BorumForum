<?php 

if (!isset($_SESSION['id'])) {
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<style>
		form {
			font-family: sans-serif;
		}

		form input, textarea {
			display: block;
			line-height: 1.7em;
		}
	</style>
	<link href = "../images/icon.ico" rel = "shortcut icon" type = "image/x-icon">
	<title>Contact Us</title>
</head>
<body>
	<h1>Contact Us</h1>
	<form action method = "post">
		<p>
			<label for = "subject">Subject: </label>
			<input type = "text" id = "subject" name = "subject" size = "100">
		</p>
		<p>
			<label for = "body">Details</label>
			<textarea name = "body" id = "body" cols = "50"></textarea>
		</p>
		<input type = "submit" value = "Send message">
	</form>
</body>
</html>
<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail() {


	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'VSpoet49@gmail.com';                     // SMTP username
	    $mail->Password   = 'Pr0gram$';                               // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('VSpoet49@gmail.com', 'Varun Singh');
	    $mail->addAddress($email);     // Add a recipient

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $subject;
	    $mail->Body    = $body;
	    $mail->AltBody = strip_tags($body);

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['subject'])) {
		$subject = "";
	}
	//sendEmail();
}

