<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Monitoring Visitors Logsheet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="icon" type="image/x-icon" href="blur logo.jpeg.jpg">
    <link rel="stylesheet" href="change_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
  </head>
  <body>
    <div class="login_form">
      <div class="wrapper">
        <div class="title"><span>CHANGE YOUR PASSWORD <br> <div class="title_two">HERE</div></span></div>
        <form name="form" action="change_passVerification.php" method="POST">
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="text" placeholder="Current Password" name="accountPass" required>
          </div>
          <div class="row">
              <i class="fas fa-lock"></i>
              <input type="password" id="newAccountPass" placeholder="New Password" name="newAccountPass" required>
          </div>
          <div class="row">
              <i class="fas fa-lock"></i>
              <input type="password" id="confirmNewAccountPass" placeholder="Confirm New Password" name="confirmNewAccountPass" required>
          </div>
          <div class="button-container">
          <input type="submit" class="change-password-button" value="Change Password" name="submit">
          <input type="button" class="cancel-button" value="Cancel" onclick="back()">
        </div>

        </form>
      </div>
    </div>
    <script>
      function back(){
        location.href = "e_logsHistory.php"
      }
    </script>
  </body>
</html>