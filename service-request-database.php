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
$dateOfRequest = date('Y-m-d', strtotime($_POST['date-of-request']));
$businessUnit = $_POST['business-unit'];
$custProjectName = $_POST['cust-project-name'];
$assetCode = $_POST['asset-code'];
$model = $_POST['model'];
$serialNo = $_POST['serial-no'];
$equipDesc = $_POST['equip-desc'];
$brand = $_POST['brand'];
$serviceMeterReading = $_POST['service-meter-reading'];
$typeOfRequest = $_POST['type-of-request'];
$additionalOption = "";
$otherServiceRequest = "";

if ($typeOfRequest === 'other') {
    $otherServiceRequest = $_POST['other-input-servreq'];
} else {
    $additionalOption = $_POST['additional-option-service-request'];
}

$charging = $_POST['charging'];
$unitProblem = $_POST['unit-problem'];
$others = $_POST['others'];
$unitOperational = $_POST['unit-operational'];
$specificRequirement = $_POST['specific-requirement'];
$onsiteContactPerson = $_POST['onsite-contact-person'];
$mobileOrPhoneNo = $_POST['mobile-or-phone-no'];
$faxNo = $_POST['fax-no'];

// Perform any necessary actions or validations based on the form data
// For example, you can insert the data into a database table
$sql = "INSERT INTO service_requests (requestor, dateofrequest, businessunit, custprojectname, assetcode, model, serialno, equipdesc, brand, servicemeterreading, typeofrequest, additionaloption, otherservicerequest, charging, unitproblem, others, unitoperational, specificrequirement, onsitecontactperson, mobileorphoneno, faxno)
        VALUES ('$requestor', '$dateOfRequest', '$businessUnit', '$custProjectName', '$assetCode', '$model', '$serialNo', '$equipDesc', '$brand', '$serviceMeterReading', '$typeOfRequest', '$additionalOption', '$otherServiceRequest', '$charging', '$unitProblem', '$others', '$unitOperational', '$specificRequirement', '$onsiteContactPerson', '$mobileOrPhoneNo', '$faxNo')";
if (mysqli_query($conn, $sql)) {
    echo "Service Request submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
