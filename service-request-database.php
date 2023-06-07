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
$date_of_request = $_POST['date-of-request'];
$business_unit = $_POST['business-unit'];
$cust_of_project_name = $_POST['cust-of-project-name'];
$asset_code = $_POST['asset-code'];
$model = $_POST['model'];
$serial_no = $_POST['serial-no'];
$equip_desc = $_POST['equip-desc'];
$brand = $_POST['brand'];
$service_meter_reading = $_POST['service-meter-reading'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected value from the $_POST array
    $type_of_request = $_POST['type-of-request'];

    // Perform further processing or validation based on the selected value
    if ($type_of_request === 'Q_majorRepair') {
        // Handle Quotation - Major Repair
    } elseif ($type_of_request === 'Q_minorRepair') {
        // Handle Quotation - Minor Repair
    } elseif ($type_of_request === 'Q_Parts') {
        // Handle Quotation - Parts
    } elseif ($type_of_request === 'preventiveMaintenance') {
        // Handle Preventive Maintenance
    } elseif ($type_of_request === 'eqcInspection') {
        // Handle EQC Inspection
    } elseif ($type_of_request === 'technicalEvaluationRequest') {
        // Handle Technical Evaluation Request
    } elseif ($type_of_request === 'emergencyCall') {
        // Handle Emergency Call
    } elseif ($type_of_request === 'other') {
        // Handle Other
    } else {
        // Handle Service Request or empty value
    }

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected value from the $_POST array
    $charging = $_POST['charging'];

    // Perform further processing or validation based on the selected value
    if ($charging === 'lease') {
        // Handle Lease (Buyback)
    } elseif ($charging === 'rental') {
        // Handle Rental
    } elseif ($charging === 'warranty') {
        // Handle Warranty
    } else {
        // Handle other cases or empty value
    }

    // Perform any other actions or redirections as needed
}
$unit_problem = $_POST['unit-problem'];
$others = $_POST['others'];
$unit_operational = $_POST['unit-operational'];
$specific_requirement = $_POST['specific-requirement'];
$onsite_contact_person = $_POST['onsite-contact-person'];
$mobile_or_phone_no = $_POST['mobile-or-phone-no'];
$fax_no = $_POST['fax-no']; 

    
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
