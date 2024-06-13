<?php
    include("connect.php");

    $sql = "SELECT seriesnumber FROM control_number";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $seriesnumber = $row["seriesnumber"];
    }

    $conn->close();
?>