<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$companyname = $_POST['companyname'];
$projectname = $_POST['projectname'];
$emailaddress = $_POST['emailaddress'];
$contactnumber = $_POST['contactnumber'];
$pass_word = $_POST['pass_word'];
$confirm_pass = $_POST['confirm_pass'];

// Check if passwords match
if ($pass_word !== $confirm_pass) {
    echo "Error: Passwords do not match";
    exit;
}

// Check if email already exists in the database
$sql = "SELECT * FROM registration WHERE emailaddress = '$emailaddress'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "Error: Email address already registered";
    exit;
}

// Hash the password
$hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO registration (firstname, lastname, companyname, projectname, emailaddress, contactnumber, pass_word) 
        VALUES ('$firstname', '$lastname', '$companyname', '$projectname', '$emailaddress', '$contactnumber', '$hashed_password')";

if ($pass_word === $confirm_pass && mysqli_query($conn, $sql)) {
    echo "CREATED SUCCESSFULLY";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
