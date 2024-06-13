<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goldtag</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <section>
        <div class="bar">
            <h1>Sign Up</h1>
            <form id="signupForm" method="post" action="submit.php">
                <input type="text" id="firstName" name="firstName" placeholder="First Name"required>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name"required>
                <input type="text" id="userName" name="userName" placeholder="Username"required>
                <input type="email" id="email" name="email" placeholder="Email"required>
                <input type="tel" id="contact_number" name="contact_number" placeholder="Phone Number" pattern="[0-9]*" maxlength="11" required>
                <input type="password" id="password" name="accountPass" placeholder="Password" required>
                <button type="submit" id="signup">Sign Up</button>
            </form>
            <p1>Already have an account? <a href="login.php">Login</a></p1>
        </div>
        <p></p>
    </section>

     <script>
        document.addEventListener("DOMContentLoaded", function () {
            var contactNumberInput = document.getElementById("contact_number");

            contactNumberInput.addEventListener("input", function () {
            
                this.value = this.value.replace(/\D/g, '');

              
                if (this.value.length > 11) {
                    this.value = this.value.slice(0, 11);
                }
            });
        });
    </script>

</body>
</html>
