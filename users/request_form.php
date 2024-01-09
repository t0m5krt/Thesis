<?php
include 'includes/connection.php';
if (session_status() === PHP_SESSION_NONE)
  session_start();


if (!isset($_SESSION['email'])) {
  // If the user is not logged in, redirect to the login page
  header('Location: login.php');
  exit();
}

// Retrieve the user's ID from the session
$user_id = $_SESSION['userID'];

// Query the database to get the user's name
$sql = "SELECT * FROM user_accounts WHERE user_ID = $user_id";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $user_name = $row['firstname'];
  $user_lastname = $row['lastname'];
  $user_contactnumber = $row['contactnumber'];
  $user_projectname = $row['projectname'];

  $user_fullname = $user_name . ' ' . $user_lastname;



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
    <script>
      function redirectToAdditionalForm() {
        window.location = "additional_form.php";
      }


      var var2 = 0;

      function addBrandRow() {
        var selectElement = document.getElementById("brand");

        // Clone the element
        var clone = selectElement.cloneNode(true);

        // Extract the current ID
        var currentId = clone.name;

        // Increment the ID starting from 1
        var newId = currentId + (var2 + 1);

        // Set the new ID for the cloned element
        clone.name = newId;

        selectElement.parentNode.appendChild(clone);
        var2++;

        console.log(selectElement.parentNode.children.length);
      }


      function removeBrandRow(button) {
        var selectElement = button.parentNode.querySelector("select");
        var parentElement = selectElement.parentNode;

        // Check if there is only one row left
        if (parentElement.children.length > 1) {
          parentElement.removeChild(parentElement.lastChild);
          console.log(parentElement.children.length);
        } else {
          console.log("Cannot remove the last row. At least one row must remain.");
        }
      }

      var var1 = 0;

      function addUnitProblemRow() {
        var selectElement = document.getElementById("unit_problem");

        // Clone the element
        var clone = selectElement.cloneNode(true);

        // Extract the current ID
        var currentId = clone.name;

        // Increment the ID (you can customize the logic here)
        var newId = currentId + var1;

        // Set the new ID for the cloned element
        clone.name = newId;

        // Append the cloned element to the parent node
        selectElement.parentNode.appendChild(clone);
        var1++;

        console.log(selectElement.parentNode.querySelectorAll('select').length);
      }

      function removeUnitProblemRow(button) {
        var selectElement = button.parentNode.querySelector("select");
        selectElement.parentNode.removeChild(selectElement.parentNode.lastChild);
      }
    </script>
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
        <label for="requestor">REQUESTOR <span style="color: red;">*</span></label>
        <input type="text" id="requestor" name="requestor" required readonly />
      </div>
      <div class="form-group" style="display: none;">
        <label for="date_of_request">DATE OF REQUEST <span style="color: red;">*</span></label>
        <?php
        date_default_timezone_set('Asia/Manila');
        $currentDateTime = date('Y-m-d\TH:i');
        ?>
        <input type="datetime-local" id="date_of_request" name="date_of_request" value="<?php echo $currentDateTime; ?>" />
      </div>
      <div class="form-group">
        <label for="mobile_or_phone_no">MOBILE/PHONE NO. <span style="color: red;">*</span></label>
        <input type="text" id="mobile_or_phone_no" name="mobile_or_phone_no" maxlength="11" placeholder="09XX-XXX-XXXX" value="<?php echo $user_contactnumber ?>" required />
      </div>
      <div class="form-group">
        <label for="address">ADDRESS <span style="color: red;">*</span></label>
        <input type="text" id="address" name="address" required />
      </div>
      <div class="form-group">
        <label for="business_unit">BUSINESS UNIT <span style="color: red;">*</span></label>
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
        <label for="cust_project_name">CUST./PROJECT NAME <span style="color: red;">*</span></label>
        <input type="text" id="cust_project_name" name="cust_project_name" required />
      </div>

      <div class="form-group">
        <label for="type_of_request">TYPE OF REQUEST <span style="color: red;">*</span></label>
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


      </div>

      <br />
      <div class="form-title">
        <h3>Unit Details / Problem</h3>
      </div>
      <br />

      <div class="form-group">
        <label for="model">MODEL <span style="color: red;">*</span></label>
        <input type="text" id="model" name="model" required />
      </div>

      <div class="form-group">
        <label for="brand">BRAND <span style="color: red;">*</span></label>
        <select id="brand" name="brand" required>
          <option value="" disabled selected>Select option</option>
          <optgroup label="Earthmoving Equipment">
          <optgroup label="Dozers">
            <option value="caterpillar-dozer">Caterpillar</option>
            <option value="komatsu-dozer">Komatsu</option>
            <option value="john-deere-dozer">John Deere</option>
            <option value="liebherr-dozer">Liebherr</option>
            <option value="terex-dozer">Terex</option>
          </optgroup>
          <optgroup label="Excavators">
            <option value="caterpillar-excavator">Caterpillar</option>
            <option value="komatsu-excavator">Komatsu</option>
            <option value="hitachi-excavator">Hitachi</option>
            <option value="volvo-excavator">Volvo Construction Equipment</option>
            <option value="jcb-excavator">JCB</option>
          </optgroup>
          <optgroup label="Loaders">
            <option value="caterpillar-loader">Caterpillar</option>
            <option value="komatsu-loader">Komatsu</option>
            <option value="john-deere-loader">John Deere</option>
            <option value="bobcat-loader">Bobcat</option>
            <option value="case-loader">Case</option>
          </optgroup>
          <optgroup label="Backhoe Loaders">
            <option value="john-deere-backhoe">John Deere</option>
            <option value="new-holland-backhoe">New Holland</option>
            <option value="case-backhoe">Case</option>
            <option value="kubota-backhoe">Kubota</option>
            <option value="jcb-backhoe">JCB</option>
          </optgroup>
          <optgroup label="Skid Steer Loaders">
            <option value="bobcat-skidsteer">Bobcat</option>
            <option value="caterpillar-skidsteer">Caterpillar</option>
            <option value="john-deere-skidsteer">John Deere</option>
            <option value="kubota-skidsteer">Kubota</option>
            <option value="case-skidsteer">Case</option>
          </optgroup>
          <optgroup label="Track Loaders">
            <option value="caterpillar-trackloader">Caterpillar</option>
            <option value="komatsu-trackloader">Komatsu</option>
            <option value="john-deere-trackloader">John Deere</option>
            <option value="liebherr-trackloader">Liebherr</option>
            <option value="terex-trackloader">Terex</option>
          </optgroup>
          <optgroup label="Motor Graders">
            <option value="caterpillar-motorgrader">Caterpillar</option>
            <option value="john-deere-motorgrader">John Deere</option>
            <option value="volvo-motorgrader">Volvo Construction Equipment</option>
            <option value="komatsu-motorgrader">Komatsu</option>
            <option value="wirtgen-motorgrader">Wirtgen</option>
          </optgroup>
          <optgroup label="Compact Track Loaders">
            <option value="bobcat-compacttrackloader">Bobcat</option>
            <option value="caterpillar-compacttrackloader">Caterpillar</option>
            <option value="john-deere-compacttrackloader">John Deere</option>
            <option value="kubota-compacttrackloader">Kubota</option>
            <option value="case-compacttrackloader">Case</option>
          </optgroup>
          <optgroup label="Wheel Tractor-Scrapers">
            <option value="caterpillar-wheeltractor-scraper">Caterpillar</option>
            <option value="john-deere-wheeltractor-scraper">John Deere</option>
            <option value="terex-wheeltractor-scraper">Terex</option>
            <option value="komatsu-wheeltractor-scraper">Komatsu</option>
            <option value="volvo-wheeltractor-scraper">Volvo Construction Equipment</option>
          </optgroup>
          </optgroup>

          <optgroup label="Trucks">
          <optgroup label="Off-Highway Trucks">
            <option value="caterpillar-offhighway">Caterpillar</option>
            <option value="komatsu-offhighway">Komatsu</option>
            <option value="terex-offhighway">Terex</option>
            <option value="hitachi-offhighway">Hitachi</option>
            <option value="volvo-offhighway">Volvo Construction Equipment</option>
          </optgroup>
          <optgroup label="Articulated Dump Trucks">
            <option value="bell-equipment-dumptruck">Bell Equipment</option>
            <option value="caterpillar-dumptruck">Caterpillar</option>
            <option value="volvo-dumptruck">Volvo Construction Equipment</option>
            <option value="komatsu-dumptruck">Komatsu</option>
            <option value="terex-dumptruck">Terex</option>
          </optgroup>
          <optgroup label="Concrete Mixers">
            <option value="oshkosh-concretemixer">Oshkosh</option>
            <option value="mack-concretemixer">Mack</option>
            <option value="international-concretemixer">International</option>
            <option value="volvo-trucks-concretemixer">Volvo Trucks</option>
            <option value="scania-concretemixer">Scania</option>
          </optgroup>
          <optgroup label="Dump Trucks">
            <option value="peterbilt-dumptruck">Peterbilt</option>
            <option value="kenworth-dumptruck">Kenworth</option>
            <option value="freightliner-dumptruck">Freightliner</option>
            <option value="mack-dumptruck">Mack</option>
            <option value="western-star-dumptruck">Western Star</option>
          </optgroup>
          </optgroup>

          <optgroup label="Cranes">
          <optgroup label="Mobile Cranes">
            <option value="grove-mobilecrane">Grove</option>
            <option value="manitowoc-mobilecrane">Manitowoc</option>
            <option value="liebherr-mobilecrane">Liebherr</option>
            <option value="demag-mobilecrane">Demag</option>
            <option value="tadano-mobilecrane">Tadano</option>
          </optgroup>
          <optgroup label="Rough Terrain Cranes">
            <option value="grove-roughterraincrane">Grove</option>
            <option value="manitowoc-roughterraincrane">Manitowoc</option>
            <option value="terex-roughterraincrane">Terex</option>
            <option value="demag-roughterraincrane">Demag</option>
            <option value="kobelco-roughterraincrane">Kobelco</option>
          </optgroup>
          <optgroup label="Crawler Cranes">
            <option value="liebherr-crawlercrane">Liebherr</option>
            <option value="demag-crawlercrane">Demag</option>
            <option value="manitowoc-crawlercrane">Manitowoc</option>
            <option value="sennebogen-crawlercrane">Sennebogen</option>
            <option value="hitachi-crawlercrane">Hitachi</option>
          </optgroup>
          <optgroup label="Tower Cranes">
            <option value="potain-towercrane">Potain</option>
            <option value="liebherr-towercrane">Liebherr</option>
            <option value="wolffkran-towercrane">Wolffkran</option>
            <option value="terex-towercrane">Terex</option>
            <option value="linden-comansa-towercrane">Linden Comansa</option>
          </optgroup>
          </optgroup>

          <optgroup label="Other Equipment">
          <optgroup label="Concrete Pumps">
            <option value="putzmeister-concretepump">Putzmeister</option>
            <option value="schwing-stetter-concretepump">Schwing-Stetter</option>
            <option value="aalmac-concretepump">Aalmac</option>
            <option value="cifa-concretepump">CIFA</option>
            <option value="bsa-concretepump">BSA</option>
          </optgroup>
          <optgroup label="Paving Equipment">
            <option value="vogele-pavingequipment">Vögele</option>
            <option value="dynapac-pavingequipment">Dynapac</option>
            <option value="bomag-pavingequipment">BOMAG</option>
            <option value="wirtgen-pavingequipment">Wirtgen</option>
            <option value="ammann-pavingequipment">Ammann</option>
          </optgroup>
          <optgroup label="Asphalt Pavers">
            <option value="vogele-asphaltpaver">Vögele</option>
            <option value="dynapac-asphaltpaver">Dynapac</option>
            <option value="bomag-asphaltpaver">BOMAG</option>
            <option value="wirtgen-asphaltpaver">Wirtgen</option>
            <option value="ammann-asphaltpaver">Ammann</option>
          </optgroup>
          <optgroup label="Rollers">
            <option value="hamm-roller">Hamm</option>
            <option value="dynapac-roller">Dynapac</option>
            <option value="bomag-roller">BOMAG</option>
            <option value="ammann-roller">Ammann</option>
            <option value="vogele-roller">Vögele</option>
          </optgroup>
          <optgroup label="Generators">
            <option value="caterpillar-generator">Caterpillar</option>
            <option value="cummins-generator">Cummins</option>
            <option value="generac-generator">Generac</option>
            <option value="kohler-generator">Kohler</option>
            <option value="john-deere-generator">John Deere</option>
          </optgroup>
          <optgroup label="Forklifts">
            <option value="toyota-forklift">Toyota</option>
            <option value="hyster-yale-forklift">Hyster-Yale</option>
            <option value="caterpillar-forklift">Caterpillar</option>
            <option value="clark-forklift">Clark</option>
            <option value="komatsu-forklift">Komatsu</option>
          </optgroup>
          </optgroup>
        </select>
      </div>

      <button type="button" onclick="addBrandRow()" class="btn btn-danger">Add Brand</button>
      <button type="button" class="btn btn-danger" onclick="removeBrandRow(this)">Remove</button>
      <div class="form-group">
        <label for="unit_problem">UNIT PROBLEM <span style="color: red;">*</span></label>
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
      <button type="button" onclick="addUnitProblemRow()" class="btn btn-danger">Add Unit Problem</button>
      <button type="button" class="btn btn-danger" onclick="removeBrandRow(this)">Remove</button>

      <div class="form-group">
        <label for="unit_operational">UNIT OPERATIONAL <span style="color: red;">*</span></label>
        <select id="unit_operational" name="unit_operational" required>
          <option value="" disabled selected>Select option</option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
      </div>


      <button type="submit">Submit</button>
    </form>

  <?php include 'includes/scripts.php';
}
  ?>
  <script>
    document.getElementById('requestor').value = "<?php echo $user_fullname ?>";
    document.getElementById('mobile_or_phone_no').value = "<?php echo $user_contactnumber ?>";
    document.getElementById('cust_project_name').value = "<?php echo $user_projectname; ?>";
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

    const dropdown = document.getElementById("brand");

    dropdown.addEventListener("change", (event) => {
      if (event.target.value === "Other") {
        const othersInput = document.createElement("input");
        othersInput.type = "text";
        othersInput.placeholder = "Please specify";
        othersInput.style.display = "none"; // Initially hidden
        dropdown.insertAdjacentElement("afterend", othersInput);

        if (confirm("The option is not available. Do you want to specify it?")) {
          othersInput.style.display = "block"; // Show the text input
        } else {
          dropdown.value = ""; // Clear the selection
        }
      } else {
        if (document.querySelector("input[type='text']")) {
          document.querySelector("input[type='text']").remove(); // Remove if exists
        }
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  </body>

  </html>
  <?php


  function handleFormSubmission()
  {
    include 'includes/connection.php';

    // Get form data
    $userID = $_SESSION['userID'];
    $requestor = $_POST['requestor'];
    $sort_value = 4; // Default value to low proirity
    $date_of_request = date('Y-m-d', strtotime($_POST['date_of_request']));
    $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
    $address = $_POST['address'];
    $business_unit = $_POST['business_unit'];
    $cust_project_name = $_POST['cust_project_name'];
    $model = $_POST['model'];
    $brand = $_POST['brand'];

    for ($i = 0; $i < 999; $i++) {
      if (isset($_POST['brand' . $i])) {
        $brand = $brand . '-' . $_POST['brand' . $i];
      } else
        break;
    }



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

    $unit_problem = $_POST['unit_problem'];


    for ($i = 0; $i < 999; $i++) {
      if (isset($_POST['unit_problem' . $i])) {
        $unit_problem = $unit_problem . '-' . $_POST['unit_problem' . $i];
      } else
        break;
    }

    $unit_operational = $_POST['unit_operational'];

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

    // Begin transaction
    // mysqli_begin_transaction($conn);

    // Insert data into submit_requests table
    $sql = "INSERT INTO submit_requests (
    sort_value,
    requestor,
    date_of_request,
    mobile_or_phone_no,
    address,
    business_unit,
    cust_project_name,
    model,
    brand,
    type_of_request,
    additional_option,
    other_service_request,
    unit_problem,
    unit_operational,
    user_id
)
VALUES (
    '$sort_value',
    '$requestor',
    '$date_of_request',
    '$mobile_or_phone_no',
    '$address',
    '$business_unit',
    '$cust_project_name',
    '$model',
    '$brand',
    '$type_of_request',
    '$additional_option',
    '$other_service_request',
    '$unit_problem',
    '$unit_operational',
    '$userID'
)";

    if (!mysqli_query($conn, $sql)) {
      mysqli_rollback($conn);
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      return;
    }

    // Get the ID of the newly inserted row
    $request_ID = mysqli_insert_id($conn);

    // Insert data into service_request_status table
    $statusSql = "INSERT INTO service_request_status (SERVICE_REQUEST_ID, STATUS_VALUE) VALUES ('$request_ID', 'Pending') ON DUPLICATE KEY UPDATE STATUS_VALUE='Pending'";
    if (!mysqli_query($conn, $statusSql)) {
      mysqli_rollback($conn);
      echo "Error: " . $statusSql . "<br>" . mysqli_error($conn);
      return;
    }

    // Commit transaction
    mysqli_commit($conn);

    mysqli_close($conn);

    // Display success message
  ?>
    <script>
      swal.fire({
        icon: 'success',
        title: 'Service Request Submitted Successfully',
        html: 'Service Request ID: <b><?php echo $request_ID ?></b>',
        showConfirmButton: false,
        timer: 1500,
      }).then(function() {
        window.location = "dashboard.php";
        exit();
      });
    </script>


  <?php
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleFormSubmission();
  }

  ?>