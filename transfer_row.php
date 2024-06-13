<?php
session_start();
require_once("connect.php");

if (isset($_POST['reference_no']) && isset($_POST['time_out'])) {
    $reference_no = mysqli_real_escape_string($conn, $_POST['reference_no']);
    $time_out = mysqli_real_escape_string($conn, $_POST['time_out']);
    // Update the time_out column in the first table
    $updateQuery = "UPDATE e_monitoringlogsheet SET time_out = ? WHERE reference_no = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $time_out, $reference_no);

    if (mysqli_stmt_execute($stmt)) {
        // Retrieve the row data from the first table
        $query = "SELECT * FROM e_monitoringlogsheet WHERE reference_no = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $reference_no);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {  
            $row = mysqli_fetch_assoc($result);
// Insert the row data into the second table (e_logsHistory)
$insertQuery = "INSERT INTO e_logsHistory (yearRequested, fullname, sex, priority, phonenumber, scheduledate, position_designation, agency_school_office, appointment, purpose_of_visit, department, reference_no, time_in, time_out, assisted_by) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $insertQuery);
mysqli_stmt_bind_param($stmt, "issssssssssssss", $row['yearRequested'], $row['fullname'], $row['sex'], $row['priority'], $row['phonenumber'], $row['scheduledate'], $row['position_designation'], $row['agency_school_office'], $row['appointment'], $row['purpose_of_visit'], $row['department'], $row['reference_no'], $row['time_in'], $row['time_out'], $_SESSION['accountName']);

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
            echo "Row data not found.";
        }
    } else {
        echo "Error updating time_out: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
