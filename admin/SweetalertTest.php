<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Center the button */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>

    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>


<body>

    <input type="text" id="nameInput" placeholder="Enter Name">
    <button id="viewRequest">View</button>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <style>
        form {
            display: grid;
            gap: 10px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"] {
            width: 10rem;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"]:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        button[type="submit"]:empty {
            background-color: #cccccc;
        }
    </style>

    <script>
        document.getElementById('viewRequest').addEventListener('click', function() {
            const nameInput = document.getElementById('nameInput').value;

            Swal.fire({
                title: 'Request Form',
                html: `
                        <form method="POST" action="process_form.php">
                            <label for="requestId">Request ID:</label>
                            <input type="text" name="requestId" id="requestId"  value="0123" required disabled>

                            <label for="requester">Requester:</label>
                            <input type="text" name="requester" id="requester" value="${nameInput}" required>

                            <label for="requestDate">Request Date:</label>
                            <input type="date" name="requestDate" id="requestDate" value="2022-01-01" required>

                            <label for="contactNumber">Contact Number:</label>
                            <input type="tel" name="contactNumber" id="contactNumber" value="1234567890" required>

                            <label for="address">Address:</label>
                            <input type="text" name="address" id="address" value="123 Main St" required>

                            <label for="businessUnit">Business Unit:</label>
                            <input type="text" name="businessUnit" id="businessUnit" value="Sales" required>

                            <label for="projectName">Project Name:</label>
                            <input type="text" name="projectName" id="projectName" value="Project X" required>

                            <label for="assetCode">Asset Code:</label>
                            <input type="text" name="assetCode" id="assetCode" value="ABC123" required>

                            <label for="requesterModel">Requester Model:</label>
                            <input type="text" name="requesterModel" id="requesterModel" value="Model A" required>

                            <label for="serialNumber">Serial Number:</label>
                            <input type="text" name="serialNumber" id="serialNumber" value="SN123" required>

                            <label for="equipDesc">Equipment Description:</label>
                            <input type="text" name="equipDesc" id="equipDesc" value="Description" required>

                            <label for="requestBrand">Request Brand:</label>
                            <input type="text" name="requestBrand" id="requestBrand" value="Brand X" required>

                            <label for="serviceMeter">Service Meter:</label>
                            <input type="text" name="serviceMeter" id="serviceMeter" value="1000" required>

                            <label for="requestType">Request Type:</label>
                            <input type="text" name="requestType" id="requestType" value="Type A" required>

                            <label for="additionalOption">Additional Option:</label>
                            <input type="text" name="additionalOption" id="additionalOption" value="Option A" required>

                            <label for="requestCharging">Request Charging:</label>
                            <input type="text" name="requestCharging" id="requestCharging" value="Charging A" required>

                            <label for="unitProblem">Unit Problem:</label>
                            <input type="text" name="unitProblem" id="unitProblem" value="Problem A" required>

                            <label for="others">Others:</label>
                            <input type="text" name="others" id="others" value="Other details" required>

                            <label for="unitOperational">Unit Operational:</label>
                            <input type="text" name="unitOperational" id="unitOperational" value="Operational" required>

                            <label for="specificRequirement">Specific Requirement:</label>
                            <input type="text" name="specificRequirement" id="specificRequirement" value="Requirement A" required>

                            <label for="onsiteContact">Onsite Contact:</label>
                            <input type="text" name="onsiteContact" id="onsiteContact" value="John Smith" required>

                            <label for="faxNumber">Fax Number:</label>
                            <input type="tel" name="faxNumber" id="faxNumber" value="9876543210" required>

                            <button type="submit">Submit</button>
                    </form>
    `,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    // Handle form submission here
                    // You can use AJAX or submit the form normally
                }
            });
        });

        $('form').submit(function(e) {
            var isValid = true;

            // Check each input in the form
            $('input').each(function() {
                if ($.trim($(this).val()) === '') {
                    $(this).css('border-color', 'red'); // Change border color to red
                    isValid = false;
                } else {
                    $(this).css('border-color', ''); // Reset border color
                }
            });

            // If any field is empty, prevent form submission
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>