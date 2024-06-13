<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upload";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$loggedInEmail = $_SESSION['email'];

$query = "SELECT * FROM accounts WHERE email = '$loggedInEmail'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $userName = $row['userName'];
    $email = $row['email'];
    $contactNumber = $row['contact_number'];
    $profileImage = 'profile_image/' . $row['profile_image']; 
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rider_acc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>RIDER ACCOUNT </title>
</head>
<body>
    <div class="container">
        <h1>RIDER ACCOUNT</h1>
        <hr>
    <div class="info">
            <img id="profilePicture" src="<?php echo $profileImage; ?>" alt="Profile Picture">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="file-input-container">
                <input type="file" name="profilePictureInput" id="profilePictureInput">
          </div>    
                <br>
                <label for="profilePictureInput" id="uploadLabel">Choose a file</label>
                <button type="submit">Upload</button>
        </form>
    
          
    </div>
        <div class="data">
            <h3>First Name:</h3><p id="firstName"><?php echo $firstName; ?></p></br>
            <h3>Last Name: </h3><p id="lastName"><?php echo $lastName; ?></p></br>
            <h3>User Name: </h3><p id="userName"><?php echo $userName; ?></p></br>
            <h3>Email: </h3><p id="email"><?php echo $email; ?></p></br>
            <h3>Phone Number: </h3><p id="contact_no"><?php echo $contactNumber; ?></p><br>
            <i class="fa-light fa-cart-shopping"></i>
            <div class="button">
            <a href="profile_edit.php" id="account">Account Settings</a>
                <p><a href="for_delivery.php" class="order">Orders</a></p><br>
                <p><a href="on_process.php" class="refund">On Process Delivery</a></p><br>
                <i class="fa-solid fa-bag-shopping"></i>
                <p><a href="purchase_record.php" class="success">Successful Delivery</a></p><br>
              
            </div>
        </div>
    </div>
</body>
</html>
