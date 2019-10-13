<?php 

$page_title = "Contact Us";
require("includes/header.html");
?>
<div class = "col-sm-7">
	<h1>Contact Us</h1>
	<button style = "display: <?php echo !LOGGEDIN ? 'block' : 'none' ?>" type = "button" onclick = "window.location.href = '/Login';">Log In</button>
	<form style = "display: <?php echo LOGGEDIN ? 'block' : 'none' ?>" action method = "post">
		<p>
			<label for = "subject">Subject: </label>
			<input required type = "text" id = "subject" name = "subject" size = "100">
		</p>
		<p>
			<label for = "body">Details</label>
			<textarea required name = "body" id = "body" cols = "50"></textarea>
		</p>
		<input type = "submit" value = "Send message">
	</form>
<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($subject, $body, $email) {


	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                      // Disable verbose debug output
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
	    echo "<h3>Thanks for contacting us! We will respond within the next 3 days.</h3>";
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$subject = trim($_POST['subject']);
	$body = trim($_POST['body']);

	// Fetch email from database
	$q = "SELECT id, email FROM users WHERE id = {$_SESSION['id']}";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
	$email = $row[1];

	sendEmail($subject, $body, $email);
}

include('includes/footer.html'); 

?>

