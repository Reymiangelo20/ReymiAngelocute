<?php
// Create a database connection
$conn = mysqli_connect("localhost", "root", "root", "e-logsheet");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>