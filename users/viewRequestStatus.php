<?php

define('TITLE', 'View Request Status');
include_once 'includes/connection.php';

//make a logout session in php
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location:login.php');
    exit();
}
if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<body>

    <!-- <div class="loader">
        <div class="custom-loader"></div>
    </div> -->
    <?php include 'includes/sidebar.php'; ?>

    <section id="content">
        <?php include 'includes/navbar.php'; ?>

        <main>
            <button class="btn btn-primary" onclick="goBack()">
                <i class="bx bx-arrow-back"></i>
                Go Back
            </button>

            <?php
            include_once 'includes/connection.php';




            if (isset($_GET) & !empty($_GET)) {
                $SRID = $_GET['SERVICE_REQUEST_ID'];
                $sql = "SELECT * FROM submit_requests a, service_request_status b, work_order c 
                        WHERE a.SERVICE_REQUEST_ID = $SRID AND b.SERVICE_REQUEST_ID = $SRID AND c.SERVICE_REQUEST_ID =$SRID;";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                        <div class="card-container">
                            <div class="profile-info">
                                <h2>Status: <span class="data-output"><?php echo $row['STATUS_VALUE'] ?></span></h2>
                                <p>Assigned to: <span class="data-output"><?php echo $row['assign_tech'] ?></span></p>
                            </div>

                            <div class="service-details">
                                <h2>Service Request Details</h2>
                                <p>Request ID: <span class="data-output"><?php echo $row['SERVICE_REQUEST_ID'] ?></span></p>
                                <p>Requestor: <span class="data-output"><?php echo $row['requestor'] ?></span></p>
                                <p>Date Requested: <span class="data-output"><?php echo $row['date_of_request'] ?></span></p>
                                <p>Contact No: <span class="data-output"><?php echo $row['mobile_or_phone_no'] ?></span></p>
                                <p>Address: <span class="data-output"><?php echo $row['address'] ?></span></p>
                                <p>Business Unit: <span class="data-output"><?php echo $row['business_unit'] ?></span></p>
                                <p>Project Name: <span class="data-output"><?php echo $row['cust_project_name'] ?></span></p>
                                <p>Asset Code: <span class="data-output"><?php echo $row['asset_code'] ?></span></p>
                                <p>Model: <span class="data-output"><?php echo $row['model'] ?></span></p>
                                <p>Equipment Description: <span class="data-output"><?php echo $row['equip_desc'] ?></span></p>
                                <p>Equipment Brand: <span class="data-output"><?php echo $row['brand'] ?></span></p>
                                <p>Service Meter Reading: <span class="data-output"><?php echo $row['service_meter_reading'] ?></span></p>
                                <p>Type of Request: <span class="data-output"><?php echo $row['type_of_request'] ?></span></p>
                                <p>Charging: <span class="data-output"><?php echo $row['charging'] ?></span></p>
                                <p>Unit Problem: <span class="data-output"><?php echo $row['unit_problem'] ?></span></p>
                                <p>Unit Operational: <span class="data-output"><?php echo $row['unit_operational'] ?></span></p>
                                <p>Specific Requirement: <span class="data-output"><?php echo $row['specific_requirement'] ?></span></p>
                                <p>Onsite Contact Person: <span class="data-output"><?php echo $row['onsite_contact_person'] ?></span></p>
                                <p>Onsite Contact No: <span class="data-output"><?php echo $row['fax_no'] ?></span></p>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "<div class='alert alert-info'>
                            No data found.
                        </div>";

                    // Include your database connection file
                    include 'includes/connection.php';

                    // Check if the service request ID is set in the URL
                    if (isset($_GET['SERVICE_REQUEST_ID'])) {
                        $serviceRequestID = $_GET['SERVICE_REQUEST_ID'];

                        // Fetch customer details based on the service request ID
                        $customerQuery = "SELECT * FROM submit_requests WHERE SERVICE_REQUEST_ID = '$serviceRequestID'";
                        $customerResult = $conn->query($customerQuery);

                        if ($customerResult->num_rows > 0) {
                            $customer = $customerResult->fetch_assoc();

                            // Fetch quotations for the customer based on the service request ID
                            $quotationsQuery = "SELECT * FROM quotation_tb WHERE ServiceRequestID = '$serviceRequestID'";
                            $quotationsResult = $conn->query($quotationsQuery);
                            // Display quotations
                            if ($quotationsResult->num_rows > 0) {
                                echo '<h2>Quotations</h2>';
                                echo '<ul>';
                                while ($quotation = $quotationsResult->fetch_assoc()) {
                                    echo '<li>';
                                    echo 'Quotation Number: ' . $quotation['QuotationNumber'] . '<br>';
                                    echo 'Date Prepared: ' . $quotation['DatePrepared'] . '<br>';
                                    // Display other quotation details...
                                    echo '</li>';
                                }
                                echo '</ul>';
                            } else {
                                echo "<div class='alert alert-info'>No quotations yet for this request.</div>";
                            }
                        } else {
                            echo '<p>Customer not found for the provided service request ID.</p>';
                        }
                    } else {
                        echo '<p>Service Request ID not provided in the URL.</p>';
                    }

                    // Close the database connection
                    $conn->close();
                }
            }

            ?>

            <?php

            ?>



            <button class="btn btn-primary">
                <a href="mapViewer.php?SERVICE_REQUEST_ID=<?php echo $SRID; ?>" style="color: #fff">View Shared Location</a>
            </button>

        </main>
    </section>


    <?php include 'includes/scripts.php' ?>
    <script>
        // add an active list on the side bar when this page is loaded
        const active = document.querySelector(".side-menu li:nth-child(3)");
        active.classList.add("active");

        //JavaScript function to navigate back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>

<?php

?>