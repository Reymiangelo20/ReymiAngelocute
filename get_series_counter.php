<?php
$counterFile = 'series_counter.txt';

if (file_exists($counterFile)) {
    $seriesCounter = intval(file_get_contents($counterFile));
} else {
    $seriesCounter = 1;
}

// Return the current series counter
echo $seriesCounter;
?>
