<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

$email = $_SESSION["email"];

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Use your hosting provider's SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'celsemail@megawidecels-rmms.online'; // Use your email address
    $mail->Password = '1234.Thesis'; // Use your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL encryption
    $mail->Port = 465; // Use the SSL port (465 for SMTPS)

    // Recipients
    $mail->setFrom('celsemail@megawidecels-rmms.online ', 'noreply');
    $mail->addAddress("$email");

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Account Activation';
    $mail->Body = 'Please click <a href="https://megawidecels-rmms.online/users/account_activation.php?email=' . $email . '">here</a> to activate your email.';

    // Avoiding spam complaints
    $mail->AddCustomHeader('List-Unsubscribe: <mailto:unsubscribe@example.com>');

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
