<?php
// [IMPORTANT!] Define database connection parameters once for this file
include_once('includes/connection.php');

$id = $_GET['id'];
if (!isset($id)) {
    $new_url = 'workOrder_employee.php';
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
    <link rel="stylesheet" href="styles/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
        ol,
        ul {
            padding-left: 0rem;
        }
    </style>
</head>

<body>


    <?php include('includes/sidebar.php') ?>
    <section id="content">
        <?php include 'includes/navbar.php' ?>
        <main>
            <h2>View Assigned Work Order</h2>



            <div class="col-sm-8 mt-5 mx-3 mx-auto">

                <h4 class="text-center">Assigned Work Details</h4>


                <?php
                $sql = "SELECT a.*, c.work_order_ID, c.assign_tech, c.assign_date
                FROM submit_requests AS a
                JOIN service_request_status AS b ON a.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID
                JOIN work_order AS c ON b.SERVICE_REQUEST_ID = c.SERVICE_REQUEST_ID
                WHERE a.SERVICE_REQUEST_ID = '$id'
                GROUP BY a.SERVICE_REQUEST_ID";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Work Order ID</td>
                                    <td>
                                        <?php echo $row['work_order_ID']
                                        ?>
                                    </td>
                                </tr>
                                <tr>
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
                                    <td>Asset Code</td>
                                    <td>
                                        <?php if (isset($row['asset_code'])) {
                                            echo $row['asset_code'];
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
                                    <td>Serial No.</td>
                                    <td>
                                        <?php if (isset($row['serial_no'])) {
                                            echo $row['serial_no'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Equip Desc</td>
                                    <td>
                                        <?php if (isset($row['equip_desc'])) {
                                            echo $row['equip_desc'];
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
                                    <td>Service Meter Reading</td>
                                    <td>
                                        <?php if (isset($row['service_meter_reading'])) {
                                            echo $row['service_meter_reading'];
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
                                    <td>Additonal Option</td>
                                    <td>
                                        <?php if (isset($row['additonal_option'])) {
                                            echo $row['additonal_option'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other Service Request</td>
                                    <td>
                                        <?php if (isset($row['other_service_request'])) {
                                            echo $row['other_service_request'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Charging</td>
                                    <td>
                                        <?php if (isset($row['charging'])) {
                                            echo $row['charging'];
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
                                    <td>Specific Requirement</td>
                                    <td>
                                        <?php if (isset($row['specific_requirement'])) {
                                            echo $row['specific_requirement'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Onsite Contact Person</td>
                                    <td>
                                        <?php if (isset($row['onsite_contact_person'])) {
                                            echo $row['onsite_contact_person'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fax No.</td>
                                    <td>
                                        <?php if (isset($row['fax_no'])) {
                                            echo $row['fax_no'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned Technician</td>
                                    <td>
                                        <?php if (isset($row['assign_tech'])) {
                                            echo $row['assign_tech'];
                                        } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned Date</td>
                                    <td>
                                        <?php if (isset($row['assign_date'])) {
                                            echo $row['assign_date'];
                                        } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-center">
                            <form class="d-print-none d-inline">
                                <input class="btn btn-primary" type="submit" value="Print" onclick="window.print()">
                            </form>

                            <a href="create_service_report.php?work_order_ID=<?php echo $row['work_order_ID']; ?>" class="btn btn-secondary">
                                Create Service Report
                            </a>


                            <form class="d-print-none d-inline">
                                <input class="btn btn-danger" type="submit" value="Close">
                            </form>

                            <a href="mapTest/liveMap.php?SERVICE_REQUEST_ID=<?php echo $id; ?>" class="btn btn-primary">
                                <i class="bx bx-current-location"></i>
                                Start Sharing Location
                            </a>
                        </div>
                <?php
                    }
                }
                ?>

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
    const active = document.querySelector(".side-menu li:nth-child(2)");
    active.classList.add("active");
</script>