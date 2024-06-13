<?php
session_start();

require("connect.php");

$success = false;
$errors = array();

// Function to get the last series number from the database
function getLastSeriesNumber($conn) {
    $currentYear = date("Y");

    // Query to get the latest data in the seriesNumber and yearRequested columns
    $sql = "SELECT timeStamp, seriesNumber, yearRequested FROM control_number ORDER BY timeStamp DESC LIMIT 1";
        
    $result = $conn->query($sql);
        
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastTimeStamp = $row['timeStamp'];
        $lastSeriesNumber = $row["seriesNumber"];
        $lastYear = $row["yearRequested"];
        
        // Check if the last year in the database is the same as the current year
        if ($lastYear == $currentYear) {
            // If it's the same year, increment the seriesNumber
            $lastSeriesNumber++;
        } else {
            // If it's a different year, reset the seriesNumber to 1
            $lastSeriesNumber = 1;
        }
        return intval($lastSeriesNumber);
    } else {
        $lastSeriesNumber = 1;
        return intval($lastSeriesNumber);
    }
}

if (isset($_POST['btnPrint'])) {
    // Get the reference code and yearRequested from the form
    $referencecode = $_POST['reference_no'];
    $yearRequested = intval($_POST['yearRequested']); // Assuming yearRequested is in POST data

    // Increment the seriesNumber only once per request
    $lastSeriesNumber = getLastSeriesNumber($conn);
    $formattedSeriesNumber = str_pad($lastSeriesNumber, 6, '0', STR_PAD_LEFT);
    $additionalText = "ECA-";

    // Retrieve data from the queue_logs table for the specific reference code
    $selectSql = "SELECT * FROM e_logshistory WHERE reference_no = '$referencecode'";
    $result = mysqli_query($conn, $selectSql);

    if ($result) {
        // Loop through the result set to fetch all rows
        while ($row = mysqli_fetch_assoc($result)) {
            $yearRequested = intval($_POST['yearRequested']);
            $risNoDate = $additionalText.$_POST['risNoDate'];
            $fullname = $row['fullname'];
            $position_designation = $row['position_designation'];
            $agency_school_office = $row['agency_school_office'];
            $purpose_of_visit = $row['purpose_of_visit'];
            $scheduledate = $row['scheduledate'];
            $reference_no = $row['reference_no'];
            // Construct the INSERT query for request_logs with interpolated values
            $insertSql = "INSERT INTO control_number (risNoDate, seriesNumber, yearRequested, fullname, position_designation, agency_school_office, purpose_of_visit, scheduledate, reference_no) VALUES (
                '$risNoDate',
                '$formattedSeriesNumber',
                '$yearRequested',
                '$fullname',
                '$position_designation',
                '$agency_school_office',
                '$purpose_of_visit',
                '$scheduledate',
                '$reference_no'
                
            )";

            // Execute the INSERT query
            $insertResult = mysqli_query($conn, $insertSql);
            if ($insertResult) {
                // Data inserted into request_logs successfully

                // Delete data from the queue_logs table
                $deleteSql = "SELECT * FROM control_number";
                $deleteResult = mysqli_query($conn, $deleteSql);

                if ($deleteResult) {
    
                    $success = true;
                } else {
                    $errors[] = 'Error SELECTING data from the database for referenceCode: ' . $referenceCode;
                }
            } else {
                $errors[] = 'Error inserting data into request_logs for referenceCode: ' . $referenceCode;
            }
        }
    } else {
        $errors[] = 'Error executing SELECT statement for referenceCode: ' . $referenceCode;
    }
} else {
    $errors[] = 'The button was not clicked.';
}

// Close the database connection
mysqli_close($conn);

if ($success && empty($errors)) {
    // Redirect to queueing_system.php
    header("Location: e_logsHistory.php");
    exit(); // Terminate the script
}
// Return the response with success and errors
$response = [
    'success' => $success,
    'errors' => $errors,
];
echo json_encode($response);
?>