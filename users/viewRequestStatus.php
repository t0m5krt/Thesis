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

$SRN = $_GET['SERVICE_REQUEST_ID'];
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

            <button class="btn btn-primary">
                <a href="mapViewer.php?SERVICE_REQUEST_ID=<?php echo $SRN; ?>" style="color: #fff">View Shared Location</a>
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
                    // Run the second query if the first query doesn't return any results
                    $sqlFirst = "SELECT * FROM submit_requests a, service_request_status b 
                                WHERE a.SERVICE_REQUEST_ID = $SRID AND b.SERVICE_REQUEST_ID = $SRID";
                    $sqlFirstResult = mysqli_query($conn, $sqlFirst);

                    if (mysqli_num_rows($sqlFirstResult) > 0) {
                        while ($ResultRow = mysqli_fetch_assoc($sqlFirstResult)) {
                            // Display details from the second query
                            // ...
                        ?>
                            <div class="card-container">
                                <div class="profile-info">
                                    <div class="alert alert-success">Status: <span class="data-output"><?php echo $ResultRow['STATUS_VALUE'] ?></span></div>
                                </div>


                                <div class="service-details">
                                    <h2>Service Request Details</h2>
                                    <p>Request ID: <span class="data-output"><?php echo $ResultRow['SERVICE_REQUEST_ID'] ?></span></p>
                                    <p>Requestor: <span class="data-output"><?php echo $ResultRow['requestor'] ?></span></p>
                                    <p>Date Requested: <span class="data-output"><?php echo $ResultRow['date_of_request'] ?></span></p>
                                    <p>Contact No: <span class="data-output"><?php echo $ResultRow['mobile_or_phone_no'] ?></span></p>
                                    <p>Address: <span class="data-output"><?php echo $ResultRow['address'] ?></span></p>
                                    <p>Business Unit: <span class="data-output"><?php echo $ResultRow['business_unit'] ?></span></p>
                                    <p>Project Name: <span class="data-output"><?php echo $ResultRow['cust_project_name'] ?></span></p>
                                    <p>Asset Code: <span class="data-output"><?php echo $ResultRow['asset_code'] ?></span></p>
                                    <p>Model: <span class="data-output"><?php echo $ResultRow['model'] ?></span></p>
                                    <p>Equipment Description: <span class="data-output"><?php echo $ResultRow['equip_desc'] ?></span></p>
                                    <p>Equipment Brand: <span class="data-output"><?php echo $ResultRow['brand'] ?></span></p>
                                    <p>Service Meter Reading: <span class="data-output"><?php echo $ResultRow['service_meter_reading'] ?></span></p>
                                    <p>Type of Request: <span class="data-output"><?php echo $ResultRow['type_of_request'] ?></span></p>
                                    <p>Charging: <span class="data-output"><?php echo $ResultRow['charging'] ?></span></p>
                                    <p>Unit Problem: <span class="data-output"><?php echo $ResultRow['unit_problem'] ?></span></p>
                                    <p>Unit Operational: <span class="data-output"><?php echo $ResultRow['unit_operational'] ?></span></p>
                                    <p>Specific Requirement: <span class="data-output"><?php echo $ResultRow['specific_requirement'] ?></span></p>
                                    <p>Onsite Contact Person: <span class="data-output"><?php echo $ResultRow['onsite_contact_person'] ?></span></p>
                                    <p>Onsite Contact No: <span class="data-output"><?php echo $ResultRow['fax_no'] ?></span></p>
                                </div>

                                <div class='alert alert-info'>
                                    Your request is currently pending processing. Please check back for details once the request has been processed.
                                </div>
                            </div>
            <?php
                        }
                    } else {
                        // Handle the case when both queries don't return any results
                        echo 'No results found for the given SERVICE_REQUEST_ID.';
                    }
                }

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
                            echo ' <form method="post">
                            <div class="card-container">
                                    <div class="service-details">
                                    <h2>Quotations</h2>';
                            echo '<ul>';
                            while ($quotationsQuery = $quotationsResult->fetch_assoc()) {
                                echo '<li>';
                                echo 'Quotation Number: <strong>' . $quotationsQuery['QuotationNumber'] . ' </strong><br>';
                                echo 'Date Prepared: <strong>' . $quotationsQuery['DatePrepared'] . '</strong><br>';
                                echo 'Prepared By: <strong>' . $quotationsQuery['PreparedBy'] . '</strong><br>';
                                echo 'Quotation Response: <strong>' . $quotationsQuery['quote_response'] . '</strong><br>';
                                echo '</div>';

                                // Fetch quotation parts for the quotation
                                $quotationID = $quotationsQuery['QuotationNumber'];

                                $quotationPartsQuery = "SELECT * FROM quotation_parts_tb WHERE QuotationNumber = '$quotationID' AND ServiceRequestID = '$serviceRequestID'";
                                $quotationPartsResult = $conn->query($quotationPartsQuery);

                                // Display quotation parts in a table
                                if ($quotationPartsResult->num_rows > 0) {
                                    echo '<table>';
                                    echo '<tr>
                                            <th>Part Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal Price</th>
                                        </tr>';

                                    $totalUnitPrice = 0.00;
                                    $totalTotalPrice = 0.00;

                                    while ($quotationPart = $quotationPartsResult->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $quotationPart['PartDescription'] . '</td>';
                                        echo '<td>' . $quotationPart['Quantity'] . '</td>';
                                        echo '<td>' . $quotationPart['UnitPrice'] . '</td>';
                                        echo '<td>' . $quotationPart['TotalPrice'] . '</td>';
                                        echo '</tr>';

                                        // Calculate the total unit price and total price
                                        $totalUnitPrice += $quotationPart['UnitPrice'];
                                        $totalTotalPrice += $quotationPart['TotalPrice'];
                                    }

                                    echo '<tr>
                                            <td colspan="3"><strong>Total</strong></td>
                                            <td><strong>' . number_format($totalTotalPrice, 2) . '</strong></td>
                                        </tr>';
                                    echo '</table>';

                                    echo '<br>';

                                    echo '<button type="submit" class="btn btn-success" name="AcceptButton" id="acceptButton">Accept Quotation</button>
                                    <button type="submit" class="btn btn-danger" name="DeclineButton">Decline Quotation</button>
                                ';

                                    echo '</form>';
                                } else {
                                    echo '<p>No quotation parts found for this quotation.</p>';
                                }
                                echo '<br></li>';
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
            }

            ?>
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
// Add a php script to accept or decline the quotation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['AcceptButton'])) {
        // Check if the quotation has already been accepted
        $sqlCheckAcceptance = "SELECT quote_response FROM quotation_tb WHERE ServiceRequestID = '$serviceRequestID' AND QuotationNumber = '$quotationID'";
        $resultCheckAcceptance = mysqli_query($conn, $sqlCheckAcceptance);
        $rowCheckAcceptance = mysqli_fetch_assoc($resultCheckAcceptance);



        if ($rowCheckAcceptance['quote_response'] !== 'Pending') {
            // Display a SweetAlert message indicating that the quotation has already been accepted
?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'This quotation has already been processed.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = 'history.php';
                });
            </script>
            <?php
        } else {
            // Handle accepting the quotation
            $sqlAccept = "UPDATE quotation_tb
            SET quote_response = 'Accepted'
            WHERE ServiceRequestID = '$serviceRequestID' AND QuotationNumber = '$quotationID'";
            $resultAccept = mysqli_query($conn, $sqlAccept);

            if ($resultAccept) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Quotation Accepted Successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'history.php';
                    });
                </script>
            <?php
            } else {
                // Display a SweetAlert message indicating that the quotation acceptance failed
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Quotation Acceptance Failed!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'viewRequestStatus.php?SERVICE_REQUEST_ID=<?php echo $serviceRequestID; ?>';
                    });
                </script>
            <?php
            }
        }
    }

    if (isset($_POST['DeclineButton'])) {
        // Handle declining the quotation
        $sqlCheckDecline = "SELECT quote_response FROM quotation_tb WHERE ServiceRequestID = '$serviceRequestID' AND QuotationNumber = '$quotationID'";
        $resultCheckDecline = mysqli_query($conn, $sqlCheckDecline);
        $rowCheckDecline = mysqli_fetch_assoc($resultCheckDecline);

        if ($rowCheckDecline['quote_response'] === 'Pending') {
            // Display a SweetAlert message with options for voiding or editing the quotation
            ?>
            <script>
                Swal.fire({
                    icon: 'question',
                    title: 'What would you like to do with the quotation?',
                    showCancelButton: true,
                    confirmButtonText: 'Void',
                    cancelButtonText: 'Edit'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ask for confirmation before voiding the quotation
                        Swal.fire({
                            icon: 'warning',
                            title: 'Are you sure you want to void this quotation?',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, void it',
                            cancelButtonText: 'Cancel'
                        }).then((confirmationResult) => {
                            if (confirmationResult.isConfirmed) {
                                // Update quote_response to 'Voided'
                                $.ajax({
                                    type: 'POST',
                                    url: 'updateQuotation.php', // Create a separate PHP file to handle the update
                                    data: {
                                        serviceRequestID: '<?php echo $serviceRequestID; ?>', // Pass the service request ID to the PHP file
                                        quotationID: '<?php echo $quotationID; ?>' // Pass the quotation ID to the PHP file
                                    },
                                    success: function(response) {
                                        // Display success message and redirect
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Quotation Voided Successfully!',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }).then(() => {
                                            window.location.href = 'history.php';
                                        });
                                    }
                                });
                            }
                        });
                    } else {
                        // Redirect to the quotation editing page
                        swal.fire({
                            icon: 'info',
                            title: 'Redirecting...',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            window.location.href = 'editQuotation.php?QuotationNumber=<?php echo $quotationID; ?>&SERVICE_REQUEST_ID=<?php echo $serviceRequestID; ?>';
                        });
                    }
                });
            </script>
        <?php
        } elseif ($rowCheckDecline['quote_response'] === 'Voided') {
            // Display a SweetAlert message indicating that the quotation has already been voided
        ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Quotation Already Voided',
                    text: 'This quotation has already been voided.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = 'history.php';
                });
            </script>
        <?php
        } elseif ($rowCheckDecline['quote_response'] === 'Conditionally Accepted') {
            // Display a SweetAlert message indicating that the quotation has already been conditionally accepted
        ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Quotation Already Conditionally Accepted',
                    text: 'This quotation has already been processed.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = 'viewRequestStatus.php?SERVICE_REQUEST_ID=<?php echo $serviceRequestID; ?>';
                });
            </script>
        <?php
        } else {
            // Display a SweetAlert message indicating that the quote_response is not 'Pending'
        ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Quotation Processing',
                    text: 'This quotation is already being processed and cannot be edited or voided at the moment.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.href = 'viewRequestStatus.php?SERVICE_REQUEST_ID=<?php echo $serviceRequestID; ?>';
                });
            </script>
<?php
        }
    }
}
?>