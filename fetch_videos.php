<?php
    include("connect.php");
    
    // FETCH ALL VIDEOS
    $sql = "SELECT * FROM videos";
    $result = $conn->query($sql);

    $videos = array(); // Create an array to store video information

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $videos[] = array(
                'id' => $row['id'],
                'location' => $row['location'],
                'name' => $row['name']
            );
        }
    } else {
        echo "";
    }

    mysqli_close($conn);
?>