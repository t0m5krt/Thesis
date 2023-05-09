<?php
 // Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$errors = array();
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

//user does not already exist with the same username/email
$user_check_query = "SELECT * FROM users WHERE username ='$emailaddress LIMIT 1";
$result = mysqli_query($conn, $user_check_query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    $user = null;
}


If ($user) {
    if ($user['emailaddress'] === $emailaddress) {
        array_push ($errors, "Email address already exists");
    }
}

// Database connection
$sql = "INSERT INTO registration(firstname, lastname, companyname, projectname, emailaddress, contactnumber, pass_word, confirm_pass) VALUES ('$firstname', '$lastname', '$companyname', '$projectname', '$emailaddress', '$contactnumber', '$pass_word', '$confirm_pass')";

if (mysqli_query($conn, $sql)) {
    echo "CREATED SUCCESSFULLY";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

if (isset($_POST['Login'])) {
    $emailaddress = md5($pass_word);
    $sql = "SELECT * FROM users WHERE username='$emailaddress' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $emailaddress;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.html');
    } else {
        array_push ($errors,"Wrong email address/password combination");
    }
    
}
?>





