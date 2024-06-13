<?php
// Connect to the database
require("connect.php");

// Check if the form has been deletion
if (isset($_POST["delete_account"])) {
    // Get the selected item from the dropdown
     $selectedItem = $_POST["selected_item_delete"];

    // Perform the deletion query
    $sql = "DELETE FROM e_logsheetaccounts WHERE depedEmail = '$selectedItem'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: user_accounts.php");   
    }                             
}
?>