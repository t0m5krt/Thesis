<?php

$servername = "localhost";
$email = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $email, $password, $dbname);

if ($conn == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
