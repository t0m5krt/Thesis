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
$requestor = $_POST['requestor'];
$date_of_request = $_POST['date_of_request'];
$business_unit = $_POST['business_unit'];
$cust_of_project_name = $_POST['cust_of_project_name'];
$asset_code = $_POST['asset_code'];
$model = $_POST['model'];
$serial_no = $_POST['serial_no'];
$equip_desc = $_POST['equip_desc'];
$brand = $_POST['brand'];
$service_meter_reading = $_POST['service_meter_reading'];
$type_of_request = $_POST['type_of_request'];
$charging = $_POST['charging'];
$unit_problem = $_POST['unit_problem'];
$others = $_POST['others'];
$unit_operational = $_POST['unit_operational'];
$specific_requirement = $_POST['specific_requirement'];
$onsite_contact_person = $_POST['onsite_contact_person'];
$mobile_or_phone_no = $_POST['mobile_or_phone_no'];
$fax_no = $_POST['fax_no']; 

    
// Check if passwords match
if ($pass_word !== $confirm_pass) {
    echo "Error: Passwords do not match";
    exit;
}

// Check if email is valid
if (strpos($emailaddress, '@') === false || strpos($emailaddress, 'gmail.com') === false) {
    echo "Error: Invalid email address";
    exit;
}

// Check if email already exists in the database
$sql = "SELECT * FROM registration WHERE emailaddress = '$emailaddress'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "Error: Email address already registered.";
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
