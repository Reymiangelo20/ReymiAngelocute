<?php
session_start();
require("connect.php");
// Existing code
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reference_no = isset($_POST['reference_no']) ? $_POST['reference_no'] : '';

    // Check if the reference_no already exists in the database
    $checkSql = "SELECT COUNT(*) as count FROM control_number WHERE reference_no = '$reference_no'";
    $checkResult = mysqli_query($conn, $checkSql);

    if ($checkResult) {
        $row = mysqli_fetch_assoc($checkResult);
        $count = intval($row['count']);

        if ($count > 0) {
            // Fullname already exists
            echo 'exists';
        } else {
            // Fullname does not exist
            echo 'not_exists';
        }
    } else {
        // Error in database query
        echo 'error';
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Invalid request method
    echo 'invalid_request';
}