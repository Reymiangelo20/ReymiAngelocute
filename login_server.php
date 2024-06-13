<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "e-logsheet";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_POST['login'])){
        $loginEmail = $_POST['email'];
        $loginPass = $_POST['password'];

        $sql = "SELECT * FROM e_logsheetaccounts WHERE depedEmail = '$loginEmail' AND accountPass = '$loginPass'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count==1 ){
            $_SESSION['accountName'] = $row['accountName'];
            $_SESSION['userPosition'] = $row['userPosition'];
            $_SESSION['userOffice'] = $row['userOffice'];
            $_SESSION['depedEmail'] = $row['depedEmail'];
            $_SESSION['accountPass'] = $row['accountPass'];
            
            // check account type so user will access webpage based on their account type
            $accountType = $row['accountType'];
            if ($accountType == 'Admin') {
                header("Location: admin_webpage.php"); 
            } elseif ($accountType == 'User Manager') {
                header("Location: e_monitoring.php"); 
            } elseif ($accountType == 'Security') {
                header("Location: e_monitoringLogsheet.php"); 
            } elseif ($accountType == 'Super Admin') {
                header("Location: e_logsHistory.php");
            } elseif ($accountType == 'Queuing System') {
                header("Location: queuing_system.php");
            }else {
                echo '<script>
                alert("Login failed. Invalid DepEd E-mail or password.")
                window.location.href = "AdminLogin.php";
                </script>';
            }
        } else {
            echo '<script>
                alert("Login failed. Invalid DepEd E-mail or password.")
                window.location.href = "AdminLogin.php";
                </script>';
        }
    }
?>