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
    $accountType = $_POST['account_Type'][0]; // Assuming only one option is selected
    $accountName = $_POST['account_Name'][0];
    $userPosition = $_POST['user_Position'][0];
    $userOffice = $_POST['user_Office'][0];
    $depedEmail = $_POST['deped_Email'][0];
    $accountPass = $_POST['account_Pass'][0];

    // Use prepared statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO e_logsheetaccounts (accountType, accountName, userPosition, userOffice, depedEmail, accountPass) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $accountType, $accountName, $userPosition, $userOffice, $depedEmail, $accountPass);

    // Set parameters and execute
    $accountType = $_POST['account_Type'][0];
    $accountName = $_POST['account_Name'][0];
    $userPosition = $_POST['user_Position'][0];
    $userOffice = $_POST['user_Office'][0];
    $depedEmail = $_POST['deped_Email'][0];
    $accountPass = $_POST['account_Pass'][0];

    $stmt->execute();

    // Close statement
    $stmt->close();

    // Redirect to user_accounts.php after successful insertion
    header("Location: user_accounts.php");
    exit();
}

// Rest of your HTML and PHP code...
