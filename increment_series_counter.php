<?php
$counterFile = 'series_counter.txt';

// Start the session
session_start();

// Check if the series counter is set in the session
if (isset($_POST['seriesCounter'])) {
    // Acquire an exclusive lock on the session data
    session_write_close();

    // Update the series counter received from the client
    $seriesCounter = intval($_POST['seriesCounter']);
    $seriesCounter++;

    // Check if the last inserted series number is deleted
    if (isLastInsertedSeriesDeleted($seriesCounter)) {
        // Reset the counter to the previous value
        $seriesCounter = intval(file_get_contents($counterFile));
    }

    // Save the updated counter to the file
    file_put_contents($counterFile, $seriesCounter);

    // Return the updated series counter
    echo $seriesCounter;
} else {
    // If series counter is not provided, return an error
    http_response_code(400);
    echo "Error: Series counter not provided.";
}

// Function to check if the last inserted series number is deleted
function isLastInsertedSeriesDeleted($seriesCounter)
{
    // Replace the following code with your logic to check if the last inserted series number is deleted
    // Return true if the series number is deleted, false otherwise

    // Example code:
    $lastInsertedSeriesNumber = getLastInsertedSeriesNumber(); // Replace this with your logic to get the last inserted series number
    return $lastInsertedSeriesNumber === $seriesCounter;
}

// Function to get the last inserted series number
function getLastInsertedSeriesNumber()
{
    // Replace the following code with your logic to retrieve the last inserted series number from the database
    // Return the last inserted series number or an appropriate default value

    // Example code:
    return 2; // Replace this with your actual logic to get the last inserted series number
}
?>
