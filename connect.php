<?php
 // Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$companyname = $_POST['companyname'];
$projectname = $_POST['projectname'];
$emailaddress = $_POST['emailaddress'];
$contactnumber = $_POST['contactnumber'];
$pass_word = $_POST['pass_word'];
$confirm_pass = $_POST['confirm_pass'];

// Database connection
$sql = "INSERT INTO registration(firstname, lastname, companyname, projectname, emailaddress, contactnumber, pass_word, confirm_pass) VALUES ('$firstname', '$lastname', '$companyname', '$projectname', '$emailaddress', '$contactnumber', '$pass_word', '$confirm_pass')";

if (mysqli_query($conn, $sql)) {
    echo "CREATED SUCCESSFULLY";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
if 
?>







