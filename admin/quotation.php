<?php
    include 'includes/connection.php';


    // if (isset($_POST["submitPost"]) 
    // // && isset($_POST["ClientName"],
    // // $_POST["PreparedBy"], $_POST["DatePrepared"],
    // // $_POST["QuotationNumber"])
    
    // ) {
    //     $clientName = $_POST["ClientName"];
    //     $preparedBy = $_POST["PreparedBy"];
    //     $datePrepared = $_POST["DatePrepared"];
    //     $quotationNumber = $_POST["QuotationNumber"];

    //     echo 'Hey';

    // }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavy Equipment Parts Quotation</title>
    <style>
        

        
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        .header-con{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .header-item{
            padding-bottom: 10px;
        }
    
    </style>
</head>
<body>

    <h2>Heavy Equipment Parts Quotation</h2>

    <!-- action="quotation.php" -->

    <form  method="POST">

        <div id="header">

            <div class="header-con">

                <div class="header-item">
                    <label for="ClientName">Client Name:</label>
                    <input type="text" id="ClientName" name="ClientName">
                </div>

                <div class="header-item">
                    <label for="preparedBy">Prepared By:</label>
                    <input type="text" id="PreparedBy" name="PreparedBy">
                </div>

            </div>

            <div class="header-con">

                <div class="header-item">
                    <label for="DatePrepared">Date Prepared:</label>
                    <input type="date" id="DatePrepared" name="DatePrepared">     
                </div>

                <div class="header-item">
                    <label for="QuotationNumber">Quotation Number:</label>
                    <input type="text" id="QuotationNumber" name="QuotationNumber"> 
                </div>
                
            </div>

            <div class="header-con">


                <div class="header-item">
                    <label for="ServiceRequestId">Service Request ID:</label>
                    <input type="text" id="ServiceRequestId" name="ServiceRequestId">
                </div>

                <div class="header-item">
                    <label for="projectName">Project Name:</label>
                    <input type="text" id="projectName" name="ProjectName">    
                </div>

            </div>
            
        </div>

        <table id="quotationTable">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="part_description[]" required></td>
                    <td><input type="number" name="part_quantity[]" required></td>
                    <td><input type="number" name="part_price[]" step="0.01" required></td>
                    <td><input type="text" name="part_total[]" readonly></td>
                    <td><button type="button" onclick="removeRow(this)">Remove</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" onclick="addRow()">Add Part</button>

        <label for="subtotal">Subtotal:</label>
        <input type="text" id="subtotal" name="subtotal" readonly>

        <button type="button" onclick="calculateTotal()">Calculate Total</button>
        <button name="submitPost" type="submit">Submit Quotation</button>
    </form>

    <div id="disclaimer">
        <p><em>Note:</em> This quotation is subject to variations in rental fees and additional services that may be required to complete the service. The final costs may differ based on specific service needs and rental terms.</p>
    </div>

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
                    input.name = "part_description[]";
                    if (i === 1 || i === 2) {
                        input.type = "number";
                        input.step = "1";
                    } else if (i === 3) {
                        input.readOnly = true;
                    }
                    input.required = true;
                    cell.appendChild(input);
                } else {
                    var button = document.createElement("button");
                    button.type = "button";
                    button.textContent = "Remove";
                    button.onclick = function() { removeRow(this); };
                    cell.appendChild(button);
                }
            }
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            calculateTotal();
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
        
        // JavaScript or jQuery code to dynamically update quotationNumber and serviceRequestId
        document.getElementById('quotationNumber').value = generateQuotationNumber();
        document.getElementById('serviceRequestId').value = generateServiceRequestId();

        function generateQuotationNumber() {
            // Logic to generate a unique quotation number (you may use timestamp, random number, etc.)
            // Example: return 'QN' + Date.now();
        }

        function generateServiceRequestId() {
            // Logic to generate a unique service request ID
            // Example: return 'SR' + Date.now();
        }
    
    </script>

</body>
</html>

<?php
        function generateQuotationNumber() {
            return 'QN' . time();
        }
        
        function generateServiceRequestId() {
            return 'SR' . time();
        }
        
        
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required keys are set in $_POST
    if (isset($_POST["ClientName"], $_POST["PreparedBy"], $_POST["DatePrepared"], $_POST["ProjectName"], $_POST["QuotationNumber"])) {
        $clientName = $_POST["ClientName"];
        $preparedBy = $_POST["PreparedBy"];
        $datePrepared = $_POST["DatePrepared"];
        $quotationNumber = generateQuotationNumber();
        $serviceRequestId = generateServiceRequestId();
        $projectName = $_POST["ProjectName"];

        // Insert the quotation information into the Quotation table
        $quotationInsertQuery = "INSERT INTO quotation_tb (ClientName, PreparedBy, DatePrepared, QuotationNumber, ServiceRequestID, ProjectName) 
                                 VALUES ('$clientName', '$preparedBy', '$datePrepared', '$quotationNumber', '$serviceRequestId', '$projectName')";

        if ($connection->query($quotationInsertQuery) === TRUE) {
            $quotationID = $connection->insert_id; // Get the ID of the last inserted row

            // Insert part information into the QuotationParts table
            // (You need to adjust this part based on the structure of your form and table)
            foreach ($_POST["PartDescription"] as $index => $partDescription) {
                $quantity = $_POST["Quantity"][$index];
                $unitPrice = $_POST["UnitPrice"][$index];
                $totalPrice = $quantity * $unitPrice;

                $partInsertQuery = "INSERT INTO quotation_parts_tb (QuotationID, PartDescription, Quantity, UnitPrice, TotalPrice) 
                                    VALUES ('$quotationID', '$partDescription', '$quantity', '$unitPrice', '$totalPrice')";

                if (!$connection->query($partInsertQuery)) {
                    echo "Error inserting part: " . $connection->error;
                }
            }

            echo "Quotation submitted successfully!";
        } else {
            echo "Error: " . $quotationInsertQuery . "<br>" . $connection->error;
        }
    } else {
        echo "Missing required form fields.";
    }
}

// $connection->close();
?>