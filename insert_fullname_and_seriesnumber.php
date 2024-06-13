<?php
// Connect to the database (replace with your actual database connection code)
require("connect.php");

// Connect to the database  
require("connect.php");

// Assuming the full name is passed via POST method
if (isset($_POST['fullName'])) {
    $fullName = $_POST['fullName'];

    // Get the maximum value of the series number column
    $maxSql = "SELECT MAX(seriesnumber) AS max_series_number FROM control_number";
    $maxResult = mysqli_query($conn, $maxSql);
    $maxRow = mysqli_fetch_assoc($maxResult);
    $maxSeriesNumber = $maxRow['max_series_number'];

    // Increment the maximum value by 1
    $seriesNumber = intval(substr($maxSeriesNumber, -6)) + 1;

    // Format the series number as CA-YYYY-000001
    $formattedSeriesNumber = sprintf("CA-%s-%06d", date("Y"), $seriesNumber);

    // Insert the full name and formatted series number into the "control_number" table
    $insertSql = "INSERT INTO control_number (fullname, seriesnumber) VALUES ('$fullName', '$formattedSeriesNumber')";
    
    if (mysqli_query($conn, $insertSql)) {
        echo "Full name and series number inserted into control_number table successfully";
    } else {
        echo "Error inserting full name and series number: " . mysqli_error($conn);
    }
} else {
    echo "Full name not received";
}
?>
