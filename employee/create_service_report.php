<?php
include_once 'includes/connection.php';

$wo_ID = $_GET['work_order_ID'];

$sql = "SELECT a.*, c.*
FROM submit_requests a
INNER JOIN work_order c ON c.work_order_ID = c.work_order_ID
WHERE c.work_order_ID = ?
AND a.user_id = a.user_id
  AND a.service_request_ID = c.SERVICE_REQUEST_ID
GROUP BY a.SERVICE_REQUEST_ID, a.user_id, c.work_order_ID, a.service_request_ID";

?>

<head>
    <title>Service Report | Repair and Maintence Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<style>
    .service-report {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid black;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
        appearance: textfield;
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

<body>

    <form action="create_service_report.php" method="post">

        <div class="service-report container">
            <span class="icon img-fluid">
                <img src="img/MegawideCELS-Logo.svg" alt="icon">
            </span>
            <h1>SERVICE REPORT</h1>
            <table class="table centered-table">
                <thead>
                    <tr>
                        <th>WORK ORDER ID.</th>
                        <th>DATE</th>
                        <th>PROJECT SITE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" id="work_order_no" name="work_order_no" readonly></td>
                        <td><input type="date" id="date_of_report" name="date_of_report" min="<?php echo date('Y-m-d'); ?>" required></td>
                        <td><input type="text" id="project_site" name="project_site" required></td>
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
                        <td><input type="number" id="machine_code_id" name="machine_code_id"></td>
                        <td><input type="text" id="brand" name="brand" required></td>
                        <td><input type="text" id="model" name="model" required></td>
                        <td><input type="number" id="serial_number" name="serial_number"> </td>
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
                        <td><input type="text" id="smr_kmr" name="smr_kmr"></td>
                        <td>
                            <div class="form-check1">
                                <input class="form-check-input" type="radio" name="equipment" value="Preventive" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    Preventive
                                </label>
                            </div>
                            <div class="form-check1">
                                <input class="form-check-input" type="radio" name="equipment" value="Inspection" id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    Inspection
                                </label>
                            </div>
                            <div class="form-check1">
                                <input class="form-check-input" type="radio" name="equipment" value="Minor Repair" id="defaultCheck5">
                                <label class="form-check-label" for="defaultCheck5">
                                    Minor repair
                                </label>
                            </div>
                            <div class="form-check1">
                                <input class="form-check-input" type="radio" name="equipment" value="Major Repair" id="defaultCheck6">
                                <label class="form-check-label" for="defaultCheck6">
                                    Major repair
                                </label>
                            </div>
                            <div class="form-check1">
                                <input class="form-check-input" type="radio" name="equipment" value="Others" id="defaultCheck7">
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
                <input class="form-check-input" type="radio" name="equipment_status" value="complete" id="defaultCheck7">
                <label class="form-check-label" for="defaultCheck7">
                    Complete
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="equipment_status" value="incomplete" id="defaultCheck7">
                <label class="form-check-label" for="defaultCheck7">
                    Incomplete
                </label>
            </div>



            <h3>Project Request/Complaint</h3>

            <div>
                <input type="text" class="form-control" id="complaint" name="complaint" placeholder="Enter Project Request/Complaint here" aria-label="Project_Request_Complaint">
            </div>

            <h3>Findings</h3>

            <div>
                <input type="text" class="form-control" id="findings" name="findings" placeholder="Enter Findings here" aria-label="Findings">
            </div>

            <h3>Work Done</h3>

            <div>
                <input type="text" class="form-control" id="work_done" name="work_done" placeholder="Enter Work Done here" aria-label="Work Done">
            </div>
            <h3>Recommendations</h3>

            <div>
                <input type="text" class="form-control" id="recommendations" name="recommendations" placeholder="Enter Recommendations here" aria-label="Recommendations">
            </div>


            <table class="table centered-table">
                <thead>
                    <tr>
                        <th>PARTS REPLACED/PARTS#/DESCRIPTION</th>
                        <th>RECOMMENDATION PARTS FOR REPLACEMENT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" id="parts_replaced" name="parts_replaced"></td>
                        <td><input type="text" class="form-control" id="recommendation_parts" name="recommendation_parts"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" id="parts_replaced1" name="parts_replaced1"></td>
                        <td><input type="text" class="form-control" id="recommendation_parts1" name="recommendation_parts1"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" id="parts_replaced2" name="parts_replaced2"></td>
                        <td><input type="text" class="form-control" id="recommendation_parts2" name="recommendation_parts2"></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control" id="parts_replaced3" name="parts_replaced3"></td>
                        <td><input type="text" class="form-control" id="recommendation_parts3" name="recommendation_parts3"></td>
                    </tr>
                </tbody>
            </table>

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
                        <td><input type="text" class="form-control" id="arrival_time" name="arrival_time"></td>
                        <td><input type="text" class="form-control" id="departure_time" name="departure_time"></td>
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
            </div>`
        </div>

        <form method="POST" action="">
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-danger btn-lg mx-auto" name="submit">Submit</button>
            </div>
        </form>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/favicon.js"></script>
</body>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // This function will be called when the page is fully loaded
        fillForm('<?php echo $wo_ID; ?>');
    });

    function fillForm(workOrderNo, projectSite, brand, complaint) {
        document.getElementById('work_order_no').value = workOrderNo;
    }
</script>


</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleFormSubmission();
}
function handleFormSubmission()

{
    include_once 'includes/connection.php';

    $work_order_no = $_POST['work_order_no'];
    $date_of_report = date('Y-m-d', strtotime($_POST['date_of_report']));
    $project_site = $_POST['project_site'];
    $machine_code_id = $_POST['machine_code_id'];
    $brand = $_POST['brand'];
    $serial_number = $_POST['serial_number'];
    $smr_kmr = $_POST['smr_kmr'];
    $equipment = $_POST['equipment'];
    $equipment_status = $_POST['equipment_status'];
    $complaint = $_POST['complaint'];
    $findings = $_POST['findings'];
    $work_done = $_POST['work_done'];
    $recommendations = $_POST['recommendations'];
    $parts_replaced = $_POST['parts_replaced'];
    $recommendation_parts = $_POST['recommendation_parts'];
    $parts_replaced1 = $_POST['parts_replaced1'];
    $recommendation_parts1 = $_POST['recommendation_parts1'];
    $parts_replaced2 = $_POST['parts_replaced2'];
    $recommendation_parts2 = $_POST['recommendation_parts2'];
    $parts_replaced3 = $_POST['parts_replaced3'];
    $recommendation_parts3 = $_POST['recommendation_parts3'];
    $arrival_time = $_POST['arrival_time'];
    $departure_time = $_POST['departure_time'];
    if ($conn === false) {
        echo "Error: Unable to connect to the database.";
        return;
    }

    $sql = "INSERT INTO service_report (
        work_order_ID,
        date_of_report,
        project_site,
        machine_code_id,
        brand,
        serial_number,
        smr_kmr,
        equipment,
        equipment_status,
        complaint,
        findings,
        work_done,
        recommendations,
        parts_replaced,
        recommendation_parts,
        parts_replaced1,
        recommendation_parts1,
        parts_replaced2,
        recommendation_parts2,
        parts_replaced3,
        recommendation_parts3,
        arrival_time,
        departure_time
        )

        VALUES(
        '$work_order_no',
        '$date_of_report',
        '$project_site',
        '$machine_code_id',
        '$brand',
        '$serial_number',
        '$smr_kmr',
        '$equipment',
        '$equipment_status',
        '$complaint',
        '$findings',
        '$work_done',
        '$recommendations',
        '$parts_replaced',
        '$recommendation_parts',
        '$parts_replaced1',
        '$recommendation_parts1',
        '$parts_replaced2',
        '$recommendation_parts2',
        '$parts_replaced3',
        '$recommendation_parts3',               
        '$arrival_time',
        '$departure_time'
        
)";
    if (mysqli_query($conn, $sql)) {
?>
        <script>
            Swal.fire({
                title: 'Confirm Details',
                text: 'Are you sure you want to submit the form?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) { // if user clicks on submit button
                    Swal.fire( //  then show alert 'Success'
                        'Success',
                        'Service Report submitted successfully',
                        'success'
                    ).then(() => {
                        window.location.href = 'view_assign_work_order.php';
                    });
                } else {
                    Swal.fire(
                        'Cancelled',
                        'Form submission cancelled',
                        'error'
                    ).then(() => {
                        window.location.href = 'service_report_employee.php';
                    });
                }
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire(
                'Error',
                'An error has occurred. Please try again.',
                'error'
            ).then(() => {
                window.location.href = 'service_report_employee.php';
            });
        </script>
<?php
        return;
    }

    mysqli_close($conn);
}
?>

<?php
include_once 'includes/connection.php';

// Check if 'work_order_ID' key exists in the $_GET array
$wo_ID = isset($_GET['work_order_ID']) ? $_GET['work_order_ID'] : null;

// Debugging statement to check the value
echo "work_order_ID: " . $wo_ID;

// Rest of your SQL query and HTML code
?>