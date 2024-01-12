<?php
include 'includes/connection.php';
// include 'includes/header.php';
define('PAGE', 'Edit Quotation');

// $adminID = $_SESSION['REGISTRATION_ID'];
$SR_Number = $_GET['SERVICE_REQUEST_ID'];
$quotationNumber = $_GET['QuotationNumber'];

// $sql2 = "SELECT CONCAT(firstname, ' ', lastname) AS full_name FROM office_accounts WHERE REGISTRATION_ID = '$adminID'";
// $result2 = mysqli_query($conn, $sql2);
// // Check if the query was successful
// if ($result2 && mysqli_num_rows($result2) > 0) {
//     $row2 = mysqli_fetch_assoc($result2);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo PAGE ?></title>
    <style>
        #header {
            margin: 1rem 0rem 2rem 1rem;
        }

        h1 {
            margin: 1rem 0rem 2rem 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0rem 2rem 0rem;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header-con {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .header-item {
            padding-bottom: 10px;
        }

        #quotationTable {
            margin: 0rem 0rem 2rem 0rem;
        }

        .functionContainer {
            margin: 1rem 0rem 2rem 1rem;
        }

        #disclaimer {
            margin: 1rem 0rem 2rem 1rem;
        }

        #buttonFloat {
            /* position: fixed;
            top: 20px;
            left: 20px;
            z-index: 99; */

            margin: 0.5rem 0rem 1rem 0.5rem;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="Styles/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
</head>

<body>
    <button type="button" class="btn btn-danger" id="buttonFloat">
        <i class='bx bxs-arrow-to-left'></i> Back
    </button>


    <?php
    if (isset($_GET['SERVICE_REQUEST_ID'])) {
        // Retrieve the value of 'id' from the URL
        $SRN = $_GET['SERVICE_REQUEST_ID'];


        // Use the retrieved value in your SQL query
        $sql = "SELECT * FROM quotation_tb WHERE ServiceRequestID = '$SRN' AND QuotationNumber = '$quotationNumber'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Your code to display or process the data goes here
    ?>

                <h1><?php echo PAGE ?></h1>


                <form method="POST" action="editQuotation.php">

                    <div id="header">

                        <div class="header-con">

                            <div class="header-item">
                                <label for="ClientName">Client Name:</label>
                                <input type="text" id="ClientName" name="ClientName" value="<?php echo $row['ClientName']; ?>" readonly>
                            </div>

                            <div class="header-item">
                                <label for="DatePrepared">Date Prepared:</label>
                                <input type="date" id="DatePrepared" name="DatePrepared" value="<?php echo $row['DatePrepared']; ?>" readonly>
                            </div>

                        </div>

                        <div class="header-con">

                            <div class="header-item">
                                <label for="projectName">Project Name:</label>
                                <input type="text" id="projectName" name="ProjectName" value="<?php echo $row['ProjectName']; ?>" readonly>
                            </div>

                            <div class="header-item">
                                <label for="QuotationNumber">Quotation Number:</label>
                                <input type="text" id="QuotationNumber" name="QuotationNumber" value="<?php echo $row['QuotationNumber']; ?>" readonly>
                            </div>

                        </div>

                        <div class="header-con">


                            <div class="header-item">
                                <label for="ServiceRequestId">Service Request ID:</label>
                                <input type="text" id="QuoteServiceRequestId" name="QuoteServiceRequestId" value="<?php echo $row['ServiceRequestID']; ?>" readonly>
                            </div>

                            <div class="header-item">
                                <label for="preparedBy">Prepared By:</label>
                                <input type="text" id="PreparedBy" name="PreparedBy" value="<?php echo $row['PreparedBy']; ?>" readonly>
                            </div>

                        </div>
                    </div>

                    <h1>Parts</h1>

                    <?php
                    $quotationPartsQuery = "SELECT * FROM quotation_parts_tb WHERE QuotationNumber = '$quotationNumber' AND ServiceRequestID = '$SR_Number'";
                    $quotationPartsResult = $conn->query($quotationPartsQuery);

                    // Display quotation parts in a table
                    if ($quotationPartsResult->num_rows > 0) {
                        while ($quotationPartsRow = $quotationPartsResult->fetch_assoc()) {
                    ?>
                            <table>


                                <tr>
                                    <td><input type="text" name="part_description[]" value="<?php echo $quotationPartsRow['PartDescription']; ?>" required></td>
                                    <td><input type="number" name="part_quantity[]" min="0" max="999" value="<?php echo $quotationPartsRow['Quantity']; ?>" required></td>
                                    <td><input type="number" name="part_price[]" min="0" max="999999" step="0.01" value="<?php echo $quotationPartsRow['UnitPrice']; ?>" required></td>
                                    <td><input type="text" name="part_total[]" value="<?php echo $quotationPartsRow['TotalPrice']; ?>" readonly></td>
                                    <td><button type="button" onclick="removeRow(this)" class="btn btn-primary">Remove</button></td>
                                </tr>
                            </table>
                    <?php
                        }
                    } else {
                        echo "<p>No parts found.</p>";
                    }
                    ?>

                    <div class="functionContainer">
                        <button type="button" onclick="addRow()" class="btn btn-secondary">Add Part</button>

                        <label for="subtotal">Subtotal:</label>
                        <input type="text" id="subtotal" name="subtotal" readonly>

                        <button type="button" onclick="calculateTotal()" class="btn btn-secondary">Calculate Total</button>
                        <button id="submitButton" name="submitPost" type="submit" class="btn btn-success">Submit Quotation</button>
                    </div>

                </form>
                <!-- <div id="disclaimer">
                    <p><em>Note:</em> This quotation is subject to variations in rental fees and additional services that may be required to complete the service. The final costs may differ based on specific service needs and rental terms.</p>
                </div> -->

                <script>
                    function addRow() {
                        var table = document.getElementById("quotationTable").getElementsByTagName('tbody')[0];
                        var newRow = table.insertRow(table.rows.length);
                        var cols = 5; // Number of columns

                        for (var i = 0; i < cols; i++) {
                            var cell = newRow.insertCell(i);
                            if (i < cols - 1) {
                                var input = document.createElement("input");
                                input.type = "text";
                                if (i === 1) {
                                    input.name = "part_quantity[]";
                                    input.type = "number";
                                    input.step = "1";
                                    input.min = "0";
                                    input.max = "999";
                                } else if (i === 2) {
                                    input.name = "part_price[]";
                                    input.type = "number";
                                    input.step = "0.01";
                                    input.min = "0";
                                    input.max = "999999";
                                } else if (i === 3) {
                                    input.name = "part_total[]";
                                    input.readOnly = true;
                                } else {
                                    input.name = "part_description[]";
                                }
                                input.required = true;
                                cell.appendChild(input);
                            } else {
                                var button = document.createElement("button");
                                button.type = "button";
                                button.textContent = "Remove";
                                button.className = "btn btn-primary"; // Add the class "btn btn-primary"
                                button.onclick = function() {
                                    removeRow(this);
                                };
                                cell.appendChild(button);
                            }
                        }
                    }

                    function removeRow(button) {
                        var row = button.parentNode.parentNode;
                        var confirmation = confirm("Are you sure you want to remove this?");
                        if (confirmation) {
                            row.parentNode.removeChild(row);
                            calculateTotal();
                        }
                    }

                    function calculateTotal() {
                        var table = document.getElementById("quotationTable").getElementsByTagName('tbody')[0];
                        var rows = table.getElementsByTagName('tr');
                        var subtotal = 0;

                        for (var i = 0; i < rows.length; i++) {
                            var cells = rows[i].getElementsByTagName('td');
                            var quantity = parseFloat(cells[1].getElementsByTagName('input')[0].value);
                            var price = parseFloat(cells[2].getElementsByTagName('input')[0].value);
                            var total = quantity * price;
                            subtotal += total;
                            cells[3].getElementsByTagName('input')[0].value = total.toFixed(2);
                        }

                        document.getElementById("subtotal").value = subtotal.toFixed(2);
                    }

                    function generateQuotationNumber() {
                        // var currentDate = new Date();
                        // var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                        // var day = currentDate.getDate().toString().padStart(2, '0');
                        // var year = currentDate.getFullYear().toString().slice(-2);
                        // var hours = currentDate.getHours().toString().padStart(2, '0');
                        // var minutes = currentDate.getMinutes().toString().padStart(2, '0');
                        // var seconds = currentDate.getSeconds().toString().padStart(2, '0');

                        // var formattedDate = month + day + year;
                        // var formattedTime = hours + minutes + seconds;

                        // return formattedDate + formattedTime;

                        var characters = '0123456789';
                        var quotationNumber = '';

                        for (var i = 0; i < 5; i++) {
                            var randomIndex = Math.floor(Math.random() * characters.length);
                            quotationNumber += characters.charAt(randomIndex);
                        }

                        return quotationNumber;
                    }



                    // JavaScript or jQuery code to dynamically update quotationNumber and serviceRequestId
                    document.getElementById('QuotationNumber').value = generateQuotationNumber();
                    document.getElementById('QuoteServiceRequestId').value = <?php echo $SR_Number; ?>;
                    document.getElementById('ClientName').value = "<?php echo $row['requestor']; ?>";
                    document.getElementById('projectName').value = "<?php echo $row['cust_project_name']; ?>";
                    document.getElementById('PreparedBy').value = "<?php echo $row2['full_name']; ?>";

                    // JavaScript code to redirect to admin dashboard
                    document.getElementById('buttonFloat').onclick = function() {
                        window.location.href = "serviceRequest_Admin.php";
                    };

                    // JavaScript code to redirect to admin dashboard
                    document.getElementById('submitButton').onclick = function() {
                        var confirmation = confirm("Are you sure you want to submit?");
                        if (confirmation) {
                            return true;
                        } else {
                            return false;
                        }
                    };
                </script>

                <script src="js/favicon.js"></script>

    <?php
            }
        } else {
            // echo "<script>alert('No results found.');</script>";
        }
    } else {
        // echo "<script>alert('No \'id\' parameter found in URL.');</script>";
    }
    ?>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required keys are set in $_POST
    if (isset($_POST["ClientName"], $_POST["PreparedBy"], $_POST["DatePrepared"], $_POST["ProjectName"], $_POST["QuotationNumber"])) {
        $clientName = $_POST["ClientName"];
        $preparedBy = $_POST["PreparedBy"];
        $datePrepared = $_POST["DatePrepared"];
        $quotationNumber = $_POST["QuotationNumber"];
        $serviceRequestId = $_POST["QuoteServiceRequestId"];
        $projectName = $_POST["ProjectName"];

        // Insert the quotation information into the Quotation table
        $quotationInsertQuery = "INSERT INTO quotation_tb (ClientName, PreparedBy, DatePrepared, QuotationNumber, ServiceRequestID, ProjectName) 
                                VALUES ('$clientName', '$preparedBy', '$datePrepared', '$quotationNumber', '$serviceRequestId', '$projectName')";

        if ($conn->query($quotationInsertQuery) === TRUE) {
            $quotationID = $conn->insert_id; // Get the ID of the last inserted row 

            // Insert part information into the QuotationParts table
            foreach ($_POST["part_description"] as $index => $partDescription) {
                $quantity = $_POST["part_quantity"][$index];
                $unitPrice = $_POST["part_price"][$index];
                $totalPrice = $quantity * $unitPrice;

                $partUpdateQuery = "UPDATE quotation_parts_tb SET Quantity = '$quantity', UnitPrice = '$unitPrice', TotalPrice = '$totalPrice' WHERE QuotationNumber = '$quotationNumber' AND PartDescription = '$partDescription'";

                if (!$conn->query($partUpdateQuery)) {
                    echo "<script>alert('Error updating part: " . $conn->error . "');</script>";
                    // Add additional logging or debugging information
                    echo "Quotation Number: " . $quotationNumber . "<br>";
                    echo "Part Description: " . $partDescription . "<br>";
                    echo "Quantity: " . $quantity . "<br>";
                    echo "Unit Price: " . $unitPrice . "<br>";
                    echo "Total Price: " . $totalPrice . "<br>";
                }
            }
        }

        echo "<script>alert('Quotation submitted successfully!');</script>";
        header("Location: serviceRequest_Admin.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $quotationInsertQuery . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Missing required form fields.');</script>";
}
?>