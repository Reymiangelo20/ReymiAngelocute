<?php
session_start();
require_once("connect.php");

if (isset($_POST['reference_no']) && isset($_POST['time_in'])) {
    $reference_no = mysqli_real_escape_string($conn, $_POST['reference_no']);
    $time_in = mysqli_real_escape_string($conn, $_POST['time_in']);

    // Update the time_in column in the first table
    $updateQuery = "UPDATE e_monitoringlogsheet SET time_in = ? WHERE reference_no = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $time_in, $reference_no);

    if (mysqli_stmt_execute($stmt)) {
        // Retrieve the row data from the first table
        $query = "SELECT * FROM e_monitoringlogsheet WHERE reference_no = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $reference_no);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $scheduledDate = DateTime::createFromFormat('m/d/Y', $row['scheduledate']);
            $currentDate = new DateTime();
            
            // Check if scheduledDate is in the past (yesterday or earlier)
            if ($scheduledDate < $currentDate) {
                // Insert the row data into the second table (e_logsHistory)
                $insertQuery = "INSERT INTO unsuccessful_appointment (fullname, sex, priority, phonenumber, scheduledate, appointment, purpose_of_visit, position_designation, agency_school_office, department, reference_no) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insertQuery);
                mysqli_stmt_bind_param($stmt, "sssssssssss", $row['fullname'], $row['sex'], $row['priority'], $row['phonenumber'], $row['scheduledate'], $row['appointment'], $row['purpose_of_visit'], $row['position_designation'], $row['agency_school_office'], $row['department'], $row['reference_no']);

                if (mysqli_stmt_execute($stmt)) {
                    // Delete the row from the first table
                    $deleteQuery = "DELETE FROM e_monitoringlogsheet WHERE reference_no = ?";
                    $stmt = mysqli_prepare($conn, $deleteQuery);
                    mysqli_stmt_bind_param($stmt, "s", $reference_no);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Success";
                        exit;
                    } else {
                        echo "Error deleting row: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error transferring row data: " . mysqli_error($conn);
                }
            } else {
                echo "Scheduled date is not in the past.";
            }
        } else {
            echo "Row data not found.";
        }
    } else {
        echo "Error updating time_in: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

$timeIn = fetchLatestTimeInFromDatabase();

// Return the updated time-in data
echo $timeIn;
?>
