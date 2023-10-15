<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rmma";
 
/* connect to MySQL database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
// Check db connection
if($conn === false){
    die("Error: connection error. " . mysqli_connect_error());
}
?>