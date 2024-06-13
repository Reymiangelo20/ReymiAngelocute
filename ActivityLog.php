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


// Check if the necessary POST data is available
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fullname']) && isset($_POST['scheduledate']) && isset($_POST['appointment']) && isset($_POST['department']) && isset($_POST['time_in']) && isset($_POST['time_out'])) {
    // Fetch data from form (already sanitized since you're using prepared statements)
    $fullname = $_POST['fullname'];
    $scheduledate = $_POST['scheduledate'];
    $appointment = $_POST['appointment'];
    $department = $_POST['department'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];
    $assistedBy = $_SESSION['assisted_by']; // Assumed to be the username of the logged-in user

    // Prepare the SQL statement to insert into activitylogs
    $insertSql = "INSERT INTO activitylogs (fullname, scheduledate, appointment, department, time_in, time_out, assisted_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $fullname, $scheduledate, $appointment, $department, $time_in, $time_out, $assistedBy);
    
    // Execute and check for success
    if (mysqli_stmt_execute($stmt)) {
        echo "Activity log entry successful";
    } else {
        echo "Error logging activity: " . mysqli_stmt_error($stmt);
    }
    
    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);
$selectSql = "SELECT fullname, scheduledate, appointment, department, time_in, time_out FROM eloghistory WHERE scheduledate = ? AND fullname = ?";
$selectStmt = mysqli_prepare($conn, $selectSql);
mysqli_stmt_bind_param($selectStmt, 'ss', $scheduledate, $fullname);
mysqli_stmt_execute($selectStmt);
$result = mysqli_stmt_get_result($selectStmt);

// Fetch the data
if ($row = mysqli_fetch_assoc($result)) {
    // Now insert into activitylogs
    $insertSql = "INSERT INTO activitylogs (fullname, scheduledate, appointment, department, time_in, time_out, assisted_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $row['fullname'], $row['scheduledate'], $row['appointment'], $row['department'], $row['time_in'], $row['time_out'], $assistedBy);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Activity log entry successful";
    } else {
        echo "Error logging activity: " . mysqli_stmt_error($stmt);
    }
    
    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "No data found in eloghistory to log.";
}

// Close the selection statement and the connection
mysqli_stmt_close($selectStmt);
mysqli_close($conn);
?>

