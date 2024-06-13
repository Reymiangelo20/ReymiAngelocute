    <?php
    session_start();

    // Assuming you have a database connection
    require("connect.php");

    // Query to get the latest data in the seriesNumber and yearRequested columns
    $sql = "SELECT timeStamp, seriesNumber, yearRequested FROM control_number ORDER BY timeStamp DESC LIMIT 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastTimeStamp = $row['timeStamp'];
        $lastSeriesNumber = $row["seriesNumber"];
        $lastYear = $row["yearRequested"];
        $data = array("lastSeriesNumber" => $lastSeriesNumber, "lastYear" => $lastYear, "lastTimeStamp" => $lastTimeStamp);
        echo json_encode($data);
    } else {
        echo json_encode(array("lastSeriesNumber" => 0, "lastYear" => 0));
    }

    // Close the database connection
    $conn->close();
    ?>