<?php
    include ('login_server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bookman+Old+Style">
    <script src="https://kit.fontawesome.com/7d8e1e46c6.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Adminlogin.css">
    <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    <title>Admin Log in</title>
</head>
<body>
    <div class="container">
        <label for="email"><i class="fa-solid fa-user-tie"></i></label> <!-- Add "for" attribute with a valid input "id" -->
        <h1 class="label">LOGIN</h1>
        <form class="login_form" method="post" name="form" onsubmit="return validated()">
            <div class="emailfont">Email</div>
            <input autocomplete="on" type="text" name="email" id="email" placeholder="Enter your email" required>
            <div class="passfont">Password</div>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="login" id="loginButton">LOGIN</button> <!-- Change "type" attribute to "submit" -->
            <a href="ForgotPassword.php"class="forgotpassword">Forgot Password</a>
        </form>
    </div>
    <script src="login.js"></script> 
    <script src="disablebackbutton.js"></script>
</body>
</html>
