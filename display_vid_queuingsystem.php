<?php
include("connect.php");

$deleteOldDataSql = "DELETE FROM videos_displayer";
if ($conn->query($deleteOldDataSql) === TRUE) {
    $resetAutoIncrementSql = "ALTER TABLE videos_displayer AUTO_INCREMENT = 1";
    if ($conn->query($resetAutoIncrementSql) === TRUE) {
        echo "Auto-increment value reset successfully<br>";
    } else {
        echo "Error resetting auto-increment value: " . $conn->error . "<br>";
    }

} else {
    echo "Error deleting old data: " . $conn->error . "<br>";
}

// Get data from the AJAX request
$name = $_POST['name'];
$location = $_POST['location'];

// Insert new data into the database
$insertNewDataSql = "INSERT INTO videos_displayer (name, location) VALUES ('$name', '$location')";
if ($conn->query($insertNewDataSql) === TRUE) {
    echo "New data successfully inserted into the database";
} else {
    echo "Error inserting new data: " . $insertNewDataSql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
