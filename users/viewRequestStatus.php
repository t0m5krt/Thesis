<?php
// [IMPORTANT!] Define database connection parameters once for this file
include_once('includes/connection.php');
include('includes/header.php');

$id = $_GET['id'];
if (!isset($id)) {
    $new_url = 'workOrder_Admin.php';
    header('Location: ' . $new_url);
    exit;
}

$sql = "SELECT a.*, c.assign_tech,c.assign_date
FROM submit_requests AS a JOIN service_request_status AS b
JOIN work_order AS c ON b.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID
WHERE a.SERVICE_REQUEST_ID = '$id'
GROUP BY a.SERVICE_REQUEST_ID;";

$result = $conn->query($sql);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php include 'includes/sidebar.php' ?>

    <section id="content">
        <?php include 'includes/navbar.php' ?>

        <main>
            <h2>View Request</h2>

            <div class="col-sm-6 mt-5  mx-3">
                <h4 class="text-center">Assigned Work Details</h4>


                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>ID</td>
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
                <?php
                    }
                }
                ?>

                <div class="text-center">
                    <form class='d-print-none d-inline mr-3'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form>
                    <form class='d-print-none d-inline' action="workOrder_Admin.php"><input class='btn btn-secondary' type='submit' value='Close'></form>
                </div>
            </div>
        </main>
    </section>
</body>

</html>