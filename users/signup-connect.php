<?php
include_once 'includes/connection.php';

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$company_name = $_POST['company_name'];
$project_name = $_POST['project_name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$pass_word = $_POST['pass_word'];
$confirm_pass = $_POST['confirm_pass'];

// Check if passwords match
if ($pass_word !== $confirm_pass) {
    echo "Error: Passwords do not match";
    exit;
}

// Check if email already exists in the database
$sql = "SELECT * FROM registration WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "Error: Email address already registered";
    exit;
}

// Hash the password
$hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO registration (first_name, last_name, company_name, project_name, email, contact_number, pass_word) 
        VALUES ('$first_name', '$last_name', '$company_name', '$project_name', '$email', '$contact_number', '$hashed_password')";

if ($pass_word === $confirm_pass && mysqli_query($conn, $sql)) {
    header("Location: signup-success.html");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
