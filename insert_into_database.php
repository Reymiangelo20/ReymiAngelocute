<?php
session_start();
require_once("connect.php");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";// Change this to your control_number database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $referencecode = $_POST['referencecode'];
    $seriesnumber = $_POST['seriesnumber']; // Add this line to retrieve the series number

    // Fetch data from e_logsHistory based on reference code
    $query = "SELECT * FROM e_logsHistory WHERE reference_no = '$referencecode'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Insert data into control_number.coa_data along with the series number
        $insertQuery = "INSERT INTO control_number (fullname, sex, priority, phonenumber, scheduledate, agency_school_office, position_designation, appointment, purpose_of_visit, department, reference_no, time_in, time_out, seriesnumber) VALUES ('" . $row['fullname'] . "', '" . $row['sex'] . "', '" . $row['priority'] . "', '" . $row['phonenumber'] . "', '" . $row['scheduledate'] . "', '" . $row['position_designation'] . "', '" . $row['agency_school_office'] ."', '".$row['appointment'] . "', '" . $row['purpose_of_visit'] . "', '" . $row['department'] . "', '" . $row['reference_no'] . "', '" . $row['time_in'] . "', '" . $row['time_out'] . "', '" . $seriesnumber . "')";

        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo 'Data inserted into control_number.coa_data successfully!';
        } else {
            echo 'Error inserting data into control_number.coa_data: ' . mysqli_error($conn);
        }
    } else {
        echo 'No data found in e_logsHistory for reference code: ' . $referencecode;
    }
} else {
    echo 'Invalid request method.';
}
?>
