<?php
include 'includes/header.php';

//make a logout session in php
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location:login.php');
    exit();
}
?>


<body>

    <div class="loader">
        <div class="custom-loader"></div>
    </div>
    <?php include 'includes/sidebar.php'; ?>

    <section id="content">
        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/content.php'; ?>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Service Request Form</h1>
                    <p>Enter your concern details to a service request</p>
                </div>
            </div>

            <form action="request_form.php" method="post">
                <div class="form-group">
                    <label for="requestor">REQUESTOR</label>
                    <input type="text" id="requestor" name="requestor" required />
                </div>
                <div class="form-group">
                    <label for="date_of_request">DATE OF REQUEST</label>
                    <input type="date" id="date_of_request" name="date_of_request" required />
                </div>
                <div class="form-group">
                    <label for="mobile_or_phone_no">MOBILE/PHONE NO.</label>
                    <input type="text" id="mobile_or_phone_no" name="mobile_or_phone_no" maxlength="11" placeholder="09XX-XXX-XXXX" required />
                </div>
                <div class="form-group">
                    <label for="business_unit">BUSINESS UNIT</label>
                    <input type="text" id="business_unit" name="business_unit" required />
                </div>
                <div class="form-group">
                    <label for="cust_project_name">CUST./PROJECT NAME</label>
                    <input type="text" id="cust_project_name" name="cust_project_name" required />
                </div>
                <div class="form-group">
                    <label for="asset_code">ASSET CODE</label>
                    <input type="text" id="asset_code" name="asset_code" />
                </div>
                <div class="form-group">
                    <label for="model">MODEL</label>
                    <input type="text" id="model" name="model" required />
                </div>
                <div class="form-group">
                    <label for="serial_no">SERIAL NO.</label>
                    <input type="text" id="serial_no" name="serial_no" required />
                </div>
                <div class="form-group">
                    <label for="equip_desc">EQUIP DESC</label>
                    <input type="text" id="equip_desc" name="equip_desc" required />
                </div>
                <div class="form-group">
                    <label for="name">BRAND</label>
                    <input type="text" id="brand" name="brand" required />
                </div>
                <div class="form-group">
                    <label for="name">SERVICE METER READING</label>
                    <input type="text" id="service_meter_reading" name="service_meter_reading" required />
                </div>
                <div class="form-group">
                    <label for="type_of_request">TYPE OF REQUEST</label>
                    <select id="type_of_request" name="type_of_request" required>
                        <option value="" disabled selected>Select option</option>
                        <option value="Quotation - Major Repair">Quotation - Major Repair</option>
                        <option value="Quotation - Minor Repair">Quotation - Minor Repair</option>
                        <option value="Quotation Parts">Quotation - Parts</option>
                        <option value="Preventive Maintenance">Preventive Maintenance</option>
                        <option value="EQC Inspection">EQC Inspection</option>
                        <option value="Technical Evaluation Request">Technical Evaluation Request</option>
                        <option value="Service Request">Service Request</option>
                    </select>
                    <div id="additional_option_group" class="form-group" style="display: none">
                        <label for="additional_option"> Select:</label>
                        <select name="additional_option" id="additional_option">
                            <option value="" disabled selected>Select option</option>
                            <option value="Emergency Call">Emergency Call (Waver Required)</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div id="other_service_request_input" class="form-group" style="display: none">
                        <label for="other_service_request,">OTHERS:</label>
                        <input type="text" id="other_service_request," name="other_service_request," placeholder="Specify Here:" />
                    </div>

                    <div class="form-group">
                        <label for="charging">CHARGING </label>
                        <select id="charging" name="charging" required>
                            <option value="" disabled selected>Select option</option>
                            <option value="Lease">Lease (Buyback)</option>
                            <option value="Rental">Rental</option>
                            <option value="Warranty">Warranty</option>
                        </select>
                    </div>
                </div>

                <br />
                <div class="form-title">
                    <h3>Customer Service Request/Complaint</h3>
                </div>
                <br />
                <div class="form-group">
                    <label for="unit_problem">UNIT PROBLEM</label>
                    <input type="text" id="unit_problem" name="unit_problem" required />
                </div>
                <div class="form-group">
                    <label for="others">OTHERS P/N</label>
                    <input type="text" id="others" name="others" />
                </div>
                <div class="form-group">
                    <label for="unit_operational">UNIT OPERATIONAL</label>
                    <select id="unit_operational" name="unit_operational" required>
                        <option value="" disabled selected>Select option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="specific_requirement">SPECIFIC REQUIREMENT</label>
                    <input type="text" id="specific_requirement" name="specific_requirement" />
                </div>
                <div class="form-group">
                    <label for="onsite_contact_person">ONSITE CONTACT PERSON</label>
                    <input type="text" id="onsite_contact_person" name="onsite_contact_person" required />
                </div>
                <div class="form-group">
                    <label for="fax_no">FAX NO.</label>
                    <input type="text" id="fax_no" name="fax_no" />
                </div>
                <button type="submit">Submit</button>
            </form>

        </main>
    </section>


    <?php include 'includes/scripts.php' ?>
    <script src="js/script.js"></script>
</body>

</html>

<?php

function handleFormSubmission()
{
    include 'includes/connection.ph';


    // Get form data
    $requestor = $_POST['requestor'];
    $date_of_request = date('Y-m-d', strtotime($_POST['date_of_request']));
    $business_unit = $_POST['business_unit'];
    $cust_project_name = $_POST['cust_project_name'];
    $asset_code = $_POST['asset_code'];
    $model = $_POST['model'];
    $serial_no = $_POST['serial_no'];
    $equip_desc = $_POST['equip_desc'];
    $brand = $_POST['brand'];
    $service_meter_reading = $_POST['service_meter_reading'];
    $type_of_request = $_POST['type_of_request'];
    $additional_option = "";
    $other_service_request = "";

    if ($type_of_request === 'other') {
        $other_service_request = $_POST['other_input_serv_req'];
    } else {
        $additional_option = $_POST['additional_option_service_request'];
    }

    $charging = $_POST['charging'];
    $unit_problem = $_POST['unit_problem'];
    $others = $_POST['others'];
    $unit_operational = $_POST['unit_operational'];
    $specific_requirement = $_POST['specific_requirement'];
    $onsite_contact_person = $_POST['onsite_contact_person'];
    $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
    $fax_no = $_POST['fax_no'];

    // Perform any necessary actions or validations based on the form data
    // For example, you can insert the data into a database table
    $sql = "INSERT INTO service_requests (requestor, date_of_request, business_unit, cust_project_name, asset_code, model, serial_no, equip_desc, brand, service_meter_reading, type_of_request, additional_option, other_service_request, charging, unit_problem, others, unit_operational, specific_requirement, onsite_contact_person, mobile_or_phone_no, fax_no)
        VALUES ('$requestor', '$date_of_request', '$business_unit', '$cust_project_name', '$asset_code', '$model', '$serial_no', '$equip_desc', '$brand', '$service_meter_reading', '$type_of_request', '$additional_option', '$other_service_request', '$charging', '$unit_problem', '$others', '$unit_operational', '$specific_requirement', '$onsite_contact_person', '$mobile_or_phone_no', '$fax_no')";
    if (mysqli_query($conn, $sql)) {
        echo "Service Request submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    // Redirect the user to a new URL after successful submission
?>

    <script>
        swal.fire({
            icon: 'success',
            title: 'Service Request Submitted Successfully',
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = "service_request.php";
            exit();
        });
    </script>

<?php

    mysqli_close($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleFormSubmission();
}

?>