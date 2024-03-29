<?php
// [IMPORTANT!] Define database connection parameters once for this file
include_once('includes/connection.php');
?>

<?php

// Logout logic
if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: admin_login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/bootstrap.css">
  <link rel="stylesheet" href="Styles/style.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <title>Service Request | Repair and Maintence Management System</title>
</head>

<body>
  <div class="loader">
    <div class="custom-loader"></div>
  </div>

  <!-- SIDEBAR -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- SIDEBAR -->

  <!-- Content -->
  <section id="content">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>
    <!-- End of Navbar -->

    <!-- Start of 1st column -->

    <div class="col-sm-4">
      <?php

      $sql = "SELECT * FROM `submit_requests`  \n"
        . "ORDER BY `submit_requests`.`sort_value` ASC;";


      $result = $conn->query($sql);


      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="card mt-2 mx-2 mb-15">';
          echo '<div class="card-header">';
          echo 'Request ID: ' . $row['SERVICE_REQUEST_ID'];
          echo '</div>';
          echo '<div class="card-body">';
          echo '<div class="row">';
          echo '<div class="col-md-8">';
          echo '<h5 class="card-title">Request Info: ' . $row['requestor'] . '</h5>';
          echo '<p class="card-text">' . $row['business_unit'] . '</p>';
          echo '<p class="card-text">Request Date: ' . $row['date_of_request'] . '</p>';
          echo '</div>';
          echo '<div class="col-md-4 text-right">';
          echo '<form action="" method="POST">';
          echo '<input type="hidden" name="id" value=' . $row["SERVICE_REQUEST_ID"] . '>';
          echo '<button class="btn btn-danger view-bot" 
        onclick="fillForm(' . $row["SERVICE_REQUEST_ID"] . ', \''
            . $row["requestor"] . '\', \''
            . $row["date_of_request"] . '\', \''
            . $row["mobile_or_phone_no"] . '\', \''
            . $row["business_unit"] . '\', \''
            . $row["cust_project_name"] . '\', \''
            . $row["asset_code"] . '\', \''
            . $row["model"] . '\', \''
            . $row["serial_no"] . '\', \''
            . $row["equip_desc"] . '\', \''
            . $row["brand"] . '\', \''
            . $row["service_meter_reading"] . '\', \''
            . $row["type_of_request"] . '\', \''
            . $row["additional_option"] . '\', \''
            . $row["charging"] . '\', \''
            . $row["unit_problem"] . '\', \''
            . $row["others"] . '\', \''
            . $row["unit_operational"] . '\', \''
            . $row["specific_requirement"] . '\', \''
            . $row["onsite_contact_person"] . '\', \''
            . $row["fax_no"] . '\')">
          VIEW</button>';
          echo '<button class="btn btn-secondary close-bot" type="button"
          onclick="closeRequest(' . $row["SERVICE_REQUEST_ID"] . ')">CLOSED</button>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      }
      if (isset($_REQUEST['close'])) {
        $sql = "DELETE FROM submit_requests WHERE SERVICE_REQUEST_ID = {$_REQUEST['SERVICE_REQUEST_ID']}";
        if ($conn->query($sql) === TRUE) {

          echo "Record Deleted Successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      }
      ?>
    </div>
    <!-- End of 1st column -->



    <!-- Start of assigned column -->
    <div class="col-sm-5 mt-5 jumbotron">
      <form action="" method="POST">
        <h5 class="text-center">Assign Work Order Request</h5>
        <div class="form-group">
          <label for="SERVICE_REQUEST_ID">REQUEST ID</label>
          <input type="text" class="form-control" id="SERVICE_REQUEST_ID" name="SERVICE_REQUEST_ID" readonly>
        </div>
        <div class="form-group">
          <label for="requestor">REQUESTER</label>
          <input type="text" class="form-control" id="requestor" name="requestor">
        </div>
        <div class="form-group">
          <label for="business_unit">BUSINESS UNIT</label>
          <input type="text" class="form-control" id="business_unit" name="business_unit">
        </div>
        <div class="form-group">
          <label for="date_of_request">DATE OF REQUEST</label>
          <input type="text" class="form-control" id="date_of_request" name="date_of_request">
        </div>
        <div class="form-group col -md-6">
          <label for="mobile_or_phone_no">MOBILE/PHONE NO.</label>
          <input type="text" class="form-control" id="mobile_or_phone_no" name="mobile_or_phone_no">
        </div>
        <div class="form-group">
          <label for="address">ADDRESS</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-row">
          <div class="form-group col -md-6">
            <label for="cust_project_name">CUST./PROJECT NAME</label>
            <input type="text" class="form-control" id="cust_project_name" name="cust_project_name">
          </div>
          <div class="form-group col -md-6">
            <label for="asset_code">ASSET CODE</label>
            <input type="text" class="form-control" id="asset_code" name="asset_code">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col -md-4">
            <label for="model">MODEL</label>
            <input type="text" class="form-control" id="model" name="model">
          </div>
          <div class="form-group col -md-4">
            <label for="serial_no">SERIAL NO.</label>
            <input type="text" class="form-control" id="serial_no" name="serial_no">
          </div>
          <div class="form-group col -md-4">
            <label for="equip_desc">EQUIP DESC</label>
            <input type="text" class="form-control" id="equip_desc" name="equip_desc">
          </div>
          <div class="form-row">
            <div class="form-group col -md-8">
              <label for="brand">BRAND</label>
              <input type="text" class="form-control" id="brand" name="brand">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col -md-6">
              <label for="service_meter_reading">SERVICE METER READING</label>
              <input type="text" class="form-control" id="service_meter_reading" name="service_meter_reading">
            </div>
            <div class="form-group col -md-6">
              <label for="type_of_request">TYPE OF REQUEST</label>
              <input type="text" class="form-control" id="type_of_request" name="type_of_request">
            </div>
            <div class="form-group col -md-6">
              <label for="additional_option">ADDITONAL OPTION</label>
              <input type="text" class="form-control" id="additional_option" name="additional_option">
            </div>
            <div class="form-group col -md-6">
              <label for="other_service_request">OTHER SERVICE REQUEST</label>
              <input type="text" class="form-control" id="other_service_request" name="other_service_request">
            </div>
            <div class="form-group col -md-6">
              <label for="charging">CHARGING</label>
              <input type="text" class="form-control" id="charging" name="charging">
            </div>
            <div class="form-group col -md-6">
              <label for="unit_problem">UNIT PROBLEM</label>
              <input type="text" class="form-control" id="unit_problem" name="unit_problem">
            </div>
            <div class="form-group col -md-6">
              <label for="others">OTHERS</label>
              <input type="text" class="form-control" id="others" name="others">
            </div>
            <div class="form-group col -md-6">
              <label for="unit_operational">UNIT OPERATIONAL</label>
              <input type="text" class="form-control" id="unit_operational" name="unit_operational">
            </div>
            <div class="form-group col -md-6">
              <label for="specific_requirement">SPECIFIC REQUIREMENT</label>
              <input type="text" class="form-control" id="specific_requirement" name="specific_requirement">
            </div>
            <div class="form-group col -md-6">
              <label for="onsite_contact_person">ONSITE CONTACT PERSON</label>
              <input type="text" class="form-control" id="onsite_contact_person" name="onsite_contact_person">
            </div>
            <div class="form-group col -md-6">
              <label for="fax_no">FAX NO.</label>
              <input type="text" class="form-control" id="fax_no" name="fax_no">
            </div>
            <div class="form-group col -md-6">
              <label for="assignDate">ASSIGN TO</label>
              <input type="text" class="form-control" id="assignDate" name="assignDate">
              <!-- <select name="" id="">
                <option value="Emergency Call">Emergency Call (Waver Required)</option>
                <option value="Other">Other</option>
              </select> -->
            </div>
            <div class="form-group col -md-6">
              <label for="assignDate">ASSIGN DATE</label>
              <input type="text" class="form-control" id="assignDate" name="assignDate">
            </div>
          </div>
          <div class="float-right">
            <form action="assign_request.php" method="POST">
              <button type="submit" class="btn btn-success" name="assign">Assign</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
      </form>
    </div>


    <!-- End Assigned Work column -->


    <style>
      /* Start of 1st column */

      .col-sm-4 {
        display: inline-block;
        vertical-align: top;
        width: 400px;
      }

      .col-md-4 {
        text-align: right;
      }

      .view-bot {
        background-color: #f02e24;
        color: white;
        padding: 0.5rem 15px;
        margin-right: 10px;
        margin-bottom: 20px;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        cursor: pointer;
      }

      .view-bot:hover {
        background-color: #D17976;
      }


      .close-bot {
        background-color: #201E1E;
        color: white;
        margin-right: 10px;
        padding: 3px 15px;
        font-size: 10px;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
      }

      .close-bot:hover {
        background-color: #605655;
      }


      .card {
        margin: 2rem 2rem 1rem 2rem;
        border: 1px solid #ABAFB0;
        border-radius: 10px;
      }

      .card-body {
        padding: 0.5rem;
        background-color: #f9f9f9;
      }

      .card-header {
        background-color: #f02e24;
        color: white;
        padding: 0.5rem;
        border-radius: 10px 10px 0 0;

      }

      .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
      }

      .card-text {
        margin-bottom: 1rem;
      }



      /* Start of Assigned work order CSS */


      .col-sm-5 {
        float: right;
        width: 60%;
        box-sizing: border-box;
        margin: 2rem 1rem 0rem 0rem;
      }

      .jumbotron {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

      }

      .jumbotron h5 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
        font-size: 25px;
        color: #000000;
      }


      .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        border-radius: 5px;
      }



      .form-group {
        margin-bottom: 5px;
      }

      label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;

      }


      input[type="text"],
      input[type="email"],
      input[type="password"],
      select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;

      }

      .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;

      }


      .float-right {
        text-align: right;

      }


      .btn-success {
        background-color: #f02e24;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-right: 10px;
        margin-bottom: 50%;
        border-radius: 5px;
        cursor: pointer;

      }

      .btn-success:hover {
        background-color: #D17976;
      }

      .btn-secondary {
        background-color: #201E1E;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
      }

      .btn-secondary:hover {
        background-color: #605655;
      }
    </style>


    <script>
      function fillForm(requestId, requester, requestDate, contactNumber, business_Unit,
        projectName, asset_Code, requesterModel, serialNumber, equip_Desc, requestBrand,
        service_meter, requestType, additional_Option, requestCharging,
        unit_Problem, Others, unit_Operational, specific_Requirement, onsiteContact, faxNumber) {
        event.preventDefault(); // Prevent default form submission
        document.getElementById('SERVICE_REQUEST_ID').value = requestId;
        document.getElementById('requestor').value = requester;
        document.getElementById('date_of_request').value = requestDate;
        document.getElementById('mobile_or_phone_no').value = contactNumber;
        document.getElementById('business_unit').value = business_Unit;
        document.getElementById('cust_project_name').value = projectName;
        document.getElementById('asset_code').value = asset_Code;
        document.getElementById('model').value = requesterModel;
        document.getElementById('serial_no').value = serialNumber;
        document.getElementById('equip_desc').value = equip_Desc;
        document.getElementById('brand').value = requestBrand;
        document.getElementById('service_meter_reading').value = service_meter;
        document.getElementById('type_of_request').value = requestType;
        document.getElementById('additional_option').value = additional_Option;
        document.getElementById('charging').value = requestCharging;
        document.getElementById('unit_problem').value = unit_Problem;
        document.getElementById('others').value = Others;
        document.getElementById('unit_operational').value = unit_Operational;
        document.getElementById('specific_requirement').value = specific_Requirement;
        document.getElementById('onsite_contact_person').value = onsiteContact;
        document.getElementById('fax_no').value = faxNumber;
      }

      function closeRequest(requestId) {
        if (confirm("Are you sure you want to close this request?")) {
          // Send an AJAX request to delete the request
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "close_request.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
              // Handle the response here, e.g., show a success message
              alert(xhr.responseText);
              // Reload the page or perform any other necessary actions
              location.reload();
            }
          };
          xhr.send("SERVICE_REQUEST_ID=" + requestId);
        }
      }
    </script>






    <!-- End of Content -->
  </section>
  <script src="js/script.js"></script>
  <script src="js/preloader.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script>
    // add an active list on the side bar when this page is loaded
    const dashboard = document.querySelector(".side-menu li:nth-child(2)");
    dashboard.classList.add("active");
  </script>
</body>

</html>