<?php
require 'includes/connection.php';

$email = $_GET['email'];
$sql = "UPDATE user_accounts
        SET account_activation_hash = NULL
        WHERE email = ?";
$stmt = $conn->prepare($sql);


$stmt->bind_param("s", $email);
// $stmt = $conn->prepare($sql);

$stmt->execute();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Account Activated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>

    <h1>Account Activated</h1>

    <p>Account activated successfully. You can now
        <a href="login.php">log in</a>.
    </p>

</body>

</html>