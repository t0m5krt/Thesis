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
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Add these lines in the <head> section of your HTML -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="Styles/style.css" />

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

    .filteringContainer {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    #assignColumn {
      display: none;
    }

    .modal-dialog {
      max-width: 750px;
    }

    .modal-body {
      max-height: calc(100vh - 150px);
      overflow-y: auto;
    }

    .search {
      display: flex;
      align-items: center;
      justify-content: space-between;
      text-align: center;
    }

    .search__input {
      font-family: inherit;
      font-size: inherit;
      background-color: #f4f2f2;
      border: none;
      color: #646464;
      padding: 0.7rem 1rem;
      border-radius: 30px;
      width: 12em;
      transition: all ease-in-out .5s;
      margin-right: -2rem;
    }

    .search__input:hover,
    .search__input:focus {
      box-shadow: 0 0 1em #00000013;
    }

    .search__input:focus {
      outline: none;
      background-color: #f0eeee;
    }

    .search__input::-webkit-input-placeholder {
      font-weight: 100;
      color: #ccc;
    }

    .search__input:focus+.search__button {
      background-color: #f0eeee;
    }

    .search__button {
      border: none;
      background-color: #f4f2f2;
      margin-top: .1em;
    }

    .search__button:hover {
      cursor: pointer;
    }

    .search__icon {
      height: 1.3em;
      width: 1.3em;
      fill: #b4b4b4;
    }
  </style>
</head>

<body onload="performSearchAndSort()">
  <!-- <div class="loader">
    <div class="custom-loader"></div>
  </div> -->

  <!-- SIDEBAR -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- SIDEBAR -->


  <!-- Content -->
  <section id="content">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>
    <!-- End of Navbar -->
    <?php
    function displayTableRow($row)
    {
      $a = $row['SERVICE_REQUEST_ID'];

      echo '<tr>';
      echo '<td>' . $a . '</td>';
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
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Service Request</h1>
        </div>
      </div>


      <div class="filteringContainer">
        <form action="" method="post">
          <div class="radio-inputs">
            <label class="radio">
              <input type="radio" name="sortarray" value="RequestID" checked>
              <span class="name">Sort By: Default</span>
            </label>
            <label class="radio">
              <input type="radio" name="sortarray" value="sortValue">
              <span class="name">Sort By: Priority</span>
            </label>
            <label class="radio">
              <input type="radio" name="sortarray" value="dateRequest">
              <span class="name">Sort By: Date</span>
            </label>
          </div>
        </form>

        <form action="serviceRequest_Admin.php" method="get">
          <div class="search">
            <input type="text" class="search__input" id="search_inputid" placeholder="Type your text" oninput="showSearchInput(this.value)">
            <button class="search__button">
              <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                  <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
              </svg>
            </button>
          </div>
        </form>
      </div>





      <div id="searchResult"></div>

      <!-- Start of 1st column -->

      <!-- <table class="table">
        <thead>
          <tr>
            <th>Request ID</th>
            <th>Equipment No.</th>
            <th>Priority Level</th>
            <th>Type of Request</th>
            <th>Request Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          // $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

          // $records_per_page = 10;

          // $start_from = ($page - 1) * $records_per_page;

          // // Define the mapSortValueToString function
          // function mapSortValueToString($sortValue)
          // {
          //   switch ($sortValue) {
          //     case 1:
          //       return '<span class="critical-high">Critical High</span>';
          //     case 2:
          //       return '<span class="high">High</span>';
          //     case 3:
          //       return '<span class="mid">Mid</span>';
          //     case 4:
          //       return '<span class="low">Low</span>';
          //     default:
          //       return 'Unknown'; // Handle any unexpected values
          //   }
          // }
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

          // // Check if the search suggestions parameter is set
          // $searchSuggestions = isset($_GET['searchSuggestions']) ? $_GET['searchSuggestions'] : '';

          // if ($searchSuggestions) {
          //   // Handle search suggestions logic here
          //   // Fetch and echo the suggestions based on the provided search term ($_GET['q'])
          //   // Ensure proper validation and sanitation to prevent SQL injection
          //   $searchTerm = mysqli_real_escape_string($conn, $_GET['q']);

          //   // Your search suggestions query logic here...
          //   // Example:
          //   $suggestionsQuery = "SELECT DISTINCT a.*
          //   FROM `submit_requests` AS a
          //   JOIN service_request_status AS b
          //   WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0 AND (a.SERVICE_REQUEST_ID LIKE '%$searchTerm%' OR a.date_of_request LIKE '%$searchTerm%' OR b.STATUS_VALUE LIKE '%$searchTerm%')
          //   ORDER BY a.sort_value ASC;";



          //   $suggestionsResult = $conn->query($suggestionsQuery);

          //   while ($row = mysqli_fetch_array($suggestionsResult)) {
          //     displayTableRow($row);
          //   }

          //   // Exit to prevent other parts of the page from being executed
          //   exit();
          // }

          // // Execute the main SQL query
          // $result = $conn->query($sql);

          // // Fetch and display the main results
          // while ($row = mysqli_fetch_array($result)) {
          //   displayTableRow($row);
          // }


          // $result = $conn->query($sql);

          // while ($row = $result->fetch_assoc()) {
          //   echo '<tr>';
          //   echo '<td>' . $row['SERVICE_REQUEST_ID'] . '</td>';
          //   echo '<td>' . $row['asset_code'] . '</td>';
          //   echo '<td>' . mapSortValueToString($row['sort_value']) . '</td>';
          //   echo '<td>' . $row['type_of_request'] . '</td>';
          //   echo '<td>' . $row['date_of_request'] . '</td>';
          //   // Add more columns as needed
          //   echo '<td>';
          //   echo '<form action="" method="POST">';
          //   echo '<input type="hidden" name="id" value=' . $row["SERVICE_REQUEST_ID"] . '>';
          //   echo '<button class="btn btn-danger view-bot" data-toggle="modal" data-target="#assignModal"
          // onclick="fillAssignModal(' . $row["SERVICE_REQUEST_ID"] . ', \''
          //     . $row["requestor"] . '\', \''
          //     . $row["date_of_request"] . '\', \''
          //     . $row["mobile_or_phone_no"] . '\', \''
          //     . $row["address"] . '\', \''
          //     . $row["business_unit"] . '\', \''
          //     . $row["cust_project_name"] . '\', \''
          //     . $row["asset_code"] . '\', \''
          //     . $row["model"] . '\', \''
          //     . $row["serial_no"] . '\', \''
          //     . $row["equip_desc"] . '\', \''
          //     . $row["brand"] . '\', \''
          //     . $row["service_meter_reading"] . '\', \''
          //     . $row["type_of_request"] . '\', \''
          //     . $row["additional_option"] . '\', \''
          //     . $row["charging"] . '\', \''
          //     . $row["unit_problem"] . '\', \''
          //     . $row["others"] . '\', \''
          //     . $row["unit_operational"] . '\', \''
          //     . $row["specific_requirement"] . '\', \''
          //     . $row["onsite_contact_person"] . '\', \''
          //     . $row["fax_no"] . '\')">
          //           VIEW
          //         </button>';
          //   echo '</form>';
          //   echo '</td>';
          //   echo '</tr>';
          // }


          ?>
        </tbody>
        <div id="suggestionBox"></div>
      </table> -->
      <!-- End of 1st column -->

      <!-- Start of Pagination -->
      <?php
      // $result = $conn->query("SELECT COUNT(*) FROM submit_requests WHERE isDelete = '0'");
      // $row = $result->fetch_row();
      // $total_records = $row[0];
      // $total_pages = ceil($total_records / $records_per_page);

      // if ($page > 1) {
      //   echo "<a href='serviceRequest_Admin.php?page=" . ($page - 1) . "'>Previous</a> ";
      // }

      // for ($i = 1; $i <= $total_pages; $i++) {
      //   echo "<a href='serviceRequest_Admin.php?page=" . $i . "'>" . $i . "</a> ";
      // }

      // if ($page < $total_pages) {
      //   echo "<a href='serviceRequest_Admin.php?page=" . ($page + 1) . "'>Next</a>";
      // }

      // // Check if the search parameter is set
      // $search = isset($_GET['search']) ? $_GET['search'] : '';

      // // Check if the search button is clicked
      // if (isset($_GET['searchBtn'])) {
      //   // Sanitize the search parameter to prevent SQL injection
      //   $search = mysqli_real_escape_string($conn, $search);

      //   // Construct the SQL query with the search parameter

      //   // SELECT a.SERVICE_REQUEST_ID, a.date_of_request, b.STATUS_VALUE 
      //   //         FROM submit_requests a
      //   //         JOIN service_request_status b ON a.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID 
      //   //         WHERE WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0 AND (a.SERVICE_REQUEST_ID LIKE '%$search%' OR a.date_of_request LIKE '%$search%' OR b.STATUS_VALUE LIKE '%$search%')
      //   //         GROUP BY a.SERVICE_REQUEST_ID, a.date_of_request, b.STATUS_VALUE

      //   $sql = "SELECT a.SERVICE_REQUEST_ID,
      //           a.date_of_request,
      //           b.STATUS_VALUE
      //           FROM submit_requests a
      //           JOIN service_request_status b ON a.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID
      //           WHERE a.SERVICE_REQUEST_ID IN ( SELECT SERVICE_REQUEST_ID FROM service_request_status)
      //           AND a.isDelete = 0
      //           AND (a.SERVICE_REQUEST_ID LIKE '%$search%')
      //           GROUP BY a.SERVICE_REQUEST_ID,
      //             a.date_of_request,
      //             b.STATUS_VALUE;";
      // } else {
      //   // Construct the default SQL query without the search parameter
      //   $sql = "SELECT a.SERVICE_REQUEST_ID, a.date_of_request, b.STATUS_VALUE 
      //           FROM submit_requests a
      //           JOIN service_request_status b ON a.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID 
      //           WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
      //           GROUP BY a.SERVICE_REQUEST_ID, a.date_of_request, b.STATUS_VALUE";
      // }

      // // Execute the SQL query
      // $result = $conn->query($sql);

      // // Fetch and display the results
      // while ($row = $result->fetch_assoc()) {
      //   // Display the table rows
      //   echo '<tr>';
      //   echo '<td>' . $row['SERVICE_REQUEST_ID'] . '</td>';
      //   echo '<td>' . $row['date_of_request'] . '</td>';
      //   echo '<td>' . $row['STATUS_VALUE'] . '</td>';
      //   echo '</tr>';
      // }



      // while ($suggestion = $suggestionsResult->fetch_assoc()) {
      //   echo '<div>' . $suggestion['COLUMN_NAME'] . '</div>';
      // }

      // Exit to prevent other parts of the page from being executed
      // exit();
      // }

      ?>


      <!-- End of Pagination -->



      <!-- Start of assigned column -->
      <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <form action="" method="post">


                <h5 class="modal-title text-center" id="assignModalLabel">Assign Work Order Request</h5>
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
                  <label for="requestor">REQUESTOR</label>
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
                  <input type="text" class="form-control" id="model" name="model" value="<?php echo "brand"; ?>">
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
                <div class="form-group col-md-6">
                  <label for="fax_no">CONTACT NO.</label>
                  <input type="text" class="form-control" id="fax_no" name="fax_no">
                </div>
                <div class="form-group col-md-6">
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

                <div class="form-group">
                  <label for="assign_team">Team</label>
                  <!-- Mechanic FieldSet -->
                  <fieldset>
                    <legend>Mechanics:</legend>
                    <select name="mechanic" id="mechanic">
                      <option value="" disabled>-- Select Mechanic --</option>
                      <?php
                      // Retrieve mechanics data from the database
                      $query = "SELECT * FROM employee_lists WHERE Employee_Position = 'Diesel Mechanic' AND Employee_Status != 'Not Available';";
                      $result = $conn->query($query);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $mechanicId = $row['Employee_ID'];
                          $mechanicName = $row['Employee_Name'];

                          // Check if the mechanic is selected
                          $selected = '';
                          if (isset($_POST['mechanic']) && $_POST['mechanic'] == $mechanicName) {
                            $selected = 'selected';
                          }

                          echo "<option value='$mechanicName' $selected>$mechanicName (Mechanic)</option>";
                        }
                      }
                      ?>
                    </select>
                  </fieldset>


                  <!-- Electrician FieldSet -->
                  <fieldset>
                    <legend>Electricians:</legend>
                    <select name="electrician" id="electrician">
                      <option value="" disabled>-- Select Electrician --</option>
                      <?php
                      // Retrieve electrician data from the database
                      $query = "SELECT *FROM employee_lists WHERE Employee_Position IN ('AUTO ELECTRICIAN', 'INDUSTRIAL ELECTRICIAN') AND Employee_Status != 'Not Available';";
                      $result = $conn->query($query);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $electricianId = $row['Employee_ID'];
                          $electricianName = $row['Employee_Name'];

                          // Check if the electrician is selected
                          $selected = '';
                          if (isset($_POST['electrician']) && $_POST['electrician'] == $electricianName) {
                            $selected = 'selected';
                          }

                          echo "<option value='$electricianName' $selected>$electricianName (Electrician)</option>";
                        }
                      }
                      ?>
                    </select>
                  </fieldset>


                  <!-- Driver FieldSet -->
                  <fieldset>
                    <legend>Driver:</legend>
                    <select id="driver" name="driver">
                      <option value="" disabled>-- Select Driver --</option>
                      <?php
                      // Retrieve driver data from the database
                      $query = "SELECT * FROM employee_lists WHERE Employee_Position = '6 WHEELER / 4 WHEELER TRUCK DRIVER' AND Employee_Status != 'Not Available';";
                      $result = $conn->query($query);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $driverId = $row['Employee_ID'];
                          $driverName = $row['Employee_Name'];

                          // Check if the driver is selected
                          $selected = '';
                          if (isset($_POST['driver']) && $_POST['driver'] == $driverName) {
                            $selected = 'selected';
                          }

                          echo "<option value='$driverName' $selected>$driverName (Driver)</option>";
                        }
                      }
                      ?>
                    </select>
                  </fieldset>
                </div>

                <div class="form-group col-md-6">
                  <label for="assignDate">ASSIGN DATE</label>
                  <input type="date" class="form-control" id="assignDate" name="assignDate" min="<?php echo date('Y-m-d'); ?>">
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
          // Get the form data
          var formData = new FormData(document.getElementById("assignForm"));

          // Append additional parameters as needed
          formData.append("assign", true);

          // Perform asynchronous request to your server
          fetch('serviceRequest_Admin.php', {
              method: 'POST',
              body: formData,
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                var techInfo = data.techInfo;

                // Access technician information if needed
                var firstname = techInfo.firstname;
                var lastname = techInfo.lastname;

                Swal.fire({
                  title: "Assigning Successful",
                  text: `Technician: ${firstname} ${lastname}`,
                  icon: "success"
                }).then(() => {
                  // Redirect or perform additional actions as needed
                  window.location = "workOrder_Admin.php";
                });
              } else {
                Swal.fire({
                  title: "Assigning Failed",
                  text: data.message || "An error occurred while assigning.",
                  icon: "error"
                });
              }
            })
            .catch(error => {
              console.error('Error:', error);
              Swal.fire({
                title: "Error",
                text: "An error occurred while processing your request.",
                icon: "error"
              });
            });
        }
      });
    };
  </script>
  <script>
    function sortingdatatable() {
      $(document).ready(function() {
        var table = $('#myTable').DataTable();

        $('input[name="sortarray"]').on('change', function() {
          var column = $(this).val();
          table.order([column, 'asc']).draw();
        });
      });
    }
  </script>

  <!-- Jquery for Search -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script onload="performSearchAndSort()">
    $(window).on("load", function() {
      // Load the table on page load

      function performSearchAndSort() {
        var input = $("#search_inputid").val();
        var sortOption = $('input[name="sortarray"]:checked').val();
        event.preventDefault();
        $.ajax({
          url: "livesearch.php",
          type: 'POST',
          data: {
            input: input,
            sortarray: sortOption
          },
          success: function(data) {

            $("#searchResult").html(data);
            $("#searchResult").css("display", "block");
          }
        });
      }

      // Trigger search and sort on keyup
      $("#search_inputid").keyup(function(event) {
        performSearchAndSort();
      });

      // Trigger search and sort on radio button change
      $('input[name="sortarray"]').change(function() {
        performSearchAndSort();
      });

      performSearchAndSort();




    });
  </script>
</body>

</html>

<!-- Test Query -->
<?php
include 'includes/connection.php';



if (isset($_REQUEST['assign'])) {
  if (isset($_POST['electrician']) && !empty($_POST['electrician'])) {
    $electricianName = $_POST['electrician'];
  } else {
    echo "Please select an electrician";
  }
  if (isset($_POST['mechanic']) && !empty($_POST['mechanic'])) {
    $mechanicName = $_POST['mechanic'];
  } else {
    echo "Please select an electrician";
  }
  if (isset($_POST['driver']) && !empty($_POST['driver'])) {
    $driverName = $_POST['driver'];
  } else {
    echo "Please select an electrician";
  }
  if (isset($_POST['assignDate']) && !empty($_POST['assignDate'])) {
    $assignDate = $_POST['assignDate'];
  } else {
    echo "Please select an electrician";
  }
  if (isset($_POST['assign_tech']) && !empty($_POST['assign_tech'])) {
    $assign_tech_id = $_POST['assign_tech'];
  } else {
    echo "Please select an electrician";
  }

  $SERVICE_REQUEST_ID = $_POST['SERVICE_REQUEST_ID'];
  $requestor = $_POST['requestor'];
  $date_of_request = $_POST['date_of_request'];
  $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
  $address = $_POST['address'];
  $business_unit = $_POST['business_unit'];
  $cust_project_name = $_POST['cust_project_name'];
  $asset_code = $_POST['asset_code'];
  $serial_no = $_POST['serial_no'];
  $equip_desc = $_POST['equip_desc'];
  $service_meter_reading = $_POST['service_meter_reading'];
  $charging = $_POST['charging'];
  $specific_requirement = $_POST['specific_requirement'];
  $onsite_contact_person = $_POST['onsite_contact_person'];
  $fax_no = $_POST['fax_no'];

  $assign_date = $_POST['assign_date'];
  $assign_tech_id = $_POST['assign_tech']; // Assuming assign_tech is the registration ID
  // Retrieve selected mechanics, electricians, and driver
  // $assignedMechanics = isset($_POST['mechanic']) ? implode(', ', $_POST['mechanic']) : '';
  // $assignedElectricians = isset($_POST['electrician']) ? implode(', ', $_POST['electrician']) : '';
  // $assignedDriver = isset($_POST['driver']) ? $_POST['driver'] : '';

  // Retrieve the firstname and lastname of the assigned technician
  $queryTechInfo = "SELECT firstname, lastname FROM office_accounts WHERE REGISTRATION_ID = '$assign_tech_id'";
  $resultTechInfo = $conn->query($queryTechInfo);

  if ($resultTechInfo->num_rows > 0) {
    $rowTechInfo = $resultTechInfo->fetch_assoc();
    $assign_tech_name = $rowTechInfo['firstname'] . ' ' . $rowTechInfo['lastname'];

    // Insert into the work_order table
    $sqlAssignTech = "INSERT INTO work_order (SERVICE_REQUEST_ID,date_of_request,assign_tech, assign_date, assigned_mechanics, assigned_electricians, assigned_driver, requestor, isDelete) 
    VALUES ('$SERVICE_REQUEST_ID','$date_of_request','$mobile_or_phone_no','$assign_tech_name', '$assignDate', '$mechanicName', '$electricianName', '$driverName', '$requestor', '0')";
    $resultSqlAssignTech = $conn->query($sqlAssignTech);

    // Update service_request_status
    $sqlServiceRequest = "UPDATE submit_requests, service_request_status 
                        SET submit_requests.isDelete = 1,
                            service_request_status.STATUS_VALUE = 'In Progress' , 
                            submit_requests.address = '$address',
                            submit_requests.asset_code = '$asset_code',
                            submit_requests.equip_desc ='$equip_desc',
                            submit_requests.service_meter_reading ='$service_meter_reading',
                            submit_requests.charging ='$charging',
                            submit_requests.specific_requirement ='$specific_requirement',
                            submit_requests.onsite_contact_person ='$onsite_contact_person'
                        WHERE submit_requests.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID'
                        AND service_request_status.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID'";

    $conn->query($sqlServiceRequest);

    // Update availability in office_accounts
    $sqlUpdateAvailability = "UPDATE office_accounts 
                              SET availability = 'Not Available' 
                              WHERE REGISTRATION_ID = '$assign_tech_id'";
    $conn->query($sqlUpdateAvailability);

    $sqlUpdateMechanicAvailability = "UPDATE employee_lists 
                                        SET Employee_Status = 'Not Available' 
                                        WHERE Employee_Name = '$mechanicName'";
    $conn->query($sqlUpdateMechanicAvailability);

    $sqlUpdateElectricianAvailability = "UPDATE employee_lists 
                                          SET Employee_Status = 'Not Available' 
                                          WHERE Employee_Name = '$electricianName'";
    $conn->query($sqlUpdateElectricianAvailability);


    // Update availability for assigned driver
    $sqlUpdateDriverAvailability = "UPDATE employee_lists 
                                    SET Employee_Status = 'Not Available' 
                                    WHERE Employee_Name = '$driverName'";
    $conn->query($sqlUpdateDriverAvailability);

    // Insert a default value into live_location_tb
    $sqlInsertLiveLocation = "INSERT INTO live_location_tb (SERVICE_REQUEST_ID, longitude, latitude, timestamp_column)
                              VALUES ('$SERVICE_REQUEST_ID', 0, 0, '1970-01-01 00:00:00')";

    if (
      $conn->query($sqlAssignTech) === TRUE &&
      $conn->query($sqlServiceRequest) === TRUE &&
      $conn->query($sqlUpdateAvailability) === TRUE &&
      $conn->query($sqlInsertLiveLocation) === TRUE
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
  }
}
?>