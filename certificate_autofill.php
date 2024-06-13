<?php
// Connect to the database (replace with your actual database connection code)
require("connect.php");

if (isset($_GET['reference_no'])) {
    $referencecode = $_GET['reference_no'];

    // Query your database to fetch the data based on the referenceCode
    $sql = "SELECT * FROM e_logshistory WHERE reference_no = '$referencecode'";
    $result = mysqli_query($conn, $sql);

    // Check if any rows are found
    if (mysqli_num_rows($result) > 0) {
        // Initialize an array to store the data
        $data = array();

        // Loop through the result set to fetch all rows
        while ($row = mysqli_fetch_assoc($result)) {
            // Store each row's data in the array
            $data[] = $row;
        }
        foreach ($data as $row) {
            $referencecode = $row['reference_no'];
            $yearRequested = $row['yearRequested'];
            $fullname = $row['fullname'];
            $purpose = $row['purpose_of_visit'];
            $scheduledate = date('F d, Y', strtotime($row['scheduledate']));
            $position_designation = $row['position_designation'];
            $agency_school_office = $row['agency_school_office'];
        }

        // Close the table or perform any other necessary actions
    } else {
        // Handle the case where no matching rows are found
    }
}

    ?>