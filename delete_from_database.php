<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the reference_no parameter is set in the POST request
if (isset($_POST['referencecode'])) {
    // Get the referencecode from the AJAX request
    $referencecode = $_POST['referencecode'];

    // SQL to delete data based on referencecode
    $sql = "DELETE FROM control_number WHERE reference_no = '$referencecode'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If reference_no is not set in the POST request, handle the error
    echo "Error: referencecode parameter not set in the request.";
}

// Close the database connection
$conn->close();
?>
