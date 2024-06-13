<?php
session_start();
require_once("connect.php");

$reference_no = $_POST['reference_no'];

// Assuming you have a column named 'certificate_printed' in your database table
$query = "UPDATE e_logsHistory SET risNoDate = 1 WHERE reference_no = '$reference_no'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "success";
} else {
    echo "error";
}

mysqli_close($conn);
?>
