// Existing code
function breakDownWords(text) {
    const words = text.split(' ');
    const maxWordsPerLine = 8;
    let lines = [];
    for (let i = 0; i < words.length; i += maxWordsPerLine) {
        lines.push(words.slice(i, i + maxWordsPerLine).join(' '));
    }
    return lines.join('<br>');
}

function generatePDF() {
    var reference_no = document.querySelector('.reference_no').innerText.trim();

    // Add an AJAX request to check if the reference_no already exists
    $.ajax({
        type: 'POST',
        url: 'check_reference_no.php',
        data: { reference_no: reference_no },
        success: function (response) {
            if (response === 'exists') {
                // Use SweetAlert for a more user-friendly alert
                Swal.fire({
                    icon: 'warning',
                    title: 'Certificate Already Printed',
                    text: 'Check in the Certificate of Appearnce list webpage.',
                    confirmButtonText: 'OK',
                });
            } else {
                // Continue with generating PDF if the reference_no doesn't exist
                var formContent = document.getElementById("certificateBody");
                var options = {
                    margin: 0,
                    filename: 'Certificate of Appearance.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                html2pdf(formContent, options);
                setTimeout(function () {
                    document.getElementById("btnPrint").click();
                }, 1000);
            }
        },
        error: function (error) {
            console.error('Error checking reference_no:', error);
        }
    });
}

function goToLogsHistory() {
    window.location.href = 'e_logsHistory.php';
}
