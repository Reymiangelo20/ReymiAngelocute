<?php

require_once("connect.php");

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

// SQL query to select data from the e_logsheetaccounts table
$sql = "SELECT * FROM e_logsheetaccounts";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bookman+Old+Style">
    <script src="https://kit.fontawesome.com/7d8e1e46c6.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="user_accounts.css">
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    <title>User Accounts</title>
</head>
<body>
    <header>
        <img src="monitoring logbook logo.jpeg.png" alt="">
        <h1>USER ACCOUNTS</h1>
    </header>
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
        <table id="monitoringTable">
            <thead>
                <tr>
                    <th id="colNo">No.</th>
                    <th id="colaccountType">accountType</th>
                    <th id="colaccountName">accountName</th>
                    <th id="coluserPosition">userPosition</th>
                    <th id="coluserOffice">userOffice</th>
                    <th id="coldepedEmail">depedEmail</th>
                    <th id="colaccountPass">accountPass</th>
                </tr>
            </thead>
            <?php
            if ($result->num_rows > 0) {
                $rowNumber = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowNumber . "</td>";
                    echo "<td>" . $row["accountType"] . "</td>";
                    echo "<td>" . $row["accountName"] . "</td>";
                    echo "<td>" . $row["userPosition"] . "</td>";
                    echo "<td>" . $row["userOffice"] . "</td>";
                    echo "<td>" . $row["depedEmail"] . "</td>";
                    echo "<td>******</td>";
                    echo "</tr>";
                    $rowNumber++;
                }
            }
            ?>
        </table>
    </div>  
    <nav>
        <ul>
            <li>
                <a href="#" class ="account">Account</a>
                <ul class="dropdown">
                    <li><a href="#" onclick="openAdd()">Add</a></li>
                    <li><a href="#" onclick="openEdit()">Edit</a></li>
                    <li><a href="#" onclick="openDelete()">Delete</a></li>
                </ul>
            </li>
        </ul>
    </nav>



    <!-----Add Propmpt------->
    <div class="popup" id="popup">
        <form class="insert_form" id="insert_form" method="post" action="useraccounts.php" onsubmit="return validateForm();">
            <h2>ADD ACCOUNTS</h2> 
            <div class="accountype">
                <label for="accountTypeSelect" class="accountTypeLabel">Account Type:</label>
                <select name="account_Type[]" class="dropdownaccountType" name="accountTypeSelect" id="accountTypeSelect">
                    <option value="">Select Account Type</option>
                    <option value="Admin">Admin</option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Queuing System">Queuing System</option>
                    <option value="Security Guard">Security Guard</option>
                </select>
            </div>
            <div class="accountname">
                <label for="accountNameInput">Name:</label>
                <input type="text" name="account_Name[]" id="accountNameInput" placeholder="Full Name" required><br>
            </div>
            <div class="userposition">
                <label for="userPositionInput">Position:</label>
                <input type="text" name="user_Position[]" id="userPositionInput" required><br>
            </div>
            <div class="useroffice">
            <label for="userOfficeSelect">Office:</label>
            <?php
                $query = "select userOffice from e_logsheetaccounts ORDER BY userOffice ASC";
                $result = mysqli_query($conn,$query);
            ?>
            <select name="user_Office[]" class="dropdownuserOffice" id="userOfficeSelect">
                <option value="">Select Office</option>
                <?php
                    // Dropdownlist
                    $officeNames = []; // Array to store unique office names
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $officeName = $row['userOffice'];

                            // Convert office name to lowercase to ensure case-insensitivity
                            $officeNameLowercase = strtolower($officeName);

                            // Check if the lowercase office name is not already in the array
                            if (!in_array($officeNameLowercase, $officeNames)) {
                                // Add the lowercase office name to the array
                                $officeNames[] = $officeNameLowercase;

                                // Output the option with the original case
                                echo "<option value='" . $officeName . "'>" . $officeName . "</option>";
                            }
                        }
                    } else {
                        echo "<option value=''>No items available</option>";
                    }
                ?>
                <option value="custom" id="custom">Custom</option>
            </select>
            </div>
            <div class="depedemail">
                <label for="depedEmailInput">Deped Email:</label>
                <input type="email" placeholder="example@deped.gov.ph" name="deped_Email[]" id="depedEmailInput" required pattern=".+@deped\.gov\.ph$">
            </div>
            <div class="accountpass">
                <label for="accountPassInput">Password:</label>
                <input type="text" name="account_Pass[]" id="accountPassInput" required>
            </div>
            <div class="buttons">
                <input class="Register" type="submit" name="register" id="register" value="Register">
                <button type="button" class="Close" onclick="closeAdd()">Close</button>    
            </div>
        </form> 
    </div>
    <!-----Add Propmpt END------->



    <!-----Edit Prompt------->              
    <div class="popup2" id="popup2">
        <form method="POST" action="edit_account.php">
            <h2>EDIT ACCOUNT</h2>
            <?php //To connect Dropdown to database
                $sql = "SELECT depedEmail FROM e_logsheetaccounts ORDER BY depedEmail ASC";
                $result = $conn->query($sql);
            ?>
            <select name="selected_email" id="selectedEmail" class="dropdownedit"> 
                <?php //Dropdownlist
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()){
                            echo "<option value='" . $row['depedEmail'] . "'>" . $row['depedEmail'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No items available</option>";
                    }
                ?>
            </select>
            <div class="User_Office">
                <label for="OfficeInput">Office:</label>
                <?php
                    $query = "select userOffice from e_logsheetaccounts ORDER BY userOffice ASC";
                    $result = mysqli_query($conn,$query);
                ?>
                <select name="Office[]" class="dropdownOffice" id="OfficeSelect">
                    <option value=""Default Value>Select Office</option>
                    <?php
                    // Dropdownlist
                    $officeNames = []; // Array to store unique office names
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $officeName = $row['userOffice'];

                            // Convert office name to lowercase to ensure case-insensitivity
                            $officeNameLowercase = strtolower($officeName);

                            // Check if the lowercase office name is not already in the array
                            if (!in_array($officeNameLowercase, $officeNames)) {
                                // Add the lowercase office name to the array
                                $officeNames[] = $officeNameLowercase;

                                // Output the option with the original case
                                echo "<option value='" . $officeName . "'>" . $officeName . "</option>";
                            }
                        }
                    } else {
                        echo "<option value=''>No items available</option>";
                    }
                ?>
                </select>
            </div>
            <div class="User_Position">
                <label for="userPositionInput2">Position:</label>
                <input type="text" name="userposition" id="userPositionInput2" required>
            </div>
            <div class="buttons2">
                <button type="submit" class="Save2">Save</button>
                <button type="button" class="Close2" onclick="closeEdit()">Close</button>
            </div>
        </form>
    </div>

    <!-----Edit Prompt------->



    <!-----Delete Prompt------->
    <div class="popup3" id="popup3">
        <form method="POST" action="delete_account.php">
            <h2>DELETE INVENTORY</h2>
            <?php //To connect Dropdownlist to database
                $sql = "SELECT depedEmail FROM e_logsheetaccounts ORDER BY depedEmail ASC";
                $result = $conn->query($sql);
            ?>
            <select name="selected_item_delete" class="dropdowndelete"> 
                <?php //Dropdownlist Delete
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()){
                            echo "<option value='" . $row['depedEmail'] . "'>" . $row['depedEmail'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No items available</option>";
                    }
                ?>
            </select>
            <div class="buttons3">
                <button type="submit" class="Delete" name="delete_account">DELETE</button>
                <button type="button" class="Close3" onclick="closeDelete()">Close</button>
            </div>
        </form>   
    </div>
    <!-----Delete Prompt------->
 
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="add,edit,delete.js"></script>
</html>
