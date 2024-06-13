<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "upload"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usersAccount.css">
    <title>Admin Users</title>
</head>
<body>
    <nav> 
        <li><a href="adminpage.php">Product list </a></li>
        <li><a href="usersAccount.php">Account list</a></li>
        <li><a href="adminproductadd.php">Add Product</a></li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="#">Refunds</a></li>
        <li><a href="#" id="logoutBtn">LOGOUT</a></li>
    </nav>
    <div class="table-container">
        <table class="table" border="2">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Account Type</th>
            </tr>
        </thead>
        <tbody id="userList">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["firstName"] . "</td>
                            <td>" . $row["lastName"] . "</td>
                            <td>" . $row["userName"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["accountPass"] . "</td>
                            <td>" . $row["account_type"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
   
<script src="logout.js"></script>
</html>
</body>
</html>

