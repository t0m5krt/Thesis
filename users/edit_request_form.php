<?php

$SERVICE_REQUEST_ID = $_GET['SERVICE_REQUEST_ID'];
include 'includes/connection.php';
if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}

// Retrieve the user's ID from the session
$user_id = $_SESSION['userID'];

// Query the database to get the user's name
$sql = "SELECT a.*, b.*  FROM user_accounts AS a JOIN submit_requests AS b
WHERE b.SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID' 
AND a.user_ID = '$user_id';";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['firstname'];
    $user_lastname = $row['lastname'];
    $user_contactnumber = $row['contactnumber'];
    $requestor = $row['requestor'];
    $user_fullname = $user_name . ' ' . $user_lastname;
    $mobile_or_phone_no = $row['mobile_or_phone_no'];
    $address = $row['address'];
    $business_unit = $row['business_unit'];
    $cust_project_name = $row['cust_project_name'];

    $sort_value = $row['sort_value'];
    $model = $row['model'];
    $brand = $row['brand'];
    $type_of_request = $row['type_of_request'];
    $additional_option = $row['additional_option'];
    $other_service_request = $row['other_service_request'];
    $unit_problem = $row['unit_problem'];
    $unit_operational = $row['unit_operational'];

?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8" />
        <title>Edit Service Request Form</title>
        <link rel="stylesheet" href="styles/service-request-design.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            function redirectToAdditionalForm() {
                window.location = "additional_form.php";
            }

            var var1 = 0;

            function addUnitProblemRow() {
                // Clone the brand element
                var selectElementBrand = document.getElementById("brand");
                var cloneBrand = selectElementBrand.cloneNode(true);
                var currentIdBrand = cloneBrand.id;
                var newIdBrand = currentIdBrand + var1;
                cloneBrand.id = newIdBrand;
                cloneBrand.name = newIdBrand; // Make sure to update the name attribute
                cloneBrand.value = "";
                cloneBrand.style.display = "inline-block";

                // Create a new label for the cloned brand element
                var labelBrand = document.createElement("label");
                labelBrand.for = newIdBrand;
                labelBrand.textContent = "Brand & Unit Problem " + (var1 + 1); // Dynamic label text
                labelBrand.style.display = "block";

                // Clone the unit problem element
                var selectElementProblem = document.getElementById("unit_problem");
                var cloneProblem = selectElementProblem.cloneNode(true);
                var currentIdProblem = cloneProblem.id;
                var newIdProblem = currentIdProblem + var1;
                cloneProblem.id = newIdProblem;
                cloneProblem.name = newIdProblem; // Make sure to update the name attribute
                cloneProblem.value = "";
                cloneProblem.style.display = "inline-block";

                // Create a new label for the cloned unit problem element
                var labelProblem = document.createElement("label");
                labelProblem.for = newIdProblem;
                labelProblem.textContent = ""; // Add label text if needed
                labelProblem.style.display = "block";

                // Append the labels and cloned elements to the parent node
                selectElementBrand.parentNode.appendChild(labelBrand);
                selectElementBrand.parentNode.appendChild(cloneBrand);
                selectElementProblem.parentNode.appendChild(labelProblem);
                selectElementProblem.parentNode.appendChild(cloneProblem);

                var1++;

                redisplayBrandUnitProblem(); // Call the function to redisplay the elements
            }


            function removeBrandRow(button) {
                var selectElement = button.parentNode.querySelector("select");
                var brandId = selectElement.id;
                var problemId = brandId.replace("brand", "unit_problem");

                selectElement.parentNode.removeChild(selectElement.parentNode.lastChild);
                document.getElementById(problemId).parentNode.removeChild(document.getElementById(problemId));
            }

            function redisplayBrandUnitProblem() {
                var brandSelects = document.querySelectorAll("[id^='brand']");
                var problemSelects = document.querySelectorAll("[id^='unit_problem']");

                brandSelects.forEach(function(select) {
                    select.style.display = "inline-block";
                });

                problemSelects.forEach(function(select) {
                    select.style.display = "inline-block";
                });
            }
        </script>
    </head>

    <body>

        <div class="loader">
            <div class="custom-loader">

            </div>
        </div>
        <form action="edit_request_form.php?SERVICE_REQUEST_ID=<?php $SERVICE_REQUEST_ID = $_GET['SERVICE_REQUEST_ID'];
                                                                echo $SERVICE_REQUEST_ID ?>" method="post">
            <div class="form-title">
                <h3>Edit Service Request Form</h3>
                <p>Enter your concern details to a service request</p>
                <br />
            </div>
            <div class="form-group">
                <label for="requestor">REQUESTOR <span style="color: red;">*</span></label>
                <input type="text" id="requestor" name="requestor" required readonly />
            </div>
            <div class="form-group" style="display: none;">
                <label for="date_of_request">DATE OF REQUEST <span style="color: red;">*</span></label>
                <?php
                date_default_timezone_set('Asia/Manila');
                $currentDateTime = date('Y-m-d\TH:i');
                ?>
                <input type="datetime-local" id="date_of_request" name="date_of_request" value="<?php echo $currentDateTime; ?>" />
            </div>
            <div class="form-group">
                <label for="mobile_or_phone_no">MOBILE/PHONE NO. <span style="color: red;">*</span></label>
                <input type="text" id="mobile_or_phone_no" name="mobile_or_phone_no" maxlength="11" placeholder="09XX-XXX-XXXX" value="<?php echo $mobile_or_phone_no ?>" required />
            </div>
            <div class="form-group">
                <label for="address">ADDRESS <span style="color: red;">*</span></label>
                <input type="text" id="address" name="address" required value="<?php echo $address ?>" />
            </div>
            <div class="form-group">
                <label for="business_unit">BUSINESS UNIT <span style="color: red;">*</span></label>
                <select id="business_unit" name="business_unit" required>
                    <option value="" disabled <?php if ($business_unit === "") echo 'selected'; ?>>Select option</option>
                    <option value="Commercial Construction" <?php if ($business_unit === "Commercial Construction") echo 'selected'; ?>>Commercial construction</option>
                    <option value="Residential Construction" <?php if ($business_unit === "Residential Construction") echo 'selected'; ?>>Residential construction</option>
                    <option value="Infrastructure Construction" <?php if ($business_unit === "Infrastructure Construction") echo 'selected'; ?>>Infrastructure construction</option>
                    <option value="Heavy Construction" <?php if ($business_unit === "Heavy Construction") echo 'selected'; ?>>Heavy construction</option>
                    <option value="Specialty Construction" <?php if ($business_unit === "Specialty Construction") echo 'selected'; ?>>Specialty construction</option>
                    <option value="Industrial" <?php if ($business_unit === "Industrial") echo 'selected'; ?>>Industrial</option>
                    <option value="Power Generation" <?php if ($business_unit === "Power Generation") echo 'selected'; ?>>Power generation</option>
                    <option value="Mining" <?php if ($business_unit === "Mining") echo 'selected'; ?>>Mining</option>
                    <option value="Oil & Gas" <?php if ($business_unit === "Oil & Gas") echo 'selected'; ?>>Oil & Gas</option>
                    <option value="Others" <?php if ($business_unit === "Others") echo 'selected'; ?>>Others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cust_project_name">CUST./PROJECT NAME <span style="color: red;">*</span></label>
                <input type="text" id="cust_project_name" name="cust_project_name" required />
            </div>

            <div class="form-group">
                <label for="type_of_request">TYPE OF REQUEST <span style="color: red;">*</span></label>
                <select id="type_of_request" name="type_of_request" required>
                    <option value="" disabled <?php if ($type_of_request === "") echo 'selected'; ?>>Select option</option>
                    <option value="Quotation - Major Repair" <?php if ($type_of_request === "Quotation - Major Repair") echo 'selected'; ?>>Quotation - Major Repair</option>
                    <option value="Quotation - Minor Repair" <?php if ($type_of_request === "Quotation - Minor Repair") echo 'selected'; ?>>Quotation - Minor Repair</option>
                    <option value="Quotation Parts" <?php if ($type_of_request === "Quotation Parts") echo 'selected'; ?>>Quotation - Parts</option>
                    <option value="Preventive Maintenance" <?php if ($type_of_request === "Preventive Maintenance") echo 'selected'; ?>>Preventive Maintenance</option>
                    <option value="EQC Inspection" <?php if ($type_of_request === "EQC Inspection") echo 'selected'; ?>>EQC Inspection</option>
                    <option value="Technical Evaluation Request" <?php if ($type_of_request === "Technical Evaluation Request") echo 'selected'; ?>>Technical Evaluation Request</option>
                    <option value="Service Request" <?php if ($type_of_request === "Service Request") echo 'selected'; ?>>Service Request</option>
                </select>

                <div id="additional_option_group" class="form-group" style="display: none">
                    <label for="additional_option"> Select:</label>
                    <select name="additional_option" id="additional_option">
                        <option value="" disabled selected>Select option</option>
                        <option value="Emergency Call">Emergency Call (Waver Required)</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div id="other_service_request_input" class="form-group" style="display: none">
                    <label for="other_service_request,">OTHERS:</label>
                    <input type="text" id="other_service_request," name="other_service_request," placeholder="Specify Here:" />
                </div>


            </div>

            <br />
            <div class="form-title">
                <h3>Unit Details / Problem</h3>
            </div>
            <br />

            <div class="form-group">
                <label for="model">MODEL <span style="color: red;">*</span></label>
                <input type="text" id="model" name="model" value="<?php echo $model ?>" required />
            </div>

            <div class="form-group">
                <label for="brand">BRAND & UNIT PROBLEM<span style="color: red;">*</span></label>
                <select id="brand" name="brand" required>
                    <option value="" disabled <?php if ($brand === "") echo 'selected'; ?>>Select Brand option</option>
                    <optgroup label="Earthmoving Equipment">
                    <optgroup label="Dozers">
                        <option value="caterpillar-dozer" <?php if ($brand === "caterpillar-dozer") echo 'selected'; ?>>Caterpillar</option>
                        <option value="komatsu-dozer" <?php if ($brand === "komatsu-dozer") echo 'selected'; ?>>Komatsu</option>
                        <option value="john-deere-dozer" <?php if ($brand === "john-deere-dozer") echo 'selected'; ?>>John Deere</option>
                        <option value="liebherr-dozer" <?php if ($brand === "liebherr-dozer") echo 'selected'; ?>>Liebherr</option>
                        <option value="terex-dozer" <?php if ($brand === "terex-dozer") echo 'selected'; ?>>Terex</option>
                    </optgroup>
                    <optgroup label="Excavators">
                        <option value="caterpillar-excavator" <?php if ($brand === "caterpillar-excavator") echo 'selected'; ?>>Caterpillar</option>
                        <option value="komatsu-excavator" <?php if ($brand === "komatsu-excavator") echo 'selected'; ?>>Komatsu</option>
                        <option value="hitachi-excavator" <?php if ($brand === "hitachi-excavator") echo 'selected'; ?>>Hitachi</option>
                        <option value="volvo-excavator" <?php if ($brand === "volvo-excavator") echo 'selected'; ?>>Volvo Construction Equipment</option>
                        <option value="jcb-excavator" <?php if ($brand === "jcb-excavator") echo 'selected'; ?>>JCB</option>
                    </optgroup>
                    <optgroup label="Loaders">
                        <option value="caterpillar-loader" <?php if ($brand === "caterpillar-excavator") echo 'selected'; ?>>Caterpillar</option>
                        <option value="komatsu-loader" <?php if ($brand === "komatsu-loader") echo 'selected'; ?>>Komatsu</option>
                        <option value="john-deere-loader" <?php if ($brand === "john-deere-loader") echo 'selected'; ?>>John Deere</option>
                        <option value="bobcat-loader" <?php if ($brand === "bobcat-loader") echo 'selected'; ?>>Bobcat</option>
                        <option value="case-loader" <?php if ($brand === "case-loader") echo 'selected'; ?>>Case</option>
                    </optgroup>
                    <optgroup label="Backhoe Loaders">
                        <option value="john-deere-backhoe" <?php if ($brand === "john-deere-backhoe") echo 'selected'; ?>>John Deere</option>
                        <option value="new-holland-backhoe" <?php if ($brand === "new-holland-backhoe") echo 'selected'; ?>>New Holland</option>
                        <option value="case-backhoe" <?php if ($brand === "case-backhoe") echo 'selected'; ?>>Case</option>
                        <option value="kubota-backhoe" <?php if ($brand === "kubota-backhoe") echo 'selected'; ?>>Kubota</option>
                        <option value="jcb-backhoe" <?php if ($brand === "jcb-backhoe") echo 'selected'; ?>>JCB</option>
                    </optgroup>
                    <optgroup label="Skid Steer Loaders">
                        <option value="bobcat-skidsteer" <?php if ($brand === "bobcat-skidsteer") echo 'selected'; ?>>Bobcat</option>
                        <option value="caterpillar-skidsteer" <?php if ($brand === "caterpillar-skidsteer") echo 'selected'; ?>>Caterpillar</option>
                        <option value="john-deere-skidsteer" <?php if ($brand === "john-deere-skidsteer") echo 'selected'; ?>>John Deere</option>
                        <option value="kubota-skidsteer" <?php if ($brand === "kubota-skidsteer") echo 'selected'; ?>>Kubota</option>
                        <option value="case-skidsteer" <?php if ($brand === "case-skidsteer") echo 'selected'; ?>>Case</option>
                    </optgroup>
                    <optgroup label="Track Loaders">
                        <option value="caterpillar-trackloader" <?php if ($brand === "bobcat-trackloader") echo 'selected'; ?>>Caterpillar</option>
                        <option value="komatsu-trackloader" <?php if ($brand === "komatsu-trackloader") echo 'selected'; ?>>Komatsu</option>
                        <option value="john-deere-trackloader" <?php if ($brand === "john-deere-trackloader") echo 'selected'; ?>>John Deere</option>
                        <option value="liebherr-trackloader" <?php if ($brand === "liebherr-trackloader") echo 'selected'; ?>>Liebherr</option>
                        <option value="terex-trackloader" <?php if ($brand === "terex-trackloader") echo 'selected'; ?>>Terex</option>
                    </optgroup>
                    <optgroup label="Motor Graders">
                        <option value="caterpillar-motorgrader" <?php if ($brand === "caterpillar-motorgrader") echo 'selected'; ?>>Caterpillar</option>
                        <option value="john-deere-motorgrader" <?php if ($brand === "john-deere-motorgrader") echo 'selected'; ?>>John Deere</option>
                        <option value="volvo-motorgrader" <?php if ($brand === "volvo-motorgrader") echo 'selected'; ?>>Volvo Construction Equipment</option>
                        <option value="komatsu-motorgrader" <?php if ($brand === "komatsu-motorgrader") echo 'selected'; ?>>Komatsu</option>
                        <option value="wirtgen-motorgrader" <?php if ($brand === "wirtgen-motorgrader") echo 'selected'; ?>>Wirtgen</option>
                    </optgroup>
                    <optgroup label="Compact Track Loaders">
                        <option value="bobcat-compacttrackloader" <?php if ($brand === "bobcat-compacttrackloader") echo 'selected'; ?>>Bobcat</option>
                        <option value="caterpillar-compacttrackloader" <?php if ($brand === "caterpillar-compacttrackloader") echo 'selected'; ?>>Caterpillar</option>
                        <option value="john-deere-compacttrackloader" <?php if ($brand === "john-deere-compacttrackloader") echo 'selected'; ?>>John Deere</option>
                        <option value="kubota-compacttrackloader" <?php if ($brand === "kubota-compacttrackloader") echo 'selected'; ?>>Kubota</option>
                        <option value="case-compacttrackloader" <?php if ($brand === "case-compacttrackloader") echo 'selected'; ?>>Case</option>
                    </optgroup>
                    <optgroup label="Wheel Tractor-Scrapers">
                        <option value="caterpillar-wheeltractor-scraper" <?php if ($brand === "caterpillar-wheeltractor-scraper") echo 'selected'; ?>>Caterpillar</option>
                        <option value="john-deere-wheeltractor-scraper" <?php if ($brand === "john-deere-wheeltractor-scraper") echo 'selected'; ?>>John Deere</option>
                        <option value="terex-wheeltractor-scraper" <?php if ($brand === "terex-wheeltractor-scraper") echo 'selected'; ?>>Terex</option>
                        <option value="komatsu-wheeltractor-scraper" <?php if ($brand === "komatsu-wheeltractor-scraper") echo 'selected'; ?>>Komatsu</option>
                        <option value="volvo-wheeltractor-scraper" <?php if ($brand === "volvo-wheeltractor-scraper") echo 'selected'; ?>>Volvo Construction Equipment</option>
                    </optgroup>
                    </optgroup>

                    <optgroup label="Trucks">
                    <optgroup label="Off-Highway Trucks">
                        <option value="caterpillar-offhighway" <?php if ($brand === "caterpillar-offhighway") echo 'selected'; ?>>Caterpillar</option>
                        <option value="komatsu-offhighway" <?php if ($brand === "komatsu-offhighway") echo 'selected'; ?>>Komatsu</option>
                        <option value="terex-offhighway" <?php if ($brand === "terex-offhighway") echo 'selected'; ?>>Terex</option>
                        <option value="hitachi-offhighway" <?php if ($brand === "hitachi-offhighway") echo 'selected'; ?>>Hitachi</option>
                        <option value="volvo-offhighway" <?php if ($brand === "volvo-offhighway") echo 'selected'; ?>>Volvo Construction Equipment</option>
                    </optgroup>
                    <optgroup label="Articulated Dump Trucks">
                        <option value="bell-equipment-dumptruck" <?php if ($brand === "bell-equipment-dumptruck") echo 'selected'; ?>>Bell Equipment</option>
                        <option value="caterpillar-dumptruck" <?php if ($brand === "caterpillar-dumptruck") echo 'selected'; ?>>Caterpillar</option>
                        <option value="volvo-dumptruck" <?php if ($brand === "volvo-dumptruck") echo 'selected'; ?>>Volvo Construction Equipment</option>
                        <option value="komatsu-dumptruck" <?php if ($brand === "komatsu-dumptruck") echo 'selected'; ?>>Komatsu</option>
                        <option value="terex-dumptruck" <?php if ($brand === "terex-dumptruck") echo 'selected'; ?>>Terex</option>
                    </optgroup>
                    <optgroup label="Concrete Mixers">
                        <option value="oshkosh-concretemixer" <?php if ($brand === "oshkosh-concretemixer") echo 'selected'; ?>>Oshkosh</option>
                        <option value="mack-concretemixer" <?php if ($brand === "mack-concretemixer") echo 'selected'; ?>>Mack</option>
                        <option value="international-concretemixer" <?php if ($brand === "international-concretemixer") echo 'selected'; ?>>International</option>
                        <option value="volvo-trucks-concretemixer" <?php if ($brand === "volvo-trucks-concretemixer") echo 'selected'; ?>>Volvo Trucks</option>
                        <option value="scania-concretemixer" <?php if ($brand === "scania-concretemixer") echo 'selected'; ?>>Scania</option>
                    </optgroup>
                    <optgroup label="Dump Trucks">
                        <option value="peterbilt-dumptruck" <?php if ($brand === "peterbilt-dumptruck") echo 'selected'; ?>>Peterbilt</option>
                        <option value="kenworth-dumptruck" <?php if ($brand === "kenworth-dumptruck") echo 'selected'; ?>>Kenworth</option>
                        <option value="freightliner-dumptruck" <?php if ($brand === "freightliner-dumptruck") echo 'selected'; ?>>Freightliner</option>
                        <option value="mack-dumptruck" <?php if ($brand === "mack-dumptruck") echo 'selected'; ?>>Mack</option>
                        <option value="western-star-dumptruck" <?php if ($brand === "Western-star-dumptruck") echo 'selected'; ?>>Western Star</option>
                    </optgroup>
                    </optgroup>

                    <optgroup label="Cranes">
                    <optgroup label="Mobile Cranes">
                        <option value="grove-mobilecrane" <?php if ($brand === "grove-mobilecrane") echo 'selected'; ?>>Grove</option>
                        <option value="manitowoc-mobilecrane" <?php if ($brand === "manitowoc-mobilecrane") echo 'selected'; ?>>Manitowoc</option>
                        <option value="liebherr-mobilecrane" <?php if ($brand === "liebherr-mobilecrane") echo 'selected'; ?>>Liebherr</option>
                        <option value="demag-mobilecrane" <?php if ($brand === "demag-mobilecrane") echo 'selected'; ?>>Demag</option>
                        <option value="tadano-mobilecrane" <?php if ($brand === "tadano-mobilecrane") echo 'selected'; ?>>Tadano</option>
                    </optgroup>
                    <optgroup label="Rough Terrain Cranes">
                        <option value="grove-roughterraincrane" <?php if ($brand === "grove-roughterraincrane") echo 'selected'; ?>>Grove</option>
                        <option value="manitowoc-roughterraincrane" <?php if ($brand === "manitowoc-roughterraincrane") echo 'selected'; ?>>Manitowoc</option>
                        <option value="terex-roughterraincrane" <?php if ($brand === "terex-roughterraincrane") echo 'selected'; ?>>Terex</option>
                        <option value="demag-roughterraincrane" <?php if ($brand === "demag-roughterraincrane") echo 'selected'; ?>>Demag</option>
                        <option value="kobelco-roughterraincrane" <?php if ($brand === "kobelco-roughterraincrane") echo 'selected'; ?>>Kobelco</option>
                    </optgroup>
                    <optgroup label="Crawler Cranes">
                        <option value="liebherr-crawlercrane" <?php if ($brand === "liebherr-crawlercrane") echo 'selected'; ?>>Liebherr</option>
                        <option value="demag-crawlercrane" <?php if ($brand === "demag-crawlercrane") echo 'selected'; ?>>Demag</option>
                        <option value="manitowoc-crawlercrane" <?php if ($brand === "manitowoc-crawlercrane") echo 'selected'; ?>>Manitowoc</option>
                        <option value="sennebogen-crawlercrane" <?php if ($brand === "sennebogen-crawlercrane") echo 'selected'; ?>>Sennebogen</option>
                        <option value="hitachi-crawlercrane" <?php if ($brand === "hitachi-crawlercrane") echo 'selected'; ?>>Hitachi</option>
                    </optgroup>
                    <optgroup label="Tower Cranes">
                        <option value="potain-towercrane" <?php if ($brand === "potain-towercrane") echo 'selected'; ?>>Potain</option>
                        <option value="liebherr-towercrane" <?php if ($brand === "liebherr-towercrane") echo 'selected'; ?>>Liebherr</option>
                        <option value="wolffkran-towercrane" <?php if ($brand === "wolffkran-towercrane") echo 'selected'; ?>>Wolffkran</option>
                        <option value="terex-towercrane" <?php if ($brand === "terex-towercrane") echo 'selected'; ?>>Terex</option>
                        <option value="linden-comansa-towercrane" <?php if ($brand === "linden-comansa-towercrane") echo 'selected'; ?>>Linden Comansa</option>
                    </optgroup>
                    </optgroup>

                    <optgroup label="Other Equipment">
                    <optgroup label="Concrete Pumps">
                        <option value="putzmeister-concretepump" <?php if ($brand === "putzmeister-concretepump") echo 'selected'; ?>>Putzmeister</option>
                        <option value="schwing-stetter-concretepump" <?php if ($brand === "schwing-stetter-concretepump") echo 'selected'; ?>>Schwing-Stetter</option>
                        <option value="aalmac-concretepump" <?php if ($brand === "aalmac-concretepump") echo 'selected'; ?>>Aalmac</option>
                        <option value="cifa-concretepump" <?php if ($brand === "cifa-concretepump") echo 'selected'; ?>>CIFA</option>
                        <option value="bsa-concretepump" <?php if ($brand === "bsa-concretepump") echo 'selected'; ?>>BSA</option>
                    </optgroup>
                    <optgroup label="Paving Equipment">
                        <option value="vogele-pavingequipment" <?php if ($brand === "vogele-pavingequipment") echo 'selected'; ?>>Vögele</option>
                        <option value="dynapac-pavingequipment" <?php if ($brand === "dynapac-pavingequipment") echo 'selected'; ?>>Dynapac</option>
                        <option value="bomag-pavingequipment" <?php if ($brand === "bomag-pavingequipment") echo 'selected'; ?>>BOMAG</option>
                        <option value="wirtgen-pavingequipment" <?php if ($brand === "wirtgen-pavingequipment") echo 'selected'; ?>>Wirtgen</option>
                        <option value="ammann-pavingequipment" <?php if ($brand === "ammann-pavingequipment") echo 'selected'; ?>>Ammann</option>
                    </optgroup>
                    <optgroup label="Asphalt Pavers">
                        <option value="vogele-asphaltpaver" <?php if ($brand === "vogele-asphaltpaver") echo 'selected'; ?>>Vögele</option>
                        <option value="dynapac-asphaltpaver" <?php if ($brand === "dynapac-asphaltpaver") echo 'selected'; ?>>Dynapac</option>
                        <option value="bomag-asphaltpaver" <?php if ($brand === "bomag-asphaltpaver") echo 'selected'; ?>>BOMAG</option>
                        <option value="wirtgen-asphaltpaver" <?php if ($brand === "wirtgen-asphaltpaver") echo 'selected'; ?>>Wirtgen</option>
                        <option value="ammann-asphaltpaver" <?php if ($brand === "ammann-asphaltpaver") echo 'selected'; ?>>Ammann</option>
                    </optgroup>
                    <optgroup label="Rollers">
                        <option value="hamm-roller" <?php if ($brand === "hamm-roller") echo 'selected'; ?>>Hamm</option>
                        <option value="dynapac-roller" <?php if ($brand === "dynapac-roller") echo 'selected'; ?>>Dynapac</option>
                        <option value="bomag-roller" <?php if ($brand === "bomag-roller") echo 'selected'; ?>>BOMAG</option>
                        <option value="ammann-roller" <?php if ($brand === "ammann-roller") echo 'selected'; ?>>Ammann</option>
                        <option value="vogele-roller" <?php if ($brand === "vogele-roller") echo 'selected'; ?>>Vögele</option>
                    </optgroup>
                    <optgroup label="Generators">
                        <option value="caterpillar-generator" <?php if ($brand === "caterpillar-generator") echo 'selected'; ?>>Caterpillar</option>
                        <option value="cummins-generator" <?php if ($brand === "cummins-generator") echo 'selected'; ?>>Cummins</option>
                        <option value="generac-generator" <?php if ($brand === "generac-generator") echo 'selected'; ?>>Generac</option>
                        <option value="kohler-generator" <?php if ($brand === "kohler-generator") echo 'selected'; ?>>Kohler</option>
                        <option value="john-deere-generator" <?php if ($brand === "john-deere-generator") echo 'selected'; ?>>John Deere</option>
                    </optgroup>
                    <optgroup label="Forklifts">
                        <option value="toyota-forklift" <?php if ($brand === "toyota-forklift") echo 'selected'; ?>>Toyota</option>
                        <option value="hyster-yale-forklift" <?php if ($brand === "hyster-yale-forklift") echo 'selected'; ?>>Hyster-Yale</option>
                        <option value="caterpillar-forklift" <?php if ($brand === "caterpillar-forklift") echo 'selected'; ?>>Caterpillar</option>
                        <option value="clark-forklift" <?php if ($brand === "clark-forklift") echo 'selected'; ?>>Clark</option>
                        <option value="komatsu-forklift" <?php if ($brand === "komatsu-forklift") echo 'selected'; ?>>Komatsu</option>
                    </optgroup>
                    </optgroup>
                </select>




                <select id="unit_problem" name="unit_problem" required>
                    <option value="" disabled selected>Select Unit Problem option</option>
                    <option value="Engine failure" <?php if ($unit_problem === "Engine failure") echo 'selected'; ?>>Engine failure</option>
                    <option value="Hydraulic leaks" <?php if ($unit_problem === "Hydraulic leaks") echo 'selected'; ?>>Hydraulic leaks</option>
                    <option value="Electrical malfunctions" <?php if ($unit_problem === "Electrical malfunctions") echo 'selected'; ?>>Electrical malfunctions</option>
                    <option value="Braking problems" <?php if ($unit_problem === "Braking problems") echo 'selected'; ?>>Braking problems</option>
                    <option value="Transmission problems" <?php if ($unit_problem === "Transmission problems") echo 'selected'; ?>>Transmission problems</option>
                    <option value="Tire problems" <?php if ($unit_problem === "Tire problems") echo 'selected'; ?>>Tire problems</option>
                    <option value="Attachment problems" <?php if ($unit_problem === "Attachment problems") echo 'selected'; ?>>Attachment problems</option>
                    <option value="Others" <?php if ($unit_problem === "Others") echo 'selected'; ?>>Others</option>
                </select>
            </div>
            <button type="button" onclick="addUnitProblemRow()" class="btn btn-danger">Add Brand & Unit Problem</button>
            <button type="button" class="btn btn-danger" onclick="removeBrandRow(this)">Remove</button>

            <div class="form-group">
                <label for="unit_operational">UNIT OPERATIONAL <span style="color: red;">*</span></label>
                <select id="unit_operational" name="unit_operational" required>
                    <option value="" disabled selected>Select option</option>
                    <option value="Yes" <?php if ($unit_operational === "Yes") echo 'selected'; ?>>Yes</option>
                    <option value="No" <?php if ($unit_operational === "No") echo 'selected'; ?>>No</option>
                </select>
            </div>


            <button type="submit">Submit</button>
        </form>

    <?php include 'includes/scripts.php';
}
    ?>
    <script>
        document.getElementById('requestor').value = "<?php echo $requestor ?>";
        document.getElementById('mobile_or_phone_no').value = "<?php echo $mobile_or_phone_no ?>";
        document.getElementById('cust_project_name').value = "<?php echo $cust_project_name; ?>";
        // For Hiding option group on creating service request
        document.addEventListener("DOMContentLoaded", function() {
            var typeOfRequest = document.getElementById("type_of_request");
            var additionalOptionGroup = document.getElementById("additional_option_group");
            var otherAdditionalOption = document.getElementById("additional_option");
            var otherServiceRequestInput = document.getElementById("other_service_request_input");

            typeOfRequest.addEventListener("change", function() {
                if (typeOfRequest.value === "Service Request") {
                    additionalOptionGroup.style.display = "flex";
                } else {
                    additionalOptionGroup.style.display = "none";
                }
            });

            otherAdditionalOption.addEventListener("change", function() {
                if (otherAdditionalOption.value === "Other") {
                    otherServiceRequestInput.style.display = "flex";
                } else {
                    otherServiceRequestInput.style.display = "none";
                }
            });
        });

        document.getElementById('mobile_or_phone_no').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('service_meter_reading').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('fax_no').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        const dropdown = document.getElementById("brand");

        dropdown.addEventListener("change", (event) => {
            if (event.target.value === "Other") {
                const othersInput = document.createElement("input");
                othersInput.type = "text";
                othersInput.placeholder = "Please specify";
                othersInput.style.display = "none"; // Initially hidden
                dropdown.insertAdjacentElement("afterend", othersInput);

                if (confirm("The option is not available. Do you want to specify it?")) {
                    othersInput.style.display = "block"; // Show the text input
                } else {
                    dropdown.value = ""; // Clear the selection
                }
            } else {
                if (document.querySelector("input[type='text']")) {
                    document.querySelector("input[type='text']").remove(); // Remove if exists
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    </body>

    </html>
    <?php


    function handleFormSubmission()
    {
        include 'includes/connection.php';

        // Get form data
        $userID = $_SESSION['userID'];
        $requestor = $_POST['requestor'];
        $sort_value = 4; // Default value to low proirity
        $date_of_request = date('Y-m-d', strtotime($_POST['date_of_request']));
        $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
        $address = $_POST['address'];
        $business_unit = $_POST['business_unit'];
        $cust_project_name = $_POST['cust_project_name'];
        $model = $_POST['model'];
        $brand = $_POST['brand'];

        for ($i = 0; $i < 999; $i++) {
            if (isset($_POST['brand' . $i])) {
                $brand = $brand . '-' . $_POST['brand' . $i];
            } else
                break;
        }



        $type_of_request = $_POST['type_of_request'];
        $additional_option = "";
        $other_service_request = "";


        // Check if additional_option should be set
        if ($type_of_request === 'Service Request') {
            $additional_option = $_POST['additional_option'];
        } else {
            $additional_option = ''; // Set a default value when not applicable
        }

        // Check if other_service_request should be set
        if ($type_of_request === 'Service Request' && $additional_option === 'Other') {
            $other_service_request = $_POST['other_service_request'];
        } else {
            $other_service_request = ''; // Set a default value when not applicable
        }

        $unit_problem = $_POST['unit_problem'];


        for ($i = 0; $i < 999; $i++) {
            if (isset($_POST['unit_problem' . $i])) {
                $unit_problem = $unit_problem . '-' . $_POST['unit_problem' . $i];
            } else
                break;
        }

        $unit_operational = $_POST['unit_operational'];

        // Define the priority based on type_of_request
        if ($type_of_request === 'Quotation - Major Repair' || $type_of_request === 'Technical Evaluation Request') {
            $sort_value = 1; // 1 - Critical High
        } elseif ($type_of_request === 'Quotation - Minor Repair' || $type_of_request === 'Preventive Maintenance') {
            $sort_value = 2; // 2 - High
        } elseif ($type_of_request === 'Quotation - Parts' || $type_of_request === 'EQC Inspection') {
            $sort_value = 3; // 3 - Mid
        } else {
            $sort_value = 4; // 4 - Low
        }

        // Check unit_operational and adjust priority if needed
        if ($unit_operational === 'No') {
            $sort_value = 1; // Override priority to HIGH
        }

        // Check the database connection
        if ($conn === false) {
            echo "Error: Unable to connect to the database.";
            return;
        }

        // Begin transaction
        // mysqli_begin_transaction($conn);
        $SERVICE_REQUEST_ID = $_GET['SERVICE_REQUEST_ID'];

        $sql = "UPDATE submit_requests SET sort_value = '$sort_value', address = '$address', business_unit = '$business_unit',
                model = '$model', mobile_or_phone_no ='$mobile_or_phone_no',brand = '$brand', type_of_request = '$type_of_request', additional_option = '$additional_option',
                other_service_request = '$other_service_request', unit_problem = '$unit_problem', unit_operational = '$unit_operational', 
                cust_project_name ='$cust_project_name', requestor = '$requestor' 
                WHERE SERVICE_REQUEST_ID = '$SERVICE_REQUEST_ID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            // Commit transaction
            mysqli_commit($conn);

        mysqli_close($conn);

        // Display success message
    ?>
        <script>
            swal.fire({
                icon: 'success',
                title: 'Service Request Edited Successfully',
                html: 'Service Request ID: <b><?php echo $SERVICE_REQUEST_ID ?></b>',
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "history.php";
                exit();
            });
        </script>


    <?php
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        handleFormSubmission();
    }

    ?>