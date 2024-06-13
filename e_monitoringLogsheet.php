        <?php
        $api_url = "http://worldtimeapi.org/api/ip";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
            exit;
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if ($data !== null && isset($data['datetime'])) {
            $currentDate = new DateTime($data['datetime']);
            $formattedDate = $currentDate->format('m-d-Y');
            $scheduledate = $currentDate->format('m/d/Y');
            session_start();
            require_once("connect.php"); // Make sure this file includes database connection code.
            $query = "SELECT * FROM e_monitoringlogsheet WHERE scheduledate = ?";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $scheduledate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $rowNumber = 1;
            } else {
                echo "Failed to prepare the statement.";
            }
        } else {
            echo "Failed to fetch data from the API.";
        }


        $rowNumber = 1;
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bookman+Old+Style">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <link rel="stylesheet" href="e_monitoringLogsheet.css">
            <title>Monitoring Visitor's Logbook</title>
        </head>
        <body>

        <header>
            <img src="monitoring logbook logo.jpeg.png" alt="">
            <h1>  E- MONITORING LOG SHEET</h1>
            <input type="text" id="searchInput" placeholder="Search" oninput="searchTable()">
        </div>
        </header>
        <div class="scroll-container">
            <div class="scroll"></div>
            <table id="monitoringTable">
                <thead>
                <tr>
                <th id="colNo">No.</th>
                    <th id="colFullName">Full Name</th>
                    <th id="colSex">Sex</th>
                    <th id="colPriority">Priority</th>
                    <th id="colPhoneNumber">Phone Number</th>
                    <th id="colScheduleDate">Schedule Date</th>
                    <th id="colPosition_designation">Position/Designation</th>
                    <th id="colAgency_school_office">Agency/School/Office</th>
                    <th id="colAppointment">Appointment</th>
                    <th id="colPurpose">Purpose of visit</th>
                    <th id="colDepartment">Department</th>
                    <th id="colReference_no">Reference No.</th>
                    
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                    <td><?php echo $rowNumber; ?></td>
                    
                <td class="fullname"><?php echo $row["fullname"]; ?></td>
                <td class="sex"><?php echo $row["sex"]; ?></td>
                <td class="priority"><?php echo $row["priority"]; ?></td>
                <td><?php echo $row["phonenumber"]; ?></td>
                <td class="sched"><?php echo $row["scheduledate"]; ?></td>
                <td class="position"><?php echo $row["position_designation"]; ?></td>
                <td class="office"><?php echo $row["agency_school_office"]; ?></td>
                <td class="appointment"><?php echo $row["appointment"]; ?></td>     
                <td><?php echo $row["purpose_of_visit"]; ?></td>
                <td><?php echo $row["department"]; ?></td>
                <td><?php echo $row["reference_no"]; ?></td> 
                
        </td>
            </tr>
            <?php
            $rowNumber++;
                }
                ?>
    </div>
 </table>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function sortTable(columnIndex, ascending) {
                    let table, rows, switching, i, x, y, shouldSwitch;
                    table = document.getElementById("monitoringTable");
                    switching = true;
                    while (switching) {
                        switching = false;
                        rows = table.rows;
                        for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("td")[columnIndex];
                            y = rows[i + 1].getElementsByTagName("td")[columnIndex];
                            if (ascending) {
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                    shouldSwitch = true;
                                    break;
                                }
                            } else {
                                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                    shouldSwitch = true;
                                    break;
                                }
                            }
                        }
                        if (shouldSwitch) {
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                }
                
                
                document.getElementById("colNo").addEventListener("click", function () {
                    sortTable(0, true);
                });
                document.getElementById("colFullName").addEventListener("click", function () {
                    sortTable(1, true);
                });
                document.getElementById("colSex").addEventListener("click", function () {
                    sortTable(2, true);
                });
                document.getElementById("colPriority").addEventListener("click", function () {
                    sortTable(3, true);
                });
                document.getElementById("colPhoneNumber").addEventListener("click", function () {
                    sortTable(4, true);
                });
                document.getElementById("colScheduleDate").addEventListener("click", function () {
                    sortTable(5, true);
                });
                document.getElementById("colPosition_designation").addEventListener("click", function () {
                    sortTable(6, true);
                });
                document.getElementById("colAgency_school_office").addEventListener("click", function () {
                    sortTable(7, true);
                });
                document.getElementById("colAppointment").addEventListener("click", function () {
                    sortTable(8, true);
                });
                document.getElementById("colPurpose").addEventListener("click", function () {
                    sortTable(9, true);
                });
                document.getElementById("colDepartment").addEventListener("click", function () {
                    sortTable(10, true);
                });
                document.getElementById("colReference_no").addEventListener("click", function () {
                    sortTable(11, true);
                });
               
            
            });
 </script>
       <script>
           function searchTable() {
    var input, filter, table, tr, td1, td2, td3, td4, td5, td6, td7, td8, i, txtValue1, txtValue2, txtValue3 ,txtValue4 ,txtValue5, txtValue6, txtValue7, txtValue8;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[0]; // RIS No. column
        td2 = tr[i].getElementsByTagName("td")[1]; // Account Name column
        td3 = tr[i].getElementsByTagName("td")[2]; // User Office column
        td4 = tr[i].getElementsByTagName("td")[3]; // Stock No. column
        td5 = tr[i].getElementsByTagName("td")[4]; // Item Description column
        td7 = tr[i].getElementsByTagName("td")[5]; // Date column
        td8 = tr[i].getElementsByTagName("td")[6]; // Date column
        td6 = tr[i].getElementsByTagName("td")[7]; // Date column
        
        

    if (td1 && td2 && td3 && td4 && td5 && td6 && td7 && td8) {
        txtValue1 = td1.textContent || td1.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                txtValue3 = td3.textContent || td3.innerText;
                txtValue4 = td4.textContent || td4.innerText;
                txtValue5 = td5.textContent || td5.innerText;
                txtValue6 = td6.textContent || td6.innerText;
                txtValue7 = td7.textContent || td7.innerText;
                txtValue8 = td8.textContent || td8.innerText;

        if (txtValue1.toLowerCase().indexOf(filter) > -1 || txtValue2.toLowerCase().indexOf(filter) > -1 || txtValue3.toLowerCase().indexOf(filter) > -1 || txtValue4.toLowerCase().indexOf(filter) > -1 || txtValue5.toLowerCase().indexOf(filter) > -1 || txtValue6.toLowerCase().indexOf(filter) > -1 || txtValue7.toLowerCase().indexOf(filter) > -1 || txtValue8.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
            
    }
}
    </script> 
    <script>
// COLOR ALTERNATING FUNCTION
function applyAlternateRowColors() {
    $('tbody tr:visible:odd').css('background-color', 'lightgrey');
    $('tbody tr:visible:even').css('background-color', 'gray');
  }
  // Initial application of alternate row colors
  applyAlternateRowColors();

  // Event listener for the search input
  $('#searchInput').on('input', function () {
    // Reapply alternate row colors after filtering
    applyAlternateRowColors();
  });
  </script>
  
</script>
</body>
</html>
