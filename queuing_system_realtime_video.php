<?php
include("connect.php");

// Fetch the latest video file path from the database
$sql = "SELECT location FROM videos_displayer ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $videoFilePath = $row['location'];
    echo json_encode(['videoFilePath' => $videoFilePath]);
} else {
    // Default video file path if no data is available
    echo json_encode(['videoFilePath' => 'default_video.mp4']);
}

// Close the database connection
$conn->close();
?>
