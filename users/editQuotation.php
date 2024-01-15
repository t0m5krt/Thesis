<?php
include 'includes/connection.php';
// include 'includes/header.php';
define('PAGE', 'Edit Quotation');


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>
    <button type="button" class="btn btn-danger" id="buttonFloat">
        <i class='bx bxs-arrow-to-left'></i> Back
    </button>


    <?php
    if (isset($_GET['SERVICE_REQUEST_ID'])) {
        // Retrieve the value of 'id' from the URL
        $SRN = $_GET['SERVICE_REQUEST_ID'];
        $quotationNumber = $_GET['QuotationNumber'];

        // Use the retrieved value in your SQL query
        $sql = "SELECT * FROM quotation_tb WHERE ServiceRequestID = '$SRN' AND QuotationNumber = '$quotationNumber'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Your code to display or process the data goes here
    ?>

                <h1><?php echo PAGE ?></h1>


                <form method="POST">

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
                                <input type="text" id="QuotationNumber" name="QuotationNumber" value="<?php echo $quotationNumber; ?>" readonly>
                            </div>

                        </div>

                        <div class="header-con">


                            <div class="header-item">
                                <label for="ServiceRequestId">Service Request ID:</label>
                                <input type="text" id="QuoteServiceRequestId" name="QuoteServiceRequestId" value="<?php echo $SRN; ?>" readonly>
                            </div>

                            <div class="header-item">
                                <label for="preparedBy">Prepared By:</label>
                                <input type="text" id="PreparedBy" name="PreparedBy" value="<?php echo $row['PreparedBy']; ?>" readonly>
                            </div>

                        </div>
                    </div>

                    <h1>Parts</h1>
                    <table id="quotationTable">
                        <tr>
                            <th>Part Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $quotationPartsQuery = "SELECT * FROM quotation_parts_tb WHERE QuotationNumber = '$quotationNumber' AND ServiceRequestID = '$SRN'";
                        $quotationPartsResult = $conn->query($quotationPartsQuery);

                        // Display quotation parts in a table
                        if ($quotationPartsResult->num_rows > 0) {
                            while ($quotationPartsRow = $quotationPartsResult->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td><input type="text" name="part_description[]" value="<?php echo $quotationPartsRow['PartDescription']; ?>" required></td>
                                    <td><input type="number" name="part_quantity[]" min="0" max="999" value="<?php echo $quotationPartsRow['Quantity']; ?>" required></td>
                                    <td><input type="number" name="part_price[]" min="0" max="999999" step="0.01" value="<?php echo $quotationPartsRow['UnitPrice']; ?>" required></td>
                                    <td><input type="text" name="part_total[]" value="<?php echo $quotationPartsRow['TotalPrice']; ?>" readonly></td>
                                    <td><button type="button" onclick="removeRow(this)" class="btn btn-danger">Remove</button></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<p>No parts found.</p>";
                        }
                        ?>
                    </table>

                    <div class="functionContainer">
                        <!-- <button type="button" onclick="addRow()" class="btn btn-secondary-disabled">Add Part</button> -->

                        <label for="subtotal">Subtotal:</label>
                        <input type="text" id="subtotal" name="subtotal" readonly>

                        <button type="button" onclick="calculateTotal()" class="btn btn-secondary">Calculate Total</button>
                        <button id="submitButton" name="submitPost" type="submit" class="btn btn-success">Submit Quotation</button>
                    </div>


                </form>
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
                                button.className = "btn btn-danger"; // Add the class "btn btn-primary"
                                button.onclick = function() {
                                    removeRow(this);
                                };
                                cell.appendChild(button);
                            }
                        }
                    }

                    function removeRow(button) {
                        var row = button.parentNode.parentNode;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, remove it!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                row.parentNode.removeChild(row);
                                calculateTotal();
                                Swal.fire("Removed!", "The item has been removed.", "success");
                            }
                        });

                        console.log(row);
                    }

                    function calculateTotal() {
                        var table = document.getElementById("quotationTable");

                        if (table && table.getElementsByTagName('tbody').length > 0) {
                            var tbody = table.getElementsByTagName('tbody')[0];

                            // Add a console log to check if tbody is defined
                            console.log("tbody:", tbody);

                            var rows = tbody.getElementsByTagName('tr');
                            var subtotal = 0;

                            for (var i = 0; i < rows.length; i++) {
                                var cells = rows[i].getElementsByTagName('td');

                                // Add a console log to check if cells is defined
                                console.log("cells:", cells);

                                if (cells.length >= 4) {
                                    var quantityInput = cells[1].getElementsByTagName('input')[0];
                                    var priceInput = cells[2].getElementsByTagName('input')[0];

                                    // Add console logs to check if quantityInput and priceInput are defined
                                    console.log("quantityInput:", quantityInput);
                                    console.log("priceInput:", priceInput);

                                    if (quantityInput && priceInput) {
                                        var quantity = parseFloat(quantityInput.value);
                                        var price = parseFloat(priceInput.value);

                                        if (!isNaN(quantity) && !isNaN(price)) {
                                            var total = quantity * price;
                                            subtotal += total;

                                            var totalInput = cells[3].getElementsByTagName('input')[0];
                                            if (totalInput) {
                                                totalInput.value = total.toFixed(2);
                                            }
                                        }
                                    }
                                }
                            }

                            var subtotalElement = document.getElementById("subtotal");

                            // Add a console log to check if subtotalElement is defined
                            console.log("subtotalElement:", subtotalElement);

                            if (subtotalElement) {
                                subtotalElement.value = subtotal.toFixed(2);
                            }
                        }
                    }


                    function generateQuotationNumber() {
                        var characters = '0123456789';
                        var quotationNumber = '';

                        for (var i = 0; i < 5; i++) {
                            var randomIndex = Math.floor(Math.random() * characters.length);
                            quotationNumber += characters.charAt(randomIndex);
                        }

                        return quotationNumber;
                    }

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

    <div class='alert alert-info'>
        "Please note that, for processing your request, you can only adjust the quantity of your parts; removal or modification of parts is allowed."
    </div>
</body>

</html>
<?php
include 'includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required keys are set in $_POST
    if (isset($_POST["part_description"], $_POST["part_quantity"], $_POST["part_price"])) {
        // $clientName = $_POST["ClientName"];
        // $preparedBy = $_POST["PreparedBy"];
        // $datePrepared = $_POST["DatePrepared"];
        // $quotationNumber = $_POST["QuotationNumber"];
        // $serviceRequestId = $_POST["QuoteServiceRequestId"];
        // $projectName = $_POST["ProjectName"];

        // Update part information in the QuotationParts table
        foreach ($_POST["part_description"] as $index => $partDescription) {
            $quantity = $_POST["part_quantity"][$index];
            $unitPrice = $_POST["part_price"][$index];
            $totalPrice = $quantity * $unitPrice;

            // Update query for each part
            $partUpdateQuery = "UPDATE quotation_parts_tb 
                       SET Quantity = '$quantity', 
                           UnitPrice = '$unitPrice', 
                           TotalPrice = '$totalPrice'
                       WHERE ServiceRequestID = '$SRN' AND QuotationNumber = '$quotationNumber' AND PartDescription = '$partDescription'";
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

        // Update quote_response in quotation_tb
        $quoteResponseUpdateQuery = "UPDATE quotation_tb 
                                     SET quote_response = 'Conditional accepted' 
                                     WHERE QuotationNumber = '$quotationNumber'";

        if (!$conn->query($quoteResponseUpdateQuery)) {
            echo "<script>alert('Error updating quote response: " . $conn->error . "');</script>";
            // Add additional logging or debugging information
            echo "Quotation Number: " . $quotationNumber . "<br>";
        }
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Quotation updated successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'history.php';
            });
        </script>
<?php
        exit();
    }
}
?>