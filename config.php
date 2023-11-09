<?php

$servername = "127.0.0.1:3306";
$email = "u917436566_vanviola026";
$password = "1234.Thesis";
$dbname = "u917436566_rmms";
$conn = mysqli_connect($servername, $email, $password, $dbname);

if ($conn == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
