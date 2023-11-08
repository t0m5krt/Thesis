<?php
if (session_status() === PHP_SESSION_NONE)
  session_start();


if (!isset($_SESSION['email'])) {
  // If the user is not logged in, redirect to the login page
  header('Location: login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>Service Request Form</title>
  <link rel="stylesheet" href="styles/service-request-design.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

  <div class="loader">
    <div class="custom-loader"></div>
  </div>
  <form action="request_form.php" method="post">
    <div class="form-title">
      <h3>Service Request Form</h3>
      <p>Enter your concern details to a service request</p>
      <br />
    </div>
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
      <select id="business_unit" name="business_unit" required>
        <option value="" disabled selected>Select option</option>
        <option value="Commercial Construction">Commercial construction</option>
        <option value="Residential Construction">Residential construction</option>
        <option value="Infrastructure Construction">Infrastructure construction</option>
        <option value="Heavy Construction">Heavy construction</option>
        <option value="Specialty Construction">Specialty construction</option>
        <option value="Industrial">Industrial</option>
        <option value="Power Generation">Power generation</option>
        <option value="Mining">Mining</option>
        <option value="Oil & Gas">Oil & Gas</option>
        <option value="Others">Others</option>
      </select>
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
      <label for="equip_desc">EQUIPMENT DESCRIPTION</label>
      <input type="text" id="equip_desc" name="equip_desc" required />
    </div>
    <div class="form-group">
      <label for="brand">BRAND</label>
      <select id="brand" name="brand" required>
        <option value="" disabled selected>Select option</option>
        <option value="Caterpillar">Caterpillar</option>
        <option value="Komatsu">Komatsu</option>
        <option value="Hitachi">Hitachi</option>
        <option value="John Deere">John Deere</option>
        <option value="Volvo CE">Volvo CE</option>
        <option value="Case">Case</option>
        <option value="Liebherr">Liebherr</option>
        <option value="Doosan">Doosan</option>
        <option value="JCB">JCB</option>
        <option value="SANY">SANY</option>
      </select>
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
      <select id="unit_problem" name="unit_problem" required>
        <option value="" disabled selected>Select option</option>
        <option value="Engine failure">Engine failure</option>
        <option value="Hydraulic leaks">Hydraulic leaks</option>
        <option value="Electrical malfunctions">Electrical malfunctions</option>
        <option value="Braking problems">Braking problems</option>
        <option value="Transmission problems">Transmission problems</option>
        <option value="Tire problems">Tire problems</option>
        <option value="Attachment problems">Attachment problems</option>
        <option value="Others">Others</option>
      </select>
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
      <input type="text" id="onsite_contact_person" name="onsite_contact_person" />
    </div>
    <div class="form-group">
      <label for="fax_no">FAX NO.</label>
      <input type="text" id="fax_no" name="fax_no" />
    </div>
    <button type="submit">Submit</button>
  </form>

  <?php include 'includes/scripts.php';

  ?>
  <script>
    // For Hiding option group on creating service request
    document.addEventListener("DOMContentLoaded", function() {
      var typeOfRequest = document.getElementById("type_of_request");
      var additionalOptionGroup = document.getElementById("additional_option_group");
      var otherAdditionalOption = document.getElementById("additional_option");
      var otherServiceRequestInput = document.getElementById("other_service_request_input");

      typeOfRequest.addEventListener("change", function() {
        if (typeOfRequest.value === "Service Request") {
          additionalOptionGroup.style.display = "flex";
        } else {
          additionalOptionGroup.style.display = "none";
        }
      });

      otherAdditionalOption.addEventListener("change", function() {
        if (otherAdditionalOption.value === "Other") {
          otherServiceRequestInput.style.display = "flex";
        } else {
          otherServiceRequestInput.style.display = "none";
        }
      });
    });

    document.getElementById('mobile_or_phone_no').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('service_meter_reading').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('fax_no').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    window.onload = function() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '-' + mm + '-' + dd;
      document.getElementById('date_of_request').value = today;

      document.getElementById('requestor').value = "<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>";
      document.getElementById('mobile_or_phone_no').value = "<?php echo $_SESSION['contactnumber']; ?>";
      document.getElementById('cust_project_name').value = "<?php echo $_SESSION['projectname']; ?>";


    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>
<?php

function handleFormSubmission()
{
  include_once 'includes/connection.php';

  // Get form data
  $userID = $_SESSION['userID'];
  $requestor = $_POST['requestor'];
  $sort_value = 4; // Default value to low proirity
  $date_of_request = date('Y-m-d', strtotime($_POST['date_of_request']));
  $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
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

  // Check if additional_option should be set
  if ($type_of_request === 'Service Request') {
    $additional_option = $_POST['additional_option'];
  } else {
    $additional_option = ''; // Set a default value when not applicable
  }

  // Check if other_service_request should be set
  if ($type_of_request === 'Service Request' && $additional_option === 'Other') {
    $other_service_request = $_POST['other_service_request'];
  } else {
    $other_service_request = ''; // Set a default value when not applicable
  }

  $charging = $_POST['charging'];
  $unit_problem = $_POST['unit_problem'];
  $others = $_POST['others'];
  $unit_operational = $_POST['unit_operational'];
  $specific_requirement = $_POST['specific_requirement'];
  $onsite_contact_person = $_POST['onsite_contact_person'];
  $fax_no = $_POST['fax_no'];

  // Define the priority based on type_of_request
  if ($type_of_request === 'Quotation - Major Repair' || $type_of_request === 'Technical Evaluation Request') {
    $sort_value = 1; // 1 - Critical High
  } elseif ($type_of_request === 'Quotation - Minor Repair' || $type_of_request === 'Preventive Maintenance') {
    $sort_value = 2; // 2 - High
  } elseif ($type_of_request === 'Quotation - Parts' || $type_of_request === 'EQC Inspection') {
    $sort_value = 3; // 3 - Mid
  } else {
    $sort_value = 4; // 4 - Low
  }

  // Check unit_operational and adjust priority if needed
  if ($unit_operational === 'No') {
    $sort_value = 1; // Override priority to HIGH
  }

  // Check the database connection
  if ($conn === false) {
    echo "Error: Unable to connect to the database.";
    return;
  }

  // Perform any necessary actions or validations based on the form data
  // For example, you can insert the data into a database table
  $sql = "INSERT INTO submit_requests (
    sort_value,
    requestor,
    date_of_request,
    mobile_or_phone_no,
    business_unit,
    cust_project_name,
    asset_code,
    model,
    serial_no,
    equip_desc,
    brand,
    service_meter_reading,
    type_of_request,
    additional_option,
    other_service_request,
    charging,
    unit_problem,
    others,
    unit_operational,
    specific_requirement,
    onsite_contact_person,
    fax_no,
    user_id
)
VALUES (
    '$sort_value',
    '$requestor',
    '$date_of_request',
    '$mobile_or_phone_no',
    '$business_unit',
    '$cust_project_name',
    '$asset_code',
    '$model',
    '$serial_no',
    '$equip_desc',
    '$brand',
    '$service_meter_reading',
    '$type_of_request',
    '$additional_option',
    '$other_service_request',
    '$charging',
    '$unit_problem',
    '$others',
    '$unit_operational',
    '$specific_requirement',
    '$onsite_contact_person',
    '$fax_no',
    '$userID'
)";
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
      timer: 1500,
    }).then(function() {
      window.location = "dashboard.php";
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