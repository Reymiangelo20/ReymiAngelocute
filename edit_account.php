<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission here

    // Retrieve form data
    $selectedEmail = $_POST['selected_email']; // Assuming this is the selected email for the user you want to edit
    $userPosition = $_POST['userposition']; // Assuming this is the new user position

    // Check if 'userOffice' is set in $_POST, if not, set a default value
    $userOffice = isset($_POST['Office'][0]) ? $_POST['Office'][0] : "Default Office";


    // Use prepared statement to update data in the database
    $stmt = $conn->prepare("UPDATE e_logsheetaccounts SET userPosition = ?, userOffice = ? WHERE depedEmail = ?");
    $stmt->bind_param("sss", $userPosition, $userOffice, $selectedEmail);

    // Set parameters and execute
    $userPosition = $_POST['userposition'];
    // Note: $userOffice is already set based on whether it's in $_POST or not
    $selectedEmail = $_POST['selected_email'];

    $stmt->execute();

    // Close statement
    $stmt->close();

    // Redirect to user_accounts.php after successful update
    header("Location: user_accounts.php");
    exit();
}

// Rest of your PHP code...
