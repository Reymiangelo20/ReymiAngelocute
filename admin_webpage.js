
document.addEventListener("DOMContentLoaded", function () {
    const timeInButtons = document.querySelectorAll(".time-in-button");

    timeInButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const row = this.closest("tr");
            const timeInCell = row.querySelector("td:nth-child(12)");
            const currentTime = new Date().toLocaleTimeString();
            

            // Update the "Time In" cell with the current time
            timeInCell.textContent = currentTime;

            // Store the current time in a variable
            const time_in = currentTime;

            // Disable the button
            button.classList.add("disabled");
            button.disabled = true;


            // Get other necessary data
            const scheduledate = row.querySelector(".sched").textContent;
            const fullname = row.querySelector(".fullname").textContent;
            const reference_no = row.querySelector("td:nth-child(10)").textContent;

            // Send the data to the server to update the database
            updateDatabase(scheduledate, fullname, time_in, reference_no);
        });
    });
});

function updateDatabase(scheduledate, fullname, time_in, reference_no) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_time_in.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the server if needed
            if (xhr.responseText === "success") {
                // Time In data saved successfully
            } else {
                // Handle any errors here
            }
        }
    };
    const data = `scheduledate=${scheduledate}&fullname=${fullname}&time_in=${time_in}&reference_no=${reference_no}`;
    xhr.send(data);
}

  document.addEventListener("DOMContentLoaded", function () {
    const timeInButtons = document.querySelectorAll(".time-in-button");

    timeInButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const row = this.closest("tr");
            const timeInCell = row.querySelector("td:nth-child(12)");
            const currentTime = new Date();
            const formattedTime = currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            // Update the "Time In" cell with the current time (without seconds)
            timeInCell.textContent = formattedTime;

            // Store the current time in local storage
            const reference_no = row.querySelector("td:nth-child(10)").textContent;
            localStorage.setItem(`timeIn_${reference_no}`, formattedTime);

            // Disable the "Time In" button
            button.classList.add("disabled");
            button.disabled = true;

            // Enable the corresponding "Time Out" button
            const timeoutButton = row.querySelector(".timeout-button");
            const nextButton = row.querySelector(".next-button")
            timeoutButton.disabled = false;
            nextButton.disabled = true;
        });
    });

    // Check local storage and disable "Time In" buttons if "Time In" is recorded
    timeInButtons.forEach(function (button) {
        const row = button.closest("tr");
        const reference_no = row.querySelector("td:nth-child(10)").textContent;
        const timeIn = localStorage.getItem(`timeIn_${reference_no}`);

        if (timeIn) {
            const timeInCell = row.querySelector(".time-in");
            timeInCell.textContent = timeIn;
            button.classList.add("disabled");
            button.disabled = true;

            // Enable the corresponding "Time Out" button
            const timeoutButton = row.querySelector(".timeout-button");
            const nextButton = row.querySelector(".next-button")
            timeoutButton.disabled = false;
            nextButton.disabled = true;
        }
    });
});

function setTimeInLocalStorage(reference_no, timeIn) {
    localStorage.setItem(`timeIn_${reference_no}`, timeIn);
}

function getCurrentTime() {
    return new Date().toLocaleTimeString();
}

// Check local storage and disable "Time In" buttons if "Time In" is recorded
document.addEventListener("DOMContentLoaded", function () {
    const timeInButtons = document.querySelectorAll(".time-in-button");

    timeInButtons.forEach(function (button) {
        const row = button.closest("tr");
        const reference_no = row.querySelector("td:nth-child(10)").textContent;
        const timeIn = localStorage.getItem(`timeIn_${reference_no}`);

        if (timeIn) {
            const timeInCell = row.querySelector(".time-in");
            timeInCell.textContent = timeIn;
            button.classList.add("disabled");
            button.disabled = true;
        }
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const timeOutButtons = document.querySelectorAll(".timeout-button");

    timeOutButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const row = this.closest("tr");
            const timeOutCell = row.querySelector("td:nth-child(12)");

            if (!timeOutCell.textContent) {
                // If the "Time Out" cell is empty, automatically transfer the row
                const reference_no = row.querySelector("td:nth-child(10)").textContent;
                transferData(reference_no);
                
                // You can add further actions here, e.g., hide the row or display a message
                row.style.display = "none"; // Hide the row
            } else {
                // The row has already timed out, display a message or take other action
                console.log("This row has already timed out.");
            }
        });
    });
});
    

//FUNCTION FOR NEXT BUTTON TO TRRANSFER THE VISITOR NAME AND DEPARTMENT
$(".next-button").on("click", function() {
    var visitorName = $(this).closest("tr").find(".fullname").text();
    var department = $(this).data("department");
    $.ajax({
        type: "POST",
        url: "queuing_system_display.php.",
        data: { visitorName: visitorName, department: department },
        success: function(response) {
            console.log(response);
        }
    });
});

//FUNCTION TO ENABLE TIME IN BUTTON IN THE SAME ROW WHEN THE USER CLICK THE NEXT BUTTON
function enableTimeInButton(button) {
    var timeInButton = button.closest('tr').querySelector('.time-in-button');
    timeInButton.removeAttribute('disabled');

}



// HIGHLIGHT THE ROW WHEN THE NEXT BUTTON IS CLICKED
const nextButtons = document.querySelectorAll('.next-button');
let highlightedRow;
const storedRowId = localStorage.getItem('highlightedRowId');

if (storedRowId) {
  const storedRow = document.getElementById(storedRowId);
  if (storedRow) {
    storedRow.style.backgroundColor = 'lightgray';
    highlightedRow = storedRow;
  }
}

nextButtons.forEach(button => {
  button.addEventListener('click', function() {
    if (highlightedRow) {
      highlightedRow.style.backgroundColor = '';
    }
    const row = this.closest('tr');
    row.style.backgroundColor = 'lightgray';
    highlightedRow = row;
    localStorage.setItem('highlightedRowId', row.id);
  });
});




setInterval(() => {
    location.reload();
}, 120000);
  




  

