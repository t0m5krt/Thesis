<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";


$mail = new PHPMailer(true);

$invoiceUrl = 'http://localhost/Webdevelopment/thesis1_website/Email/Invoice.php?ref=ref8';
$ch = curl_init($invoiceUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$htmlContent = curl_exec($ch);
curl_close($ch);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Use your hosting provider's SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'celsmanagement@megawidecels-rmms.online'; // Use your email address
    $mail->Password = '1234.Thesis'; // Use your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL encryption
    $mail->Port = 465; // Use the SSL port (465 for SMTPS)

    // Recipients
    $mail->setFrom('celsmanagement@megawidecels-rmms.online ', 'Invoice');
    $mail->addAddress('tpancha22@gmail.com');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Order Summary';
    $mail->Body = 'testing lang';

    $mail->addStringAttachment($htmlContent, 'invoice.html');

    // Avoiding spam complaints
    $mail->AddCustomHeader('List-Unsubscribe: <mailto:unsubscribe@example.com>');

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
