<?php

require("connect.php");

if (isset($_GET['seriesNumber'])) {
    $seriesNumber = $_GET['seriesNumber'];

    $sql = "SELECT * FROM control_number WHERE seriesNumber = '$seriesNumber'";
    $result = mysqli_query($conn, $sql);

   
    if (mysqli_num_rows($result) > 0) {
        // Initialize an array to store the data
        $data = array();

        // Loop through the result set to fetch all rows
        while ($row = mysqli_fetch_assoc($result)) {
            // Store each row's data in the array
            $data[] = $row;
        }

        // Assuming you only need the first row (if there are multiple)
        $row = $data[0];

        // Now you can use $row to populate the fields in your HTML form
        $fullname = $row['fullname'];
        $position_designation = $row['position_designation'];
        $agency_school_office = $row['agency_school_office'];
        $purpose = $row['purpose_of_visit'];
        $risNoDate = $row['risNoDate'];
        $issue = $row['timeStamp'];
    } else {
        // Handle the case where no matching rows are found
    }
}
?>