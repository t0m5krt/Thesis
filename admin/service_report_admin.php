<!DOCTYPE html>
<html lang="en">

<head>
    <title>Service Report | Repair and Maintence Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   

    
    

</head>

<body>

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
                <tr>
                    <td>[WORK ORDER NO.]</td>
                    <td>[DATE]</td>
                    <td>[PROJECT SITE]</td>
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
                    <td>[MACHINE ID CODE#]</td>
                    <td>[BRAND]</td>
                    <td>[MODEL]</td>
                    <td>[SERIAL NUMBER]</td>
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
                    <td>[SMR/KMR]</td>
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
        <input class="form-check-input" type="radio" name="equipment" value="complete" id="defaultCheck7">
        <label class="form-check-label" for="defaultCheck7">
                Complete
            </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="equipment" value="incomplete" id="defaultCheck7">
        <label class="form-check-label" for="defaultCheck7">
                Incomplete
            </label>
        </div>
        


        <h3>Project Request/Complaint</h3>

        <form>
            <input type="text" class="form-control" placeholder="Enter Project Request/Complaint here" aria-label="Project_Request_Complaint">
        </form>

        <h3>Findings</h3>

        <form>
            <input type="text" class="form-control" placeholder="Enter Findings here" aria-label="Findings">
        </form>

        <h3>Work Done</h3>

        <form>
            <input type="text" class="form-control" placeholder="Enter Work Done here" aria-label="Work Done">
        </form>

        <h3>Recommendations</h3>

        <form>
            <input type="text" class="form-control" placeholder="Enter Recommendations here" aria-label="Recommendations">
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
            <td><input type="text" class="form-control" id="parts_replaced"
              name="parts_replaced"></td>
            <td><input type="text" class="form-control" id="Recommendation_parts"
              name="Recommendation_parts"></td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="parts_replaced"
              name="parts_replaced"></td>
            <td><input type="text" class="form-control" id="Recommendation_parts"
              name="Recommendation_parts"></td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="parts_replaced"
              name="parts_replaced"></td>
            <td><input type="text" class="form-control" id="Recommendation_parts"
              name="Recommendation_parts"></td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="parts_replaced"
              name="parts_replaced"></td>
            <td><input type="text" class="form-control" id="Recommendation_parts"
              name="Recommendation_parts"></td>
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
        <td><input type="text" class="form-control" id="parts_replaced"
              name="parts_replaced"></td>
            <td><input type="text" class="form-control" id="Recommendation_parts"
              name="Recommendation_parts"></td>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/favicon.js"></script>
</body>

</html>
  
  
  
  
  
  
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
        .service-report h4{
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