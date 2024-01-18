<?php
include 'includes/connection.php';

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "UPDATE user_accounts
        SET reset_token_hash = ?, 
        reset_token_expires_at = ?
        WHERE email = ?";
$stmt = $conn->prepare($sql); // Use the connection object $conn
$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

// Check for errors after execution
if ($stmt->affected_rows) {
        $mail = include "mailer.php";

        $mail->setFrom("noreply@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
    Click <a href="http://localhost/1Thesis-updated/users/reset_password.php?token=$token">here</a> 
    to reset your password.
    END;

        try {
                $mail->send();
                echo "Message sent, please check your inbox.";
        } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
} else {
        echo "No records updated. Check your SQL query and connection.";
}

$stmt->close();
