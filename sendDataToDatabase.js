function sendDataToDatabase() {
  // Get the form data
  var formData = $('.controlForm').serialize();

  // Send an AJAX POST request to the PHP script
  $.ajax({
      type: 'POST',
      url: 'insert_data.php', // Replace with your PHP script URL
      data: formData,
      success: function (response) {
          window.location.reload();
      },
      error: function () {
          // Handle any errors that occur during the AJAX request
          alert('Error sending data to the database');
      }
  });
}
