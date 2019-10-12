<?php
/*******************************************************************
  Example of sending email using gmail.com SMTP server and phpmailer
*******************************************************************/
use PHPMailer\PHPMailer\PHPMailer;
require 'C:\xampp\composer\vendor\autoload.php';
$mail = new PHPMailer();  // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = "libuc6kfb0jg";  
$mail->Password = "Bananais1color?";           
$mail->SetFrom("admin@bforborum.com", "Borum CEO Varun Singh");
$mail->Subject = "Mail Registration";
$mail->Body = "The email works....";
$mail->AddAddress("VSpoet49@gmail.com", "Borum User Varun Singh");
$mail->Send();
?>