<?php
session_start();
require_once("connect.php");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "e-logsheet";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/7d8e1e46c6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bookman+Old+Style">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="table2excel.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="appearance.css">
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    <title>CERTIFICATE OF APPEARANCE LIST</title>
</head>

<body>
    <header>
        <img src="monitoring logbook logo.jpeg.png" alt="">
        <h1>CERTIFICATE OF APPEARANCE LIST</h1>
    </header>
    </div>
    <input type="checkbox" name="" id="check">
    <div class="container">
        <label for="check">
            <span class="bx bx-x" id="cross"></span>
            <span class="bx bx-menu" id="bars"></span>
        </label>
    <div class="head">MENU</div>
        <ol>
            <li> <a href="e_logsHistory.php"><i class='bx bx-history'></i>E-LOG'S HISTORY</a></li>
            <li> <a href="unsuccessful_appointment.php"><i class='bx bx-clipboard'></i></i></i>UNSUCCESSFUL APPOINTMENTS</a></li>
            <li> <a href="appearance.php"><i class="fa-regular fa-file-lines" style="color: #f4f7fa;"></i>CERTIFICATE LIST</a></li>
            <li> <a href="user_accounts.php"><i class='bx bxs-user-account' ></i></i>USER ACCOUNTS</a></li>
            <li> <a href="ActivityLogs.php"><i class='bx bx-list-ul'></i>ACTIVITY LOG</a></li>
            <li> <a href="queuing_system_videouploader.php"><i class='bx bx-cloud-upload'></i>UPLOADER</a></li>
            <li> <a href="change_password.php"><i class='bx bx-lock-alt'></i>CHANGE PASSWORD</a></li>
            <li> <a href="log_out.php"><i class='bx bx-log-out'></i>LOGOUT</a></li>
        </ol>
    </div>   
    <div class="scroll">
        <form action="" method="post">
            <table id="monitoringTable" border="1">
                <thead>
                    <tr>
                        <th id="colNo">Date Issued</th>
                        <th id="colFullName">Full Name</th>
                        <th id="colcertificate">Certificate</th>
                    </tr>
                </thead>

                <?php
                $query = "SELECT * FROM control_number ORDER BY timeStamp desc";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $referencecode = $row["seriesNumber"];
                        $dateIssued = date('F d, Y', strtotime($row['timeStamp']));
                        echo "<tr class='highlight-row'>";
                        echo "<td>" . $dateIssued . "</td>";
                        echo "<td class='fullname'>" . htmlspecialchars($row['fullname']) . "</td>";
                        ?>
                       <td> <a href="certificate_history.php?seriesNumber=<?php echo $referencecode; ?>" class="certificate" data-referencecode="<?php echo $referencecode; ?>">Certificate</a> </td>
                        <?php
                        echo "</tr>";
                    }
                } else {
                    echo "No transferred row data found.";
                }
                mysqli_close($conn); // Close the database connection
                ?>

            </table>
        </form>
    </div>
</body>
</html>
