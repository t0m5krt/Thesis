<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php

include 'includes/connection.php';
if (isset($_POST['input']) && isset($_POST['sortarray'])) {
    $input = $_POST['input'];
    $sortOption = $_POST['sortarray'];

    // Escape input to prevent SQL injection
    $input = mysqli_real_escape_string($conn, $input);

    $query = "SELECT DISTINCT a.*
    FROM `submit_requests` AS a
    JOIN service_request_status AS b
    WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0";

    // Add sorting based on the selected option
    if ($sortOption == 'sortValue') {
        $query .= " ORDER BY SERVICE_REQUEST_ID ASC";
    } elseif ($sortOption == 'dateofRequest') {
        $query .= " ORDER BY your_date_column ASC";
    } elseif ($sortOption == 'RequestID') {
        // Default sorting or any other logic
        $query .= " ORDER BY SERVICE_REQUEST_ID DESC";
    }

    if (!empty($input)) {
        $query = "SELECT DISTINCT a.*
        FROM `submit_requests` AS a
        JOIN service_request_status AS b
        WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0 AND (a.SERVICE_REQUEST_ID LIKE '%{$input}%')
        ;";
    }



    // // $_POST['sort'] = '';
    // if (isset($_POST['sort'])) {
    //     $sortOption = $_POST['sort'];
    // } else
    //     $sortOption = 'ByID';
    // // Modify the SQL query based on the selected sorting option
    // switch ($sortOption) {
    //     case 'sortValue':
    //         $sql = "SELECT DISTINCT a.*
    //                     FROM `submit_requests` AS a
    //                     JOIN service_request_status AS b
    //                     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
    //                     ORDER BY a.sort_value ASC;";
    //         break;
    //     case 'dateRequest':
    //         $sql = "SELECT DISTINCT a.*
    //                     FROM `submit_requests` AS a
    //                     JOIN service_request_status AS b
    //                     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
    //                     ORDER BY a.date_of_request ASC;";
    //         break;
    //     case 'ByID':
    //         $sql = "SELECT DISTINCT a.*
    //                     FROM `submit_requests` AS a
    //                     JOIN service_request_status AS b
    //                     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
    //                     ORDER BY a.SERVICE_REQUEST_ID ASC;";
    //         break;
    //     default:
    //         $sql = "SELECT DISTINCT a.*
    //                     FROM `submit_requests` AS a
    //                     JOIN service_request_status AS b
    //                     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
    //                     ORDER BY a.sort_value ASC;";
    //         break;
    // }

    // $result = $conn->query($sql);

    // while ($row = $result->fetch_assoc()) {



    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
?>


        <table id="myTable" class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>RequestID</th>
                    <th>Equipment No.</th>
                    <th>Priority Level</th>
                    <th>Type of Request</th>
                    <th>Request Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php

            // Define the mapSortValueToString function
            function mapSortValueToString($sortValue)
            {
                switch ($sortValue) {
                    case 1:
                        return '<span class="critical-high">Critical High</span>';
                    case 2:
                        return '<span class="high">High</span>';
                    case 3:
                        return '<span class="mid">Mid</span>';
                    case 4:
                        return '<span class="low">Low</span>';
                    default:
                        return 'Unknown'; // Handle any unexpected values
                }
            }

            // $_POST['sort'] = '';
            // if (isset($_POST['sort'])) {
            //   $sortOption = $_POST['sort'];
            // } else
            //   $sortOption = 'ByID';
            // // Modify the SQL query based on the selected sorting option
            // switch ($sortOption) {
            //   case 'sortValue':
            //     $sql = "SELECT DISTINCT a.*
            //     FROM `submit_requests` AS a
            //     JOIN service_request_status AS b
            //     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
            //     ORDER BY a.sort_value ASC;";
            //     break;
            //   case 'dateRequest':
            //     $sql = "SELECT DISTINCT a.*
            //     FROM `submit_requests` AS a
            //     JOIN service_request_status AS b
            //     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
            //     ORDER BY a.date_of_request ASC;";
            //     break;
            //   case 'ByID':
            //     $sql = "SELECT DISTINCT a.*
            //     FROM `submit_requests` AS a
            //     JOIN service_request_status AS b
            //     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
            //     ORDER BY a.SERVICE_REQUEST_ID ASC;";
            //     break;
            //   default:
            //     $sql = "SELECT DISTINCT a.*
            //     FROM `submit_requests` AS a
            //     JOIN service_request_status AS b
            //     WHERE a.SERVICE_REQUEST_ID IN (SELECT SERVICE_REQUEST_ID FROM service_request_status) AND a.isDelete = 0
            //     ORDER BY a.sort_value ASC;";
            //     break;
            // }


            while ($row = mysqli_fetch_assoc($result)) {
                // $id = $row['SERVICE_REQUEST_ID'];
                // $equipmentNumber = $row['asset_code'];
                // $priorityLevel = $row['sort_value'];
                // $typeofRequest = $row['type_of_request'];

                // echo "<tr>";
                // echo "<td>$id</td>";
                // echo "<td>$equipmentNumber</td>";
                // echo "<td>$priorityLevel</td>";
                // echo "<td>$typeofRequest</td>";
                // echo "</tr>";

                echo '<tr>';
                echo '<td>' . $row['SERVICE_REQUEST_ID'] . '</td>';
                echo '<td>' . $row['asset_code'] . '</td>';
                echo '<td>' . mapSortValueToString($row['sort_value']) . '</td>';
                echo '<td>' . $row['type_of_request'] . '</td>';
                echo '<td>' . $row['date_of_request'] . '</td>';
                // Add more columns as needed
                echo '<td>';
                echo '<form action="" method="POST">';
                echo '<input type="hidden" name="id" value=' . $row["SERVICE_REQUEST_ID"] . '>';
                echo '<button class="btn btn-danger view-bot" data-toggle="modal" data-target="#assignModal"
                onclick="fillAssignModal(' . $row["SERVICE_REQUEST_ID"] . ', \''
                    . $row["requestor"] . '\', \''
                    . $row["date_of_request"] . '\', \''
                    . $row["mobile_or_phone_no"] . '\', \''
                    . $row["address"] . '\', \''
                    . $row["business_unit"] . '\', \''
                    . $row["cust_project_name"] . '\', \''
                    . $row["asset_code"] . '\', \''
                    . $row["model"] . '\', \''
                    . $row["serial_no"] . '\', \''
                    . $row["equip_desc"] . '\', \''
                    . $row["brand"] . '\', \''
                    . $row["service_meter_reading"] . '\', \''
                    . $row["type_of_request"] . '\', \''
                    . $row["additional_option"] . '\', \''
                    . $row["charging"] . '\', \''
                    . $row["unit_problem"] . '\', \''
                    . $row["others"] . '\', \''
                    . $row["unit_operational"] . '\', \''
                    . $row["specific_requirement"] . '\', \''
                    . $row["onsite_contact_person"] . '\', \''
                    . $row["fax_no"] . '\')">
                        VIEW
                        </button>';
                        echo '
                        <button class="btn">
                            <a href="quotation.php?SERVICE_REQUEST_ID='. $row["SERVICE_REQUEST_ID"] .'">Quotation</a>
                        </button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        }
        

            ?>
            </tr>
            </tbody>
        </table>
    <?php
} else {
    echo "<h6 class='text-danger text-center mt-3'>No Data Found</h6>";
}

    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var selectedSort = "<?php echo $sortOption; ?>";
            var radioButtons = document.querySelectorAll('input[name="sort"]');
            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].value === selectedSort) {
                    radioButtons[i].checked = true;
                    break;
                }
            }
        });
    </script>