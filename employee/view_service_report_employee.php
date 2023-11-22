<?php

define('TITLE', 'Service Report');
include 'includes/header.php';

?>





<head>
    <title>Service Report | Repair and Maintence Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">






</head>

<body>
    <?php
    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        // Retrieve the value of 'id' from the URL
        $SERVICE_REPORT_ID = $_GET['id'];

        // Use the retrieved value in your SQL query
        $sql = "SELECT * FROM service_report WHERE SERVICE_REPORT_ID = '$SERVICE_REPORT_ID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Your code to display or process the data goes here
    ?>


                <div class="service-report container">
                    <span class="icon img-fluid">
                        <img src="img/MegawideCELS-Logo.svg" alt="icon">
                    </span>


                    <h1>Service Report</h1>

                    <table class="table centered-table">
                        <thead>
                            <tr>
                                <th>WORK ORDER NO.</th>
                                <th>DATE</th>
                                <th>PROJECT SITE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $row['work_order_ID']; ?></td>
                            <td><?php echo $row['date_of_report']; ?></td>
                            <td><?php echo $row['project_site']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table centered-table">
                        <thead>
                            <tr>
                                <th>MACHINE CODE ID#</th>
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL NUMBER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $row['machine_code_id']; ?></td>
                                <td><?php echo $row['brand']; ?></td>
                                <td><?php echo $row['model']; ?></td>
                                <td><?php echo $row['serial_number']; ?></td>

                            </tr>
                        </tbody>
                    </table>

                    <table class="table centered-table">
                        <thead>
                            <tr>
                                <th>SMR/KMR</th>
                                <th>RELATED EQUIPMENT DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $row['smr_kmr']; ?></td>
                                <td>
                                    <div class="form-check1">
                                        <input class="form-check-input" disabled type="radio" name="equipment" value="Preventive" id="defaultCheck3" <?php echo ($row['equipment'] == 'Preventive') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultCheck3">
                                            Preventive
                                        </label>
                                    </div>
                                    <div class="form-check1">
                                        <input class="form-check-input" disabled type="radio" name="equipment" value="Inspection" id="defaultCheck4" <?php echo ($row['equipment'] == 'Inspection') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultCheck4">
                                            Inspection
                                        </label>
                                    </div>
                                    <div class="form-check1">
                                        <input class="form-check-input" disabled type="radio" name="equipment" value="Minor Repair" id="defaultCheck5" <?php echo ($row['equipment'] == 'Minor Repair') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultCheck5">
                                            Minor repair
                                        </label>
                                    </div>
                                    <div class="form-check1">
                                        <input class="form-check-input" disabled type="radio" name="equipment" value="Major Repair" id="defaultCheck6" <?php echo ($row['equipment'] == 'Major Repair') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultCheck6">
                                            Major repair
                                        </label>
                                    </div>
                                    <div class="form-check1">
                                        <input class="form-check-input" disabled type="radio" name="equipment" value="Others" id="defaultCheck7" <?php echo ($row['equipment'] == 'Others') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultCheck7">
                                            Others
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h2>Job Repair Status</h2>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" disabled name="repair_status" value="complete" id="complete" <?php echo ($row['equipment_status'] == 'complete') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="complete">
                            Complete
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" disabled name="repair_status" value="incomplete" id="incomplete" <?php echo ($row['equipment_status'] == 'incomplete') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="incomplete">
                            Incomplete
                        </label>
                    </div>


                    <h3>Findings</h3>

                    <form>
                        <input type="text" disabled class="form-control" placeholder="Enter Findings here" aria-label="Findings" value="<?php echo $row['findings']; ?>">
                    </form>

                    <h3>Work Done</h3>

                    <form>
                        <input type="text" disabled class="form-control" placeholder="Enter Work Done here" aria-label="Work_Done" value="<?php echo $row['work_done']; ?>">
                    </form>

                    <h3>Recommendations</h3>

                    <form>
                        <input type="text" disabled class="form-control" placeholder="Enter Recommendations here" aria-label="Recommendations" value="<?php echo $row['recommendations']; ?>">
                    </form>


                    <table class="table centered-table">
                        <thead>
                            <tr>
                                <th>PARTS REPLACED/PARTS#/DESCRIPTION</th>
                                <th>RECOMMENDATION PARTS FOR REPLACEMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" disabled class="form-control" name="parts_replaced" value="<?php echo $row['parts_replaced']; ?>"></td>
                                <td><input type="text" disabled class="form-control" name="recommendation_parts" value="<?php echo $row['recommendation_parts']; ?>"></td>
                            </tr>
                            <tr>
                                <td><input type="text" disabled class="form-control" name="parts_replaced1" value="<?php echo $row['parts_replaced1']; ?>"></td>
                                <td><input type="text" disabled class="form-control" name="recommendation_parts1" value="<?php echo $row['recommendation_parts1']; ?>"></td>
                            </tr>
                            <tr>
                                <td><input type="text" disabled class="form-control" name="parts_replaced2" value="<?php echo $row['parts_replaced2']; ?>"></td>
                                <td><input type="text" disabled class="form-control" name="recommendation_parts2" value="<?php echo $row['recommendation_parts2']; ?>"></td>
                            </tr>
                            <tr>
                                <td><input type="text" disabled class="form-control" name="parts_replaced3" value="<?php echo $row['parts_replaced3']; ?>"></td>
                                <td><input type="text" disabled class="form-control" name="recommendation_parts3" value="<?php echo $row['recommendation_parts3']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>





                    <h4>Service Time</h4>

                    <table class="table centered-table">
                        <thead>
                            <tr>
                                <th>ARRIVAL TIME</th>
                                <th>DEPARTURE TIME</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" disabled class="form-control" name="arrival_time" value="<?php echo $row['arrival_time']; ?>"></td>
                                <td><input type="text" disabled class="form-control" name="departure_time" value="<?php echo $row['departure_time']; ?>"></td>
                            </tr>
                        </tbody>
                    </table>



                    <div class="signature">
                        <p>Reported by (Serviceman): </p>
                        <div class="line"></div>
                    </div>
                    <div class="signature">
                        <p>Noted by (Supervisor): </p>
                        <div class="line"></div>
                    </div>
                    <div class="signature">
                        <p>Project Representative: </p>
                        <div class="line"></div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/favicon.js"></script>
</body>

<script>

</script>





<style>
    .service-report {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid black;
    }

    .service-report h1 {
        text-align: center;
        background-color: #f02e24;
    }

    .service-report table {
        border-collapse: collapse;
        width: 100%;
    }

    .service-report th,
    .service-report td {
        border: 1px solid black;
        padding: 5px;
    }

    .service-report th {
        background-color: #a9a9a9;
    }

    .centered-table {
        margin: 0 auto;
        float: none;
        text-align: center;
    }

    .service-report h4 {
        text-align: center;

    }

    .form-check1 {
        display: inline-block;
        margin-right: 20px;
    }

    .form-check {
        display: inline-block;
        margin-right: 20px;
    }
</style>