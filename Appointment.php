<?php
session_start();

require_once("connect.php");
date_default_timezone_set('Asia/Manila');
function generateRandomReference($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $reference = '';
    for ($i = 0; $i < $length; $i++) {
        $reference .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $reference;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = mysqli_real_escape_string($conn, $_POST["Fullname"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phonenumber"]);
    $purpose = mysqli_real_escape_string($conn, $_POST["Purpose"]);
    $selectedOffice = mysqli_real_escape_string($conn, $_POST["selectOffice"]);
    $scheduleDate = mysqli_real_escape_string($conn, $_POST["currentDate"]);
    $yearRequested = intval(date("Y"));
    $risNoDate = $_POST['risNoDate'];
 
    // Retrieve the selected appointment type
    $appointment = mysqli_real_escape_string($conn, $_POST["appointment_type"]);
     // Split the full name into parts (assuming first name, middle name, last name)
     $nameParts = explode(" ", $fullName);

     // Manipulate the middle name to have a dot if it exists
     if (count($nameParts) == 3) {
         $nameParts[1] = $nameParts[1][0] . '.'; // Assuming the middle name is the second part
     }
 
     // Reconstruct the full name with a dot in the middle name
     $fullName = implode(" ", $nameParts);

    // Retrieve the selected sex value  
    $sex = mysqli_real_escape_string($conn, $_POST["gender"]);

    // Retrieve the selected priority lane value
    $priorityLane = isset($_POST["priorityLane"]) ? mysqli_real_escape_string($conn, $_POST["priorityLane"]) : '';
    $appointment = mysqli_real_escape_string($conn, $_POST["appointment_type"]);
    $position_designation = mysqli_real_escape_string($conn, $_POST["position_designation"]);
    $agency_school_office = mysqli_real_escape_string($conn, $_POST["agency_school_office"]);

    if ($appointment == "walk-in") {
        $reference_no = null; // Set the reference number to null for walk-in appointments
    } else {
        $reference_no = generateRandomReference(8); // Generate an 8-character reference number for scheduled appointments
}
// Get the current time in the desired format
 


// Validate and sanitize data as needed (you can add more validation here)

// Prepare and execute an SQL INSERT statement
$sql = "INSERT INTO e_monitoringlogsheet (appointment, yearRequested, fullname, phonenumber, purpose_of_visit, department, scheduledate, position_designation, agency_school_office, reference_no, sex, priority, time_in) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sisssssssssss", $appointment, $yearRequested, $fullName, $phoneNumber, $purpose, $selectedOffice, $scheduleDate, $position_designation, $agency_school_office, $reference_no, $sex, $priorityLane, $time_in);

    if (mysqli_stmt_execute($stmt)) {
        // Data inserted successfully, now show the reference number for online appointments
        if ($appointment == "Online") {
            $response = ['reference_no' => $reference_no, 'sex' => $sex, 'priorityLane' => $priorityLane, 'appointment' => $appointment];
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // For walk-in appointments, you don't need to send a response
            // or you can send a different response if needed
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing the SQL statement: " . mysqli_error($conn);
}
}