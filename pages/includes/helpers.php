<?php 
define('LOGGEDIN', isset($_SESSION['id']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name']));

if (LOGGEDIN && isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2400)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    setcookie("dark", '', time()-3600, '/', '', 0, 0);
    setcookie("PHPSESSID", '', time()-3600, '/', '', 0, 0);
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

# giveClassActive() is a function that highlights the header name of the current page. The $file is what is used to determine whether to give it the element a class active. The $href determines the location. There can be different when dealing with special symbols. The $show is the text to show.
function giveClassActive($file, $href, $show, $li = true) {
  $shouldbeactive = $_SERVER['REQUEST_URI'] == $href;
  if ($href == null)
    $href = $file;
  $rectangularBox = !$li ? 'rectangular-box' : '';
  echo $li ? '<li class = "' : '';
  echo $shouldbeactive && $li ? 'active' : '';
  echo $li ? '">' : '';
  echo '<a class = "' . $rectangularBox; 
  echo $shouldbeactive && !$li ? ' active' : '';
  echo '" href = "' . $href . '"';

  echo '>'. $show . '</a>';
  echo $li ? '</li>' : '';
}

$mods = array(6);
define('ISADMIN', isset($_SESSION['id']) && in_array($_SESSION['id'], $mods));

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($subject, $body, $email = 'admin@bforborum.com', $aftermessage = '') {


  // Load Composer's autoloader
  require 'vendor/autoload.php';

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = 1;                      // Verbose debug output: 1 for no 2,3,4 for yes
      $mail->isMail();                                            // Send using SMTP
      $mail->Port       = 25;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('admin@bforborum.com', 'The Borum Team');
      $mail->addAddress($email);     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $body;
      $mail->AltBody = strip_tags($body);
      $mail->send();
      echo $aftermessage;
  } catch (Exception $e) {
      echo "Message could not be sent. A mailing error occured. ";
  } 
}

?>

