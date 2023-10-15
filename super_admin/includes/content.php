<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>Service Request Form</title>
  <link rel="stylesheet" type ="text/css" href="styles/service-request-design.css" />
</head>

<body>
  <form action="db/service_request_database.php" method="post">
    <div class="form-title">
      <h3>Service Request Form</h3>
      <p>Enter your concern details to a service request</p>
      <br />
    </div>
    <div class="form-group">
      <label for="requestor">REQUESTOR</label>
      <input type="text" id="requestor" name="requestor" required />
    </div>
    <div class="form-group">
      <label for="date_of_request">DATE OF REQUEST</label>
      <input type="date" id="date_of_request" name="date_of_request" required />
    </div>
    <div class="form-group">
      <label for="business_unit">BUSINESS UNIT</label>
      <input type="text" id="business_unit" name="business_unit" required />
    </div>
    <div class="form-group">
      <label for="cust_project_name">CUST./PROJECT NAME</label>
      <input type="text" id="cust_project_name" name="cust_project_name" required />
    </div>
    <div class="form-group">
      <label for="asset_code">ASSET CODE</label>
      <input type="text" id="asset_code" name="asset_code" />
    </div>
    <div class="form-group">
      <label for="model">MODEL</label>
      <input type="text" id="model" name="model" required />
    </div>
    <div class="form-group">
      <label for="serial_no">SERIAL NO.</label>
      <input type="text" id="serial_no" name="serial_no" required />
    </div>
    <div class="form-group">
      <label for="equip_desc">EQUIP DESC</label>
      <input type="text" id="equip_desc" name="equip_desc" required />
    </div>
    <div class="form-group">
      <label for="name">BRAND</label>
      <input type="text" id="brand" name="brand" required />
    </div>
    <div class="form-group">
      <label for="name">SERVICE METER READING</label>
      <input type="text" id="service_meter_reading" name="service_meter_reading" required />
    </div>
    <div class="form-group">
      <label for="type_of_request">TYPE OF REQUEST</label>
      <select id="type_of_request" name="type_of_request" required onchange="toggleAdditionalOption()">
        <option value="Q_majorRepair">Quotation - Major Repair</option>
        <option value="Q_minorRepair">Quotation - Minor Repair</option>
        <option value="Q_Parts">Quotation - Parts</option>
        <option value="preventiveMaintenance">Preventive Maintenance</option>
        <option value="eqcInspection">EQC Inspection</option>
        <option value="technicalEvaluationRequest">Technical Evaluation Request</option>
        <option value="serviceRequest">Service Request</option>
      </select>
      <div id="additional_option_group" class="form-group" style="display: none">
        <label for="additional_option"> Select:</label>
        <select name="additional_option_service_request" id="additional_option_service_request">
          <option value="emergencyCall">Emergency Call (Waver Required)</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div id="other_service_request_input" class="form-group" style="display: none">
        <label for="other_input_serv_req">OTHERS:</label>
        <input type="text" id="other_input_servreq" name="other_input_servreq" placeholder="Specify Here:" />
      </div>

      <div class="form-group">
        <label for="charging">CHARGING </label>
        <select id="charging" name="charging" required>
          <option value="lease">Lease (Buyback)</option>
          <option value="rental">Rental</option>
          <option value="warranty">Warranty</option>
        </select>
      </div>
    </div>

    <br />
    <div class="form-title">
      <h3>Customer Service Request/Complaint</h3>
    </div>
    <br />
    <div class="form-group">
      <label for="unit_problem">UNIT PROBLEM</label>
      <input type="text" id="unit_problem" name="unit_problem" required />
    </div>
    <div class="form-group">
      <label for="others">OTHERS P/N</label>
      <input type="text" id="others" name="others" />
    </div>
    <div class="form-group">
      <label for="unit_operational">UNIT OPERATIONAL</label>
      <input type="text" id="unit_operational" name="unit_operational" required />
    </div>
    <div class="form-group">
      <label for="specific_requirement">SPECIFIC REQUIREMENT</label>
      <input type="text" id="specific_requirement" name="specific_requirement" />
    </div>
    <div class="form-group">
      <label for="onsite_contact_person">ONSITE CONTACT PERSON</label>
      <input type="text" id="onsite_contact_person" name="onsite_contact_person" required />
    </div>
    <div class="form-group">
      <label for="mobile_or_phone_no">MOBILE/PHONE NO.</label>
      <input type="text" id="mobile_or_phone_no" name="mobile_or_phone_no" required />
    </div>
    <div class="form-group">
      <label for="fax_no">FAX NO.</label>
      <input type="text" id="fax_no" name="fax_no" />
    </div>
    <button type="submit">Submit</button>
  </form>

  <script src="js/script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>