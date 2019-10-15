<?php 

# giveClassActive() is a function that highlights the header name of the current page. The $file is what is used to determine whether to give it the element a class active. The $href determines the location. There can be different when dealing with special symbols. The $show is the text to show.
function giveClassActive($file, $href, $show, $li = true) {
  $shouldbeactive = $_SERVER['REQUEST_URI'] == $href;
  if ($href == null)
    $href = $file;
  echo $li ? '<li class = "' : '';
  echo $shouldbeactive && $li ? 'active' : '';
  echo $li ? '">' : '';
  echo '<a href = "' . $href . '"';
  echo $shouldbeactive && !$li ? ' class = "active"' : '';
  echo '>'. $show . '</a>';
  echo $li ? '</li>' : '';
}

$mods = array(6);
define('LOGGEDIN', isset($_SESSION['id']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name']));
define('ISADMIN', isset($_SESSION['id']) && in_array($_SESSION['id'], $mods));

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($subject, $body, $email = 'VSpoet49@gmail.com', $aftermessage = '') {


  // Load Composer's autoloader
  require 'vendor/autoload.php';

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = 4;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'localhost';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
      $mail->Username   = 'varunsingh87@yahoo.com';                     // SMTP username
      $mail->Password   = '';                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 25;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('varunsingh87@yahoo.com', 'Varun Singh');
      $mail->addAddress($email);     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $body;
      $mail->AltBody = strip_tags($body);
      $mail->send();
      echo $aftermessage;
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  } 
}

?>

