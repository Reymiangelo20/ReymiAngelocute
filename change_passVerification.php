<?php

include('login_server.php');

if (isset($_POST['submit'])) {

    // Retrieve the current user's email and password from the session
    $loginEmail = $_SESSION['depedEmail'];
    $loginPass = $_SESSION['accountPass'];

    // Sanitize and validate input
    $currentPassword = $_POST['accountPass'];
    $newPassword = $_POST['newAccountPass'];
    $confirmPassword = $_POST['confirmNewAccountPass'];

    // Retrieve the current password from the database
    $sql = "SELECT * FROM e_logsheetaccounts WHERE depedEmail = '$loginEmail'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $accountPass = $row['accountPass'];
        // Verify the current password
        if ($accountPass === $currentPassword) {
            // Check if new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Update the user's password
                $updateSql = "UPDATE e_logsheetaccounts SET accountPass = '$confirmPassword' WHERE depedEmail = '$loginEmail'";
                $updateResult = mysqli_query($conn, $updateSql);

                if ($updateResult) {
                    // Password updated successfully
                    // Redirect user based on their account type
                    $accountType = $row['accountType'];
                    if ($accountType == 'Admin') {
                        echo '<script>
                            alert("Password updated successfully!");
                            window.location.href = "log_out.php";
                          </script>';
                        exit;
                  
                    } elseif ($accountType == 'Super Admin'){
                        echo '<script>
                            alert("Password updated successfully!");
                            window.location.href = "e_logsHistory.php";
                          </script>';
                        exit;
                    }
                } else {
                    // Handle database update error
                    echo '<script>
                            alert("Password update failed. Please try again later.");
                            window.location.href = "change_password.php";
                          </script>';
                    exit;
                }
            } else {
                // New password and confirm password do not match
                echo '<script>
                        alert("New password and confirm password do not match.");
                        window.location.href = "change_password.php";
                      </script>';
                exit;
            }
        } else {
            // Current password is incorrect
            echo '<script>
                    alert("Current password is incorrect.");
                    window.location.href = "change_password.php";
                  </script>';
            exit;
        }
    } else {
        // Handle database query error
        echo '<script>
                alert("Database error. Please try again later.");
                window.location.href = "change_password.php";
              </script>';
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>