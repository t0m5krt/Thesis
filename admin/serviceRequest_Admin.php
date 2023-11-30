<?php
define('PAGE', 'Service Requests | Admin');

// [IMPORTANT!] Define database connection parameters once for this file
include_once('includes/connection.php');
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Styles/style.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Add these lines in the <head> section of your HTML -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <title><?php echo PAGE ?></title>

  <style>
    .sort-container {
      width: 100%;
    }

    .critical-high {
      color: red;
    }

    .high {
      color: orange;
    }

    .mid {
      color: darkgoldenrod;
    }

    .low {
      color: green;
    }

    /* Start of 1st column */

    .col-sm-4 {
      display: inline-block;
      vertical-align: top;
      width: 50%;
      box-sizing: border-box;

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
      width: 50%;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      margin-top: 2rem;
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
      font-weight: 500;

    }


    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-family: "Poppins", sans-serif;

    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;

    }


    .float-right {
      text-align: right;
    }

    .float-left {
      margin: 2rem 0;
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

    .input-search {
      max-width: 250px;
      background-color: #f5f5f5;
      color: #242424;
      padding: .15rem .5rem;
      min-height: 40px;
      border-radius: 4px;
      outline: none;
      border: none;
      line-height: 1.15;
      box-shadow: 0px 10px 20px -18px;
      margin: 0 0 0 2rem;
    }

    input-search:focus {
      border-bottom: 2px solid #5b5fc7;
      border-radius: 4px 4px 2px 2px;
    }

    input-search:hover {
      outline: 1px solid lightgrey;
    }
        
    #assignColumn {
    display: none;
  }
  .modal-dialog{
    max-width: 750px;
  }

  
  </style>
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

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Service Request</h1>
        </div>
      </div>



      <form action="" method="post">
        <div class="radio-inputs">
          <label class="radio">
            <input type="radio" name="sort" value="ByID" onchange="this.form.submit();">
            <span class="name">Sort By: Default</span>
          </label>
          <label class="radio">
            <input type="radio" name="sort" value="sortValue" onchange="this.form.submit();">
            <span class="name">Sort By: Priority</span>
          </label>
          <label class="radio">
            <input type="radio" name="sort" value="dateRequest" onchange="this.form.submit();">
            <span class="name">Sort By: Date</span>
          </label>
        </div>
      </form>
      </div>





      <!-- Start of 1st column -->

      <table class="table">
        <thead>
          <tr>
            <th>Request ID</th>
            <th>Equipment No.</th>
            <th>Priority Level</th>
            <th>Type of Request</th>
            <th>Request Date</th>
            <!-- Add more columns as needed -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php

        // Define the mapSortValueToString function
        function mapSortValueToString($sortValue)
        {
          switch ($sortValue) {
            case 1:
              return '<span class="critical-high">Critical High</span>';
            case 2:
              return '<span class="high">High</span>';
            case 3:
              return '<span class="mid">Mid</span>';
            case 4:
              return '<span class="low">Low</span>';
            default:
              return 'Unknown'; // Handle any unexpected values
          }
        }
        // $_POST['sort'] = '';
        if (isset($_POST['sort'])) {
          $sortOption = $_POST['sort'];
        } else
          $sortOption = 'ByID';
        // Modify the SQL query based on the selected sorting option
        switch ($sortOption) {
          case 'sortValue':
            $sql = "SELECT DISTINCT a.*
              FROM `submit_requests` AS a
              JOIN service_request_status AS b
              WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
              ORDER BY a.sort_value ASC;";
            break;
          case 'dateRequest':
            $sql = "SELECT DISTINCT a.*
              FROM `submit_requests` AS a
              JOIN service_request_status AS b
              WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
              ORDER BY a.date_of_request ASC;";
            break;
          case 'ByID':
            $sql = "SELECT DISTINCT a.*
              FROM `submit_requests` AS a
              JOIN service_request_status AS b
              WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
              ORDER BY a.SERVICE_REQUEST_ID ASC;";
            break;
          default:
            $sql = "SELECT DISTINCT a.*
              FROM `submit_requests` AS a
              JOIN service_request_status AS b
              WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
              ORDER BY a.sort_value ASC;";
            break;
        }

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['SERVICE_REQUEST_ID'] . '</td>';
          echo '<td>' . $row['asset_code'] . '</td>';
          echo '<td>' . mapSortValueToString($row['sort_value']) . '</td>';
          echo '<td>' . $row['type_of_request'] . '</td>';
          echo '<td>' . $row['date_of_request'] . '</td>';
          // Add more columns as needed
          echo '<td>';
          echo '<form action="" method="POST">';
          echo '<input type="hidden" name="id" value=' . $row["SERVICE_REQUEST_ID"] . '>';
          echo '<button class="btn btn-danger view-bot" data-toggle="modal" data-target="#assignModal"
  onclick="fillAssignModal(' . $row["SERVICE_REQUEST_ID"] . ', \''
            . $row["requestor"] . '\', \''
            . $row["date_of_request"] . '\', \''
            . $row["mobile_or_phone_no"] . '\', \''
            . $row["address"] . '\', \''
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
            VIEW
          </button>';
          echo '</form>';
          echo '</td>';
          echo '</tr>';
        }
      
      ?>
    </tbody>
  </table>
      <!-- End of 1st column -->



      <!-- Start of assigned column -->
      <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignModalLabel">Assign Work Order Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="SERVICE_REQUEST_ID">REQUEST ID</label>
            <input type="text" class="form-control" id="SERVICE_REQUEST_ID" name="SERVICE_REQUEST_ID" readonly>
          </div>
          <div class="form-row">
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
            <div class="form-group col -md-6">
              <label for="cust_project_name">CUST./PROJECT NAME</label>
              <input type="text" class="form-control" id="cust_project_name" name="cust_project_name">
            </div>
            <div class="form-group">
              <label for="asset_code">ASSET CODE</label>
              <input type="text" class="form-control" id="asset_code" name="asset_code">
            </div>
            <div class="form-group">
              <label for="model">MODEL</label>
              <input type="text" class="form-control" id="model" name="model">
            </div>
            <div class="form-group">
              <label for="serial_no">SERIAL NO.</label>
              <input type="text" class="form-control" id="serial_no" name="serial_no">
            </div>
            <div class="form-group">
              <label for="equip_desc">EQUIP DESC</label>
              <input type="text" class="form-control" id="equip_desc" name="equip_desc">
            </div>
            <div class="form-group col -md-6">
              <label for="brand">BRAND</label>
              <input type="text" class="form-control" id="brand" name="brand">
            </div>
            <div class="form-group">
              <label for="service_meter_reading">SERVICE METER READING</label>
              <input type="text" class="form-control" id="service_meter_reading" name="service_meter_reading">
            </div>
            <div class="form-group">
              <label for="type_of_request">TYPE OF REQUEST</label>
              <input type="text" class="form-control" id="type_of_request" name="type_of_request">
            </div>
            <div class="form-group">
              <label for="additional_option">ADDITONAL OPTION</label>
              <input type="text" class="form-control" id="additional_option" name="additional_option">
            </div>
            <div class="form-group">
              <label for="other_service_request">OTHER SERVICE REQUEST</label>
              <input type="text" class="form-control" id="other_service_request" name="other_service_request">
            </div>
            <div class="form-group">
              <label for="charging">CHARGING</label>
              <input type="text" class="form-control" id="charging" name="charging">
            </div>
            <div class="form-group">
              <label for="unit_problem">UNIT PROBLEM</label>
              <input type="text" class="form-control" id="unit_problem" name="unit_problem">
            </div>
            <div class="form-group">
              <label for="others">OTHERS</label>
              <input type="text" class="form-control" id="others" name="others">
            </div>
            <div class="form-group">
              <label for="unit_operational">UNIT OPERATIONAL</label>
              <input type="text" class="form-control" id="unit_operational" name="unit_operational">
            </div>
            <div class="form-group">
              <label for="specific_requirement">SPECIFIC REQUIREMENT</label>
              <input type="text" class="form-control" id="specific_requirement" name="specific_requirement">
            </div>
            <div class="form-group">
              <label for="onsite_contact_person">ONSITE CONTACT PERSON</label>
              <input type="text" class="form-control" id="onsite_contact_person" name="onsite_contact_person">
            </div>
            <div class="form-group col -md-6">
              <label for="fax_no">FAX NO.</label>
              <input type="text" class="form-control" id="fax_no" name="fax_no">
            </div>
            <div class="form-group col -md-6">
              <label for="assign_tech">ASSIGN TO</label>
              <select class="form-control" id="assign_tech" name="assign_tech">
                <?php
                $query = "SELECT REGISTRATION_ID, CONCAT(firstname, ' ', lastname) as NAME, availability FROM office_accounts WHERE account_type = 'employee'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $registrationId = $row['REGISTRATION_ID'];
                    $availability = $row['availability'];
                    $employeeName = $row['NAME'];

                    // Modify this condition based on your availability status logic
                    if ($availability === 'Available') {
                      echo "<option value='$registrationId'>$employeeName (Available)</option>";
                    } else {
                      echo "<option value='$registrationId' disabled>$employeeName (Not Available)</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label for="assignDate">ASSIGN DATE</label>
              <input type="date" class="form-control" id="assignDate" name="assignDate" min="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <div class="float-left">
            <button type="submit" class="btn btn-success" id="assignBtn" name="assign">Assign</button>
          </div>
        </form>
      </div>

      <!-- End Assigned Work column -->


      <script>
        function fillAssignModal(requestId, requester, requestDate, contactNumber, Address, business_Unit,
          projectName, asset_Code, requesterModel, serialNumber, equip_Desc, requestBrand,
          service_meter, requestType, additional_Option, requestCharging,
          unit_Problem, Others, unit_Operational, specific_Requirement, onsiteContact, faxNumber) {
          event.preventDefault(); // Prevent default form submission
          document.getElementById('SERVICE_REQUEST_ID').value = requestId;
          document.getElementById('requestor').value = requester;
          document.getElementById('date_of_request').value = requestDate;
          document.getElementById('mobile_or_phone_no').value = contactNumber;
          document.getElementById('address').value = Address;
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

          document.getElementById("formTitle").scrollIntoView({
            behavior: 'smooth'
          });

          function responsiveNavbar() {
    var x = document.getElementById("myNavbar");
    // Add the logic for responsiveNavbar function as needed
  }

        }
      </script>
    </main>

    <!-- End of Content -->
  </section>
  <!-- End of Content -->
  <script src="js/script.js"></script>
  <script src="js/preloader.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script>
    // add an active list on the side bar when this page is loaded
    const dashboard = document.querySelector(".side-menu li:nth-child(2)");
    dashboard.classList.add("active");

    // JavaScript code to update the selected radio button based on the current sorting option
    document.addEventListener("DOMContentLoaded", function() {
      var selectedSort = "<?php echo $sortOption; ?>";
      var radioButtons = document.querySelectorAll('input[name="sort"]');
      for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].value === selectedSort) {
          radioButtons[i].checked = true;
          break;
        }
      }
    });

    document.getElementById("assignBtn").onclick = function() {
      Swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to assign?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No"
      }).then((result) => {
        if (result.isConfirmed) {
          var form = document.getElementById("assignForm");
          var inputs = form.getElementsByTagName("input");
          var empty = false;
          var missingFields = [];

          for (var i = 0; i < inputs.length; i++) {
            // Exclude specific fields from the check
            if (inputs[i].value === "" && inputs[i].id !== "additional_option" && inputs[i].id !== "other_service_request") {
              empty = true;
              missingFields.push(inputs[i].id);
            }
          }

          if (empty) {
            Swal.fire({
              title: "Missing Fields",
              text: "Please fill in all the required fields: " + missingFields.join(", "),
              icon: "warning"
            });
          } else {
            form.submit();
          }
        }
      });
    };
  </script>
</body>

</html>


<!-- Test Query -->

<?php
include 'includes/connection.php';
if (isset($_REQUEST['assign'])) {

  $SERVICE_REQUEST_ID = $_POST['SERVICE_REQUEST_ID'];
  $requestor = $_POST['requestor'];
  $date_of_request = $_POST['date_of_request'];
  $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
  $assign_tech_id = $_POST['assign_tech']; // Assuming assign_tech is the registration ID

  // Retrieve the firstname and lastname of the assigned technician
  $queryTechInfo = "SELECT firstname, lastname FROM office_accounts WHERE REGISTRATION_ID = '$assign_tech_id'";
  $resultTechInfo = $conn->query($queryTechInfo);

  if ($resultTechInfo->num_rows > 0) {
    $rowTechInfo = $resultTechInfo->fetch_assoc();
    $assign_tech_name = $rowTechInfo['firstname'] . ' ' . $rowTechInfo['lastname'];

    // Insert into the work_order table
    $sql = "INSERT INTO work_order (SERVICE_REQUEST_ID, requestor, date_of_request, mobile_or_phone_no, assign_tech, assign_date)
            VALUES ('$SERVICE_REQUEST_ID', '$requestor', '$date_of_request', '$mobile_or_phone_no', '$assign_tech_name', '$assign_date')";

    // Update service_request_status
    $sqlServiceRequest = "UPDATE submit_requests, service_request_status 
                        SET submit_requests.isDelete = 1, service_request_status.STATUS_VALUE = 'In Progress' 
                        WHERE submit_requests.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID'
                        AND service_request_status.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID';";

    // Update availability in office_accounts
    $sqlUpdateAvailability = "UPDATE office_accounts 
                              SET availability = 'Not Available' 
                              WHERE REGISTRATION_ID = '$assign_tech_id'";

    if (
      $conn->query($sql) === TRUE &&
      $conn->query($sqlServiceRequest) === TRUE &&
      $conn->query($sqlUpdateAvailability) === TRUE
    ) {
      // Your success handling code here
?>
      <script>
        alert('Assigning Successful');
        window.location = "workOrder_Admin.php";
        exit();
      </script>
    <?php

    } else {
      // Handle the case where the queries failed
    ?>
      <script>
        alert('Assigning Failed');
        window.location = "serviceRequest_Admin.php";
        exit();
      </script>

    <?php

    }
  } else {
    // Handle the case where the technician information couldn't be retrieved

    // Insert into the work_order table
    $sql = "INSERT INTO work_order (SERVICE_REQUEST_ID, requestor, date_of_request, mobile_or_phone_no, assign_tech, assign_date)
            VALUES ('$SERVICE_REQUEST_ID', '$requestor', '$date_of_request', '$mobile_or_phone_no', '$assign_tech_id', '$assign_date')";
    // Update service_request_status
    $sqlServiceRequest = "UPDATE submit_requests, service_request_status 
                        SET submit_requests.isDelete = 1, service_request_status.STATUS_VALUE = 'In Progress' 
                        WHERE submit_requests.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID'
                        AND service_request_status.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID';";
    if ($conn->query($sql) === TRUE && $conn->query($sqlServiceRequest) === TRUE) {
      // Your success handling code here
    ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Assigning Successful',
          showConfirmButton: true,
        }).then(function() {
          window.location = "workOrder_Admin.php";
          exit();
        });
      </script>
    <?php

    } else {
      // Handle the case where the queries failed
    ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Assigning Failed',
          showConfirmButton: true,
        }).then(function() {
          window.location = "serviceRequest_Admin.php";
          exit();
        });
      </script>
<?php

    }
  }
}
?>