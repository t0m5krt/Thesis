<?php
// [IMPORTANT!] Define database connection parameters once for this file
include_once('includes/connection.php');

$SERVICE_REQUEST_ID = $_GET['SERVICE_REQUEST_ID'];
if (!isset($SERVICE_REQUEST_ID)) {
    $new_url = 'history.php';
    header('Location: ' . $new_url);
    exit;
}

session_start();
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

</head>

<body>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printableArea,
            #printableArea * {
                visibility: visible;
            }

            #printableArea {
                position: absolute;
                left: 0;
                top: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
    </style>


    <?php include('includes/sidebar.php') ?>
    <section id="content">
        <?php include 'includes/navbar.php' ?>
        <main>
            <h2>View Submitted Service Request</h2>

            <div class="col-sm-6 mt-5">
                <h4 class="text-center">Service Request Information</h4>

                <?php

                $sql = "SELECT * FROM submit_requests WHERE SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <div id="printableArea">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>SRN</td>
                                        <td>
                                            <?php if (isset($row['SERVICE_REQUEST_ID'])) {
                                                echo $row['SERVICE_REQUEST_ID'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Requestor</td>
                                        <td>
                                            <?php if (isset($row['requestor'])) {
                                                echo $row['requestor'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date of Request</td>
                                        <td>
                                            <?php if (isset($row['date_of_request'])) {
                                                echo $row['date_of_request'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile or Phone No.</td>
                                        <td>
                                            <?php if (isset($row['mobile_or_phone_no'])) {
                                                echo $row['mobile_or_phone_no'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>
                                            <?php if (isset($row['address'])) {
                                                echo $row['address'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Business unit</td>
                                        <td>
                                            <?php if (isset($row['business_unit'])) {
                                                echo $row['business_unit'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Project Name</td>
                                        <td>
                                            <?php if (isset($row['cust_project_name'])) {
                                                echo $row['cust_project_name'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type of Request</td>
                                        <td>
                                            <?php if (isset($row['type_of_request'])) {
                                                echo $row['type_of_request'];
                                            } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Model</td>
                                        <td>
                                            <?php if (isset($row['model'])) {
                                                echo $row['model'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>
                                            <?php if (isset($row['brand'])) {
                                                echo $row['brand'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit Problem</td>
                                        <td>
                                            <?php if (isset($row['unit_problem'])) {
                                                echo $row['unit_problem'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit Operational</td>
                                        <td>
                                            <?php if (isset($row['unit_operational'])) {
                                                echo $row['unit_operational'];
                                            } ?>
                                        </td>
                                    </tr>



                                </tbody>
                            </table>

                    <?php
                    }
                }
                    ?>
                        </div>

                        <div class="text-center">
                            <form class='d-print-none d-inline mr-3'><input class='btn btn-danger' type='submit' value='Print' onClick='printContent()'></form>
                            <form class='d-print-none d-inline' action="history.php"><input class='btn btn-secondary' type='submit' value='Close'></form>
                        </div>
            </div>


        </main>


    </section>
</body>
<script src="js/calendar.js"></script>
<script src="js/script.js"></script>
<script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=1866459&wid=5&tu=1&div=wwo-weather-widget-5' async></script>
<script src="js/preloader.js"></script>
<script src="js/favicon.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(3)");
    active.classList.add("active");
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function printContent(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        if (window.confirm("Do you want to print this part of the page?")) {
            window.print();
        }
    }

    // Add an event listener to the form submit button
    const printButton = document.querySelector('input[type="submit"][value="Print"]');
    printButton.addEventListener('click', printContent);
</script>