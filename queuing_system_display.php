<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert the visitor data into the database
if (isset($_POST['visitorName']) && isset($_POST['department'])) {
    $visitorName = $_POST['visitorName'];
    $department = $_POST['department'];

    $sql = "INSERT INTO visitor_data (visitor_name, department, time_stamp) VALUES ('$visitorName', '$department', NOW())";
        if (mysqli_query($conn, $sql)) {
            echo "Visitor's name updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}

// Delete rows older than 3 minutes
$sqlDelete = "DELETE FROM visitor_data WHERE time_stamp < (NOW() - INTERVAL 3 MINUTE)";
if (mysqli_query($conn, $sqlDelete)) {

    // Reset auto-increment to 1
    $reset_auto_increment = "ALTER TABLE visitor_data AUTO_INCREMENT = 1";
    if (mysqli_query($conn, $reset_auto_increment)) {
        echo "";
    } else {
        echo "Error resetting auto-increment: " . mysqli_error($conn);
    }
} else {
    echo "Error deleting rows: " . $sqlDelete . "<br>" . mysqli_error($conn);
}


//FETCH VIDEO 
$sql = "SELECT * FROM videos_displayer WHERE id = 1"; // Adjust the query based on your needs
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $videoFilePath = $row['location'];
} else {
    echo "";
}

mysqli_close($conn);
?>