<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
function checkForNewData($conn) {
    // Query to check for new data based on a timestamp or any other criteria
    $query = "SELECT * FROM e_monitoringlogsheet WHERE created_at > ?"; // Assuming a 'created_at' column for timestamp

    // Define a threshold time (e.g., 5 minutes ago) to check for new data
    $thresholdTime = date('Y-m-d H:i:s', strtotime('-5 minutes'));

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $thresholdTime);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $newDataIndexes = [];

        while ($row = mysqli_fetch_assoc($result)) {
            // If new data is found, store the index (row number) of the corresponding row
            $newDataIndexes[] = $row['id']; // Replace 'id' with your primary key or unique identifier
        }

        // Determine if new data is available
        $newDataAvailable = !empty($newDataIndexes);

        return [
            "newDataAvailable" => $newDataAvailable,
            "newDataIndexes" => $newDataIndexes
        ];
    } else {
        return [
            "newDataAvailable" => false,
            "newDataIndexes" => []
        ];
    }
}

// Call the function to check for new data
$response = checkForNewData($conn);

// Close the database connection
mysqli_close($conn);

// Return the JSON response
header("Content-Type: application/json");
echo json_encode($response);
?>