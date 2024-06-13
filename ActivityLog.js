// SEARCH BAR FUNCTIOn

function searchTable() {
    var input, filter, table, tr, td1, td2, td3, td4, td5, td6,td7, i, txtValue1, txtValue2, txtValue3, txtValue4, txtValue5, txtValue6,txtValue7;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("monitoringTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[0];
        td2 = tr[i].getElementsByTagName("td")[1];
        td3 = tr[i].getElementsByTagName("td")[2];
        td4 = tr[i].getElementsByTagName("td")[3];
        td5 = tr[i].getElementsByTagName("td")[4];
        td6 = tr[i].getElementsByTagName("td")[5];
        td7 = tr[i].getElementsByTagName("td")[6];
    

        if (td1 && td2 && td3 && td4 && td5 && td6 && td7) {
            txtValue1 = td1.textContent.toLowerCase() || td1.innerText.toLowerCase();
            txtValue2 = td2.textContent.toLowerCase() || td2.innerText.toLowerCase();
            txtValue3 = td3.textContent.toLowerCase() || td3.innerText.toLowerCase();
            txtValue4 = td4.textContent.toLowerCase() || td4.innerText.toLowerCase();
            txtValue5 = td5.textContent.toLowerCase() || td5.innerText.toLowerCase();
            txtValue6 = td6.textContent.toLowerCase() || td6.innerText.toLowerCase();
            txtValue7 = td7.textContent.toLowerCase() || td7.innerText.toLowerCase();

            if (txtValue1.indexOf(filter) > -1 || txtValue2.indexOf(filter) > -1 || txtValue3.indexOf(filter) > -1 || txtValue4.indexOf(filter) > -1 || txtValue5.indexOf(filter) > -1 || txtValue6.indexOf(filter) > -1 || txtValue7.indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


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
            const scheduleDateCell = row.cells[1]; // Assuming the scheduledate is in the 6th cell
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

   

// FUNCTION FOR CONVERT TO EXCEL

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'activity logs':'.activity logs';
    
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

//FUNCTION FOR PAGINATION
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


//FUNCTION FOR SHOW ALL BUTTON
function showAllRows() {
    const table = document.getElementById("monitoringTable");
    const rows = Array.from(table.querySelectorAll("tbody tr"));
    
    rows.forEach(function (row) {
      row.style.display = ""; // Display all rows
    });
  }

  

  //FUNCTION FOR PAGE NUMBERS BUTTON
 
 document.addEventListener("DOMContentLoaded", function () {
    function updatePageNumber() {
        // Get all page number buttons
        const pageButtons = document.querySelectorAll(".page-numbers button");

        // Loop through all page number buttons and remove the "active" class
        pageButtons.forEach(function (button) {
            button.classList.remove("active");
        });

        // Add the "active" class to the current page number button
        const currentPageButton = pageButtons[currentPage - 1];
        currentPageButton.classList.add("active");

        document.getElementById("currentPage").textContent = `Page ${currentPage}`;
    }
});


//FUNCTION FOR COLOR ALTERNATE
function applyAlternateRowColors() {
    $('tbody tr:visible:odd').css('background-color', 'lightgrey');
    $('tbody tr:visible:even').css('background-color', 'white');
  }
  // Initial application of alternate row colors
  applyAlternateRowColors();

  // Event listener for the search input
  $('#searchInput').on('input', function () {
    // Reapply alternate row colors after filtering
    applyAlternateRowColors();
  });

  