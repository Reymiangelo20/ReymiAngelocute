<?php
session_start();
require_once("connect.php");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$userOffice = $_SESSION['userOffice'];
$currentDate = date("m/d/Y");
$yesterdayDate = date("m/d/Y", strtotime("-1 day"));

// Function to retrieve "Time In" from local storage
function getTimeInFromLocalStorage($reference_no) {
    // Initialize an empty value
    $timeIn = '';

    if (isset($_SESSION['timeIn']) && isset($_SESSION['timeIn'][$reference_no])) {
        $timeIn = $_SESSION['timeIn'][$reference_no];
    }

    // Check if a local storage value is available
    echo '<script>document.addEventListener("DOMContentLoaded", function () {
        const timeInLocalStorage = localStorage.getItem("timeIn_' . $reference_no . '");
        if (timeInLocalStorage) {
            const timeInCell = document.querySelector("#time-in_' . $reference_no . '");
            timeInCell.textContent = timeInLocalStorage;
        }
    });</script>';

    return $timeIn;
}

$sql = "SELECT *, IF(appointment = 'Online', 1, 0) AS is_online FROM e_monitoringlogsheet WHERE department = '$userOffice' AND scheduledate = '$currentDate' OR scheduledate = '$yesterdayDate' AND reference_no NOT IN (SELECT reference_no FROM e_logshistory)";

$result = mysqli_query($conn, $sql);

$rowNumber = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bookman+Old+Style">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_webpage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    <title>Monitoring Visitor's Logbook </title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<header>
        <img src="monitoring logbook logo.jpeg.png" alt="">
        <h1>APPOINTMENT LIST <br>
        <?php
        if (isset($_SESSION['userOffice'])) {
            echo $_SESSION['userOffice'];
        }
        ?>
        <br>
        <div class="adminBox">
      
            </div>
            <div class="adminText">
                <span>Admin:</span> <?php echo $_SESSION['accountName']; ?>
            </div>
    </h1>
 
  
    </header>
<button id="history_logs_button" class ="historylogs" onclick="location.href='admins_History.php';">History Logs</button>
<body>
<div class="scroll">
    <table id="monitoringTable">
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
            <th>Que</th>
            <th id="colTime in">Time In</th>
            <th>Action</th>
            <th>Time out</th>
            
        </tr>
        <?php
          while ($row = mysqli_fetch_assoc($result)) {
                $isOnlineAppointment = $row["is_online"];
                $reference_no = $row["reference_no"];
                $timeIn = getTimeInFromLocalStorage($reference_no);
                $TimeInRecorded = !empty($row["time_in"]);
        ?>
            <tr id="row_<?php echo $rowNumber; ?>" class="clickable-row">
                <td><?php echo $rowNumber; ?></td>
                <td class="fullname"><?php echo $row["fullname"]; ?></td>
                <td class="sex"><?php echo $row["sex"]; ?></td>
                <td class="priority"><?php echo $row["priority"]; ?></td>
                <td><?php echo $row["phonenumber"]; ?></td>
                <td class="sched"><?php echo $row["scheduledate"]; ?></td>
                <td><?php echo $row["appointment"]; ?></td>
                <td><?php echo $row["purpose_of_visit"]; ?></td>  
                <td class="department"><?php echo $row["department"]; ?></td>
                <td><?php echo $row["reference_no"]; ?></td>
                <td><button class="next-button" data-fullname="<?php echo $row["fullname"]; ?>" data-department="<?php echo $row["department"]; ?>" onclick="enableTimeInButton(this)">Next</button></td>
                <td class="time-in"><?php echo $TimeInRecorded ? $row["time_in"] : ''; ?></td>
                <td><button class="time-in-button" <?php echo $TimeInRecorded ? 'disabled' : ''; ?>disabled>Time In</button></td>
                <td><button id="timeout_button_<?php echo $rowNumber; ?>" class="timeout-button" data-reference="<?php echo $row["reference_no"]; ?>" <?php echo $TimeInRecorded ? '' : 'disabled'; ?>>Time Out</button></td>
              </tr>
        <?php
            $rowNumber++;
            }
        ?>
    </table>
</div>
<div class="settings">
    <a href="change_password.php">CHANGE PASSWORD</a>
    <a href="log_out.php">LOGOUT</a>
</div>
<style>
       .adminBox {
            display: inline-block;
        }
        .adminBox i {
            color: #3498db;
            margin-left: -2310px;
            font-size: 70%;
        }
        .adminText {
            display: inline-block;
            vertical-align: left;
            margin-left: -83%;
            font-size: 50%;
        }
        .adminText span {
            font-weight: bold; /* Optionally make the text bold */
        }
    </style>

<!--FUNCTION FOR USER FORGOT TO TIME IN OR TIMEOUT THE VISITOR THE DATA WILL GO TO UNSUCCESSFUL APPOINTMENT-->
<script>
 document.addEventListener("DOMContentLoaded", function () {
  var sweetAlertShown = false;

  function transferDataTimeIn(reference_no, currentTime) {
    // Make an AJAX request to transfer the row and update the time_in column
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "time_in.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Check if the SweetAlert has already been shown
          if (!sweetAlertShown) {
            // Handle the response from the server
            Swal.fire({
              icon: 'info',
              title: 'PLEASE WAIT WHILE!',
              text: 'Reloading the page...',
              timer: 2000, // Set the timer to automatically close the alert in 2 seconds
              showConfirmButton: false
            }).then(() => {
              // Reload the page after the SweetAlert is closed
              location.reload();
            });
            sweetAlertShown = true; // Set the flag to true to prevent further alerts
          }
        }
      }
    };

    // Send the reference_no and current time as POST data
    xhr.send("reference_no=" + reference_no + "&time_in=" + currentTime);
  }

  function transferDataTimeOut(reference_no, currentTime) {
  // Make an AJAX request to transfer the row and update the time_out column
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "check_time_out.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        // Check if the SweetAlert has already been shown
        if (!sweetAlertShown) {
          // Handle the response from the server
          Swal.fire({
            icon: 'info',
            title: 'PLEASE WAIT WHILE!',
            text: 'Reloading the page...',
            timer: 2000, // Set the timer to automatically close the alert in 2 seconds
            showConfirmButton: false
          }).then(() => {
            // Reload the page after the SweetAlert is closed
            location.reload();
          });
          sweetAlertShown = true; // Set the flag to true to prevent further alerts
        }
      }
    }
  };

  // Send the reference_no and current time as POST data
  xhr.send("reference_no=" + reference_no + "&time_out=" + currentTime);
  }

  // Define a function to periodically check for rows and transfer data
  function checkAndTransferData() {
    <?php
    $rowNumber = 1; // Reset row number for JavaScript
    mysqli_data_seek($result, 0); // Reset the result pointer
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      var reference_no = "<?php echo $row['reference_no']; ?>";
      var nextButton = document.querySelector('#row_<?php echo $rowNumber; ?> .next-button');
      var timeOutButton = document.querySelector('#row_<?php echo $rowNumber; ?> .timeout-button'); 
      var currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      var scheduledDate = new Date("<?php echo $row['scheduledate']; ?>"); 
      // Calculate the date for yesterday
      var yesterday = new Date();
      yesterday.setDate(yesterday.getDate() - 1);

      // Check if the scheduled date is in the past (before yesterday)
      if (scheduledDate < yesterday) {
        // Check if the "Time In" button is not disabled
        if (nextButton && !nextButton.disabled) {
          transferDataTimeIn(reference_no, currentTime);
        }
          transferDataTimeOut(reference_no, currentTime);
        }
      <?php
      $rowNumber++;
    }
    ?>
  }
  setInterval(function () {
    checkAndTransferData();
  }, 1000);
});
</script>


<!--FUNCTION FOR USER FORGOT TO TIME IN OR TIMEOUT THE VISITOR THE DATA WILL GO TO UNSUCCESSFUL APPOINTMENT-->


<!--FUNCTION FOR TIMEOUT BUTTON-->
<script>
  document.addEventListener("DOMContentLoaded", function () {
  <?php
  $rowNumber = 1; // Reset row number for JavaScript
  mysqli_data_seek($result, 0); // Reset the result pointer
  while ($row = mysqli_fetch_assoc($result)) {
  ?>
  
  document.getElementById("timeout_button_<?php echo $rowNumber; ?>").addEventListener("click", function () {
    var reference_no = this.getAttribute("data-reference");

    // Get the current time in HH:MM:SS format
    var currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit',});
    
    // Make an AJAX request to transfer the row and update the time_out column
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "transfer_row.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Handle the response from the server (e.g., display a success sweet alert)
          Swal.fire({
            icon: 'success',
            title: 'Time Out Successful',
            text: 'The time out action was successful!',
          }).then(function () {
            // You can also redirect to another page here if needed
            window.location.href = "admin_webpage.php";
          });
        } else {
          // Handle any error here
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while processing the request.',
          });
        }
      }
    };
    
    // Send the reference_no and current time as POST data
    xhr.send("reference_no=" + reference_no + "&time_out=" + currentTime);
  });
  <?php
  $rowNumber++;
  }
  ?>
});
</script>
<!--FUNCTION FOR TIMEOUT BUTTON-->


 <script src="admin_webpage.js"></script>
 
</body>
</html>