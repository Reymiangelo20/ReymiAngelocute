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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheduledate = $_POST["scheduledate"];
    $fullname = $_POST["fullname"];
    
    // Format the time as "hh:ia" (hours, minutes, AM/PM)
    $timeIn = date("h:i a", strtotime($_POST["time_in"]));
    $timeIn = strtoupper($timeIn); // Convert $timeIn to uppercase
    $reference_no = $_POST["reference_no"];

    // Update the "Time In" column in your database
    $updateSql = "UPDATE e_monitoringlogsheet SET time_in = '$timeIn' WHERE scheduledate = '$scheduledate' AND fullname = '$fullname' AND reference_no = '$reference_no'";

    if (mysqli_query($conn, $updateSql)) {
        echo "success"; // Return a success message if the update was successful
    } else {
        echo "error"; // Return an error message if the update failed
    }
}