<?php
require_once("connection.php");
$sql = "SELECT * FROM pending";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
    <link rel="stylesheet" href="orders.css">
</head>
<body>
    <header>
        <h1>On Process Delivery</h1>
            <nav> 
                <li><a href="adminpage.php">Product list </a></li>
                <li><a href="usersAccount.php">Account list</a></li>
                <li><a href="adminproductadd.php">Add Product</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="#">Refunds</a></li>
                <li><a href="#" id="logoutBtn">LOGOUT</a></li>
            </nav>
    </header>
    <div class="scroll">
        <table>
            <tr>
                <th>Buyer Name:</th>
                <th>Location:</th>
                <th>Orders:</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['city'] ?>, <?php echo $row['province'] ?></td>
                <td class="link"><a href="customer_order.php?id=<?php echo $row['id'] ?>&name=<?php echo urlencode($row['name']) ?>&product_price=<?php echo $row['product_price'] ?>&quantity=<?php echo $row['quantity'] ?>&product_size=<?php echo $row['product_size'] ?>&address=<?php echo $row['address'] ?>&baranggay=<?php echo $row['baranggay'] ?>&city=<?php echo $row['city'] ?>&province=<?php echo $row['province'] ?>&zip_code=<?php echo $row['zip_code'] ?>&image=<?php echo $row['image'] ?>&contact_number=<?php echo $row['contact_number'] ?>">View Orders</a></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
    
    
</body>
<script src="logout.js"></script>
</html>