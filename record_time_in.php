
<?php
session_start();
require_once("connect.php");

if (isset($_POST['appointment_id'])) {
    require_once("connect.php"); // Include your database connection code

    $appointmentId = $_POST['appointment_id'];
    $currentTime = date('Y-m-d H:i');

    // Update the database with the current time for the specified appointment
    $sql = "UPDATE e_monitoringlogsheet SET time_in = ? WHERE appointment_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $currentTime, $appointmentId);
        if (mysqli_stmt_execute($stmt)) {
            echo $currentTime; // Return the updated time as a response
        } else {
            echo "Error updating database."; // Handle the error accordingly
        }
    } else {
        echo "Error preparing the statement."; // Handle the error accordingly
    }

    mysqli_close($conn); // Close the database connection
} else {
    echo "Invalid request.";
}
?>