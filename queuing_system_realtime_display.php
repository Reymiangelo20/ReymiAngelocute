<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT visitor_name, department FROM visitor_data ORDER BY id DESC LIMIT 20";
$result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
