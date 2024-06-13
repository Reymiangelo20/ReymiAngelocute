<?php
    session_start();
    require_once("connect.php");

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "e-logsheet";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"> 
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bookman+Old+Style">
        <script src="https://kit.fontawesome.com/355342439a.js" crossorigin="anonymous"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="table2excel.js"></script>
        <link rel="stylesheet" href="unsuccessful_appointment.css">
        <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
        <title>UNSUCCESSFUL APPOINTENT</title>
       

    </head>
    <header>
        <img src="monitoring logbook logo.jpeg.png" alt="">
        <h1>UNSUCCESSFUL APPOINTMENT</h1>
       <input type="text" id="searchInput" placeholder="Search" oninput="searchTable()">
    </header>
<body>
    <div class="filter-container">
        <label for="fromDate">From:</label>
        <input type="text" id="fromDate" placeholder="MM/DD/YYYY">
        <label for="toDate">To:</label>
        <input type="text" id="toDate" placeholder="MM/DD/YYYY">
        <button onclick="filterData()">Find</button>
        
</div>
<input type="checkbox" name="" id="check">
    <div class="container">
     <label for="check">
         <span class="bx bx-x" id="cross"></span>
         <span class="bx bx-menu" id="bars"></span>
     </label>
     <div class="head">MENU</div>
     <ol>  
             <li> <a href="e_logsHistory.php"><i class='bx bx-history'></i>E-LOG'S HISTORY</a></li>
            <li> <a href="unsuccessful_appointment.php"><i class='bx bx-clipboard'></i></i></i>UNSUCCESSFUL APPOINTMENTS</a></li>
            <li> <a href="appearance.php"><i class="fa-regular fa-file-lines" style="color: #f4f7fa;"></i>CERTIFICATE OF APPEARANCE</a></li>
            <li> <a href="user_accounts.php"><i class='bx bxs-user-account' ></i></i>USER ACCOUNTS</a></li>
            <li> <a href="ActivityLogs.php"><i class='bx bx-list-ul'></i>ACTIVITY LOG</a></li>
            <li> <a href="queuing_system_videouploader.php"><i class='bx bx-cloud-upload'></i>UPLOADER</a></li>
            <li> <a href="change_password.php"><i class='bx bx-lock-alt'></i>CHANGE PASSWORD</a></li>
            <li> <a href="log_out.php"><i class='bx bx-log-out'></i>LOGOUT</a></li>
     </ol>
 </div>   
 <div class="pagination">
    <button id="previousButton">Previous</button>
    <div id="paginationContainer" class="page-numbers"></div>
    <button id="nextButton">Next</button>
    <button id="showAllButton" onclick="showAllRows()">Show All</button>

</div>
<button id="downloadexcel" class="downloadexcel" onclick="exportTableToExcel('monitoringTable', 'unsuccessful appointment')">Convert to Excel</button>
    <div class="scroll">    
        <table id="monitoringTable" border="1">
        <thead> 
        <tr>
            <th id="colNo">No.</th>
            <th id="colFullName">Full Name</th>
            <th id="colSex">Sex</th>
            <th id="colpriority">Priority</th>
            <th id="colPhoneNumber">Phone Number</th>
            <th id="colScheduleDate">Schedule Date</th>
            <th id="colAppointment">Appointment</th>
            <th id="colPurpose">Purpose of visit</th>
            <th id="colDepartment">Department</th>
            <th id="colreference_no">Reference No.</th>
            <th id="colTime in">Time In</th>
            <th id="colTime out">Time Out</th>
        </tr>
    </thead>   
        <?php
        
      $query = "SELECT * FROM unsuccessful_appointment ORDER BY timeStamp desc";
      $result = mysqli_query($conn, $query);   
  
 

    if ($result && mysqli_num_rows($result) > 0) {
        $totalRows = mysqli_num_rows($result); // Get the total number of rows
        $rowNumber = $totalRows; // Initialize row number to the total number of rows

        while ($row = mysqli_fetch_assoc($result)) {
            // Start a new table row for each record
            echo "<tr class='highlight-row'>"; // Apply the CSS class
            echo "<td>" . $rowNumber . "</td>";
            echo "<td class='fullname'>" . $row['fullname'] . "</td>";
            echo "<td class='sex'>" . $row['sex'] . "</td>";
            echo "<td class='priority'>" . $row['priority'] . "</td>";
            echo "<td>" . $row['phonenumber'] . "</td>";
            echo "<td class='sched'>" . $row['scheduledate'] . "</td>";
            echo "<td>" . $row['appointment'] . "</td>";
            echo "<td>" . $row['purpose_of_visit'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['reference_no'] . "</td>";
            echo "<td>" . $row['time_in'] . "</td>";
            echo "<td>" . $row['time_out'] . "</td>";
            echo "</tr>";
            $rowNumber--; // Decrease row number for the next row
        }
    } else {
        echo "No transferred row data found.";
    }
    ?>
        
    </table>
        <script>
       function searchTable() {
    var input, filter, table, tr, td1, td2, td3, td4, td5, td6, td7, td8, td9, td10, txtValue1, txtValue2, txtValue3, txtValue4, txtValue5, txtValue6, txtValue7, txtValue8, txtValue9, txtValue10;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[0];
        td2 = tr[i].getElementsByTagName("td")[1];
        td3 = tr[i].getElementsByTagName("td")[2];
        td4 = tr[i].getElementsByTagName("td")[3];
        td5 = tr[i].getElementsByTagName("td")[4];
        td6 = tr[i].getElementsByTagName("td")[5];
        td7 = tr[i].getElementsByTagName("td")[6];
        td8 = tr[i].getElementsByTagName("td")[8];
        td9 = tr[i].getElementsByTagName("td")[9];
        td10 = tr[i].getElementsByTagName("td")[10];

        if (td1 && td2 && td3 && td4 && td5 && td6 && td7 && td8 && td9 && td10) {
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            txtValue3 = td3.textContent || td3.innerText;
            txtValue4 = td4.textContent || td4.innerText;
            txtValue5 = td5.textContent || td5.innerText;
            txtValue6 = td6.textContent || td6.innerText;
            txtValue7 = td7.textContent || td7.innerText;
            txtValue8 = td8.textContent || td8.innerText;
            txtValue9 = td9.textContent || td9.innerText;
            txtValue10 = td10.textContent || td10.innerText;

            if (txtValue1.toLowerCase().indexOf(filter) > -1 ||
                txtValue2.toLowerCase().indexOf(filter) > -1 ||
                txtValue3.toLowerCase().indexOf(filter) > -1 ||
                txtValue4.toLowerCase().indexOf(filter) > -1 ||
                txtValue5.toLowerCase().indexOf(filter) > -1 ||
                txtValue6.toLowerCase().indexOf(filter) > -1 ||
                txtValue7.toLowerCase().indexOf(filter) > -1 ||
                txtValue8.toLowerCase().indexOf(filter) > -1 ||
                txtValue9.toLowerCase().indexOf(filter) > -1 ||
                txtValue10.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
    </script>
    <script>
    //FUNCTION FOR FROM AND TO FILTER DATE:

document.addEventListener("DOMContentLoaded", function() {
    const fromDateInput = document.getElementById("fromDate");
    const toDateInput = document.getElementById("toDate");
    const table = document.getElementById("monitoringTable");
    const rows = Array.from(table.querySelectorAll("tbody tr"));

    function formatDateToMMDDYYYY(dateString) {
        const parts = dateString.split('/'); // Split MM/DD/YYYY into an array
        const month = parts[0];
        const day = parts[1];
        const year = parts[2];
        return `${month}/${day}/${year}`; // Convert to MM/DD/YYYY
    }

    function filterRows() {
        const fromDate = fromDateInput.value.trim();
        const toDate = toDateInput.value.trim();
        const formattedFromDate = formatDateToMMDDYYYY(fromDate);
        const formattedToDate = formatDateToMMDDYYYY(toDate);

        rows.forEach(function(row) {
            let rowMatch = true;

            // Check if the row matches the date range filter or if no dates are selected
            const scheduleDateCell = row.cells[5]; // Assuming the scheduledate is in the 6th cell
            const scheduleDate = scheduleDateCell.textContent.trim();

            if (fromDate !== "" && toDate !== "") {
                if (scheduleDate < formattedFromDate || scheduleDate > formattedToDate) {
                    rowMatch = false;
                }
            }

            if (rowMatch) {
                row.style.display = ""; // Display the row if it's within the range or no dates selected
            } else {
                row.style.display = "none"; // Hide the row if it's outside the range
            }
        });
    }

    fromDateInput.addEventListener("input", filterRows);
    toDateInput.addEventListener("input", filterRows);
});
    </script>
    <script>
        function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'unsuccessful appointment.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("monitoringTable");
    const rows = Array.from(table.querySelectorAll("tbody tr"));
    const rowsPerPage = 10;
    let totalPages = Math.ceil(rows.length / rowsPerPage);
    let currentPage = 1;

    function updateTableDisplay() {
        rows.forEach(function (row, index) {
            if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function goToNextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            updateTableDisplay();
            updatePageNumbers();
        }
    }

    function goToPreviousPage() {
        if (currentPage > 1) {
            currentPage--;
            updateTableDisplay();
            updatePageNumbers();
        }
    }

    function goToPage(pageNumber) {
        if (pageNumber >= 1 && pageNumber <= totalPages) {
            currentPage = pageNumber;
            updateTableDisplay();
            updatePageNumbers();
        }
    }

    function updatePageNumbers() {
        const paginationContainer = document.getElementById("paginationContainer");
        paginationContainer.innerHTML = ""; // Clear existing page number buttons

        // Calculate total pages and add ellipsis if there are too many pages
        totalPages = Math.ceil(rows.length / rowsPerPage);
        const maxVisiblePages = 5; // Maximum number of visible page number buttons

        let startPage = Math.max(currentPage - Math.floor(maxVisiblePages / 2), 1);
        let endPage = startPage + maxVisiblePages - 1;

        if (endPage > totalPages) {
            endPage = totalPages;
            startPage = Math.max(endPage - maxVisiblePages + 1, 1);
        }

        if (startPage > 1) {
            const ellipsisButton = document.createElement("button");
            ellipsisButton.textContent = "...";
            ellipsisButton.disabled = true;
            paginationContainer.appendChild(ellipsisButton);
        }

        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement("button");
            pageButton.textContent = i;
            pageButton.addEventListener("click", function () {
                goToPage(i);
            });
            if (i === currentPage) {
                pageButton.classList.add("active");
            }
            paginationContainer.appendChild(pageButton);
        }

        if (endPage < totalPages) {
            const ellipsisButton = document.createElement("button");
            ellipsisButton.textContent = "...";
            ellipsisButton.disabled = true;
            paginationContainer.appendChild(ellipsisButton);
        }
    }

    document.getElementById("nextButton").addEventListener("click", goToNextPage);
    document.getElementById("previousButton").addEventListener("click", goToPreviousPage);

    // Initialize table display and page numbers
    updateTableDisplay();
    updatePageNumbers();
});
</script>
<script>
  function showAllRows() {
    const table = document.getElementById("monitoringTable");
    const rows = Array.from(table.querySelectorAll("tbody tr"));
    
    rows.forEach(function (row) {
      row.style.display = ""; // Display all rows
    });
  }
</script>
    <script>
 document.addEventListener("DOMContentLoaded", function () {
    // ...

    function updatePageNumber() {
        // Get all page number buttons
        const pageButtons = document.querySelectorAll(".page-numbers button");

        // Loop through all page number buttons and remove the "active" class
        pageButtons.forEach(function (button) {
            button.classList.remove("active");
        });

        // Add the "active" class to the current page number 
        const currentPageButton = pageButtons[currentPage - 1];
        currentPageButton.classList.add("active");

        document.getElementById("currentPage").textContent = `Page ${currentPage}`;
    }

    // ...
});

</script>

    </div>
    </body>
    </html>
