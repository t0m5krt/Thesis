<?php




$activation_token = bin2hex(random_bytes(16));

$activation_token_hash = hash("sha256", $activation_token);

$mysqli = require  "includes/connection.php";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param(
    "ssss",
    $_POST["firstname"],
    $_POST["lastname"],
    $_POST["email"],
    $password_hash,
    $activation_token_hash
);

if ($stmt->execute()) {

    $mail = require __DIR__ . "/mailer.php";

    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
