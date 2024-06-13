$(document).ready(function() {
    // Fetch the last series number and year from the server
    $.ajax({
        url: 'get_last_series_year.php',
        method: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            let lastSeriesNumber = parseInt(data.lastSeriesNumber);
            let lastYear = parseInt(data.lastYear);

            if (isNaN(lastSeriesNumber)) {
                lastSeriesNumber = 0;
            }
            if (isNaN(lastYear)) {
                lastYear = 0;
            }

            // Get the year and month from worldtimeapi
            $.ajax({
                url: 'https://worldtimeapi.org/api/ip',
                dataType: 'json',
                success: function(data) {
                    const onlineDate = new Date(data.utc_datetime);
                    const currentYear = onlineDate.getUTCFullYear();
                    const month = (onlineDate.getUTCMonth() + 1).toString().padStart(2, '0');

                    if (lastYear !== currentYear) {
                        lastSeriesNumber = 1; // Reset the series number to 1 for a new year
                        lastYear = currentYear; // Update the last year
                    } else {
                        lastSeriesNumber++; // Increment the series number within the same year
                    }

                    // Format the series number
                    const formattedSeriesNumber = String(lastSeriesNumber).padStart(6, '0');

                    // Combine the year, month, and series number
                    const risNoDate = currentYear + '-' + month + '-' + formattedSeriesNumber;

                    // Set the formatted date as the value of the input element
                    $(".risNoDate").val(risNoDate);
                },
                error: function(error) {
                    console.error('Error fetching online date:', error);
                }
            });
        },
        error: function() {
            console.error("Error fetching last series number and year.");
        }
    });
});

