async function getCurrentYear() {
    try {
        const response = await fetch('https://worldtimeapi.org/api/ip');
        const data = await response.json();
        if (data && data.datetime) {
            const datetime = new Date(data.datetime);
            const currentYear = datetime.getFullYear();
            
            // Set the current year in the input field
            const yearInput = document.querySelector('.yearRequested');
            yearInput.value = currentYear;
        } else {
            alert("Failed to fetch current year. You will be logged out. Please sync your device's time through settings.");
            // Redirect the user to logout.php
            window.location.href = 'logout.php';
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

getCurrentYear();