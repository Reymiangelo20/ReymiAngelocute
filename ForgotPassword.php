<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Electronic Visitors Logbook</title>
        <link rel="stylesheet" href="ForgotPassword.css">
        <link rel="icon" type="png" href="deped.logo.jpg">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
        <link rel="website icon" type="png" href="monitoring logbook logo.jpeg.png">
    </head>

    <body>
    <div class="loader" id="loader"></div>
    <div class="box"></div>
    <div class="box2">

        <div class="center-div" id="centerdiv">

            <div class="header">
                <h1>Forgot Password</h1>
            </div>

            <div class = "message">
                <p>Enter your email associated with your account. Your temporary password will be sent to your e-mail.</p>
            </div>

            <div>
                <input type="text"  id="emailinput" placeholder="Enter email address here"></input>
             </div>

            
             <div class="button-div">    
                    <button type="submit" class="sendcodebtn" id="send_code">Submit</button>
                    <button class="cancelforgotbtn" onclick= "window.location.href='AdminLogin.php'">Cancel</button>
            </div>
         

        </div>





        <div class="center-div2" id="centerdiv2">

        <div class="header">
            <h1>CHECK YOUR EMAIL</h1>
            </div>
            <div class = "message">
            <p class="msg-div2">Your new password is sent to your e-mail. 
            <br>You may update your password immediately after logging in.
            </p>
            </div>

            <div class="button-div">    
                    <button class="cancelforgotbtn" onclick= "window.location.href='AdminLogin.php'">Back</button>
            </div>
        
            <!--<div class="code-div">
            <input class="entercode"type="text" name="code_input" id="code_input" placeholder="Enter Code here"></input>
            </div>-->

            <!--<div class = "codebtn-div">
            <button class="verify-code" id="verify-code">Verify</button>
            <button class="re-send" id="re-send">Resend</button>
            <div id="timer" class="timer"></div>
            <p class="small_loader_div" id="small_loader"></p>
            </div>
           
            <div>
             <div class="button-div">    
            <button class="backtoemail" id="backtoemail" >back</button>      
            </div>
            </div>-->
           

        </div>

        <div class="center-div3" id="centerdiv3">

        <div class="header">
            <h1>Create new password</h1>
            </div>

            <div class ="password-div">

            <input class="password"type="password" name="newpass" id="newpass" placeholder="Enter new password"></input>
           <i class="fa fa-eye" id="reveal-p"></i>
            <input class="confirmpassword"type="password" name="newpassconfirm" id="newpassconfirm" placeholder="Confirm Password"></input>
            <i class="fa fa-eye" id="reveal-cp"></i>
             </div>
            
             <div class="password-btn-div">
             <button class="change" id="changepass">Change</button>
            <button class="emailback" id="emailback" >Cancel</button>
             </div>
            
           

        </div>
    </div>

  
    </div>


<script>
    var intervalId;
    var time = 60;

    $(document).ready(function(){
        $('#reveal-p').click(function(){
            
            toggle = document.getElementById("reveal-p");
            password = document.getElementById("newpass");
            if(password.type == "password"){
                password.type = "text";
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            }else{
                password.type = "password";
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        });
    });


    $(document).ready(function(){
        $('#reveal-cp').click(function(){
            
            toggle = document.getElementById("reveal-cp");
            password = document.getElementById("newpassconfirm");
            if(password.type == "password"){
                password.type = "text";
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            }else{
                password.type = "password";
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        });
    });



    
    //verification code timer
    function CodeTimer() {
        intervalId = setInterval(function() {
        time--;
        document.getElementById("timer").innerHTML = time;
            if (time == 0) {
                time = 60;
                clearInterval(intervalId);
                $('#re-send').css('display', 'block');
                $('#timer').css('display', 'none');
                $.ajax({
                        type: "POST",
                        url: "AutoDeleteCode.php",
                        success: function(response){
                            if( $.trim(response) == "success"){
                                
                            }else{

                            }
                        }, error:function(xhr, status, error){
                            alert("Connection Error");
                        }
                    });
            }
    }, 1000);
    }

     //send verification code to email
     $(document).ready(function(){
     $('#send_code').click(function(){
        var email = document.getElementById('emailinput').value;
        $('#loader').css('display', 'block');
        $.ajax({
            type: 'POST',
            url: 'SendVerificationCode.php',
            data: {email : email},
            success: function(response){
                if(response == "email does not exists"){
                    $('#loader').css('display', 'none');
                    swal("Email does not exist", "Check the email you entered properly", "error");
                    $("#emailinput").val("");

                }else if (response == "Empty Input field"){
                    $('#loader').css('display', 'none');
                    swal("Empty field", "Please enter your email", "error");
                    
                }
                
                else{
                    $("#emailinput").val("");
                    $('#timer').css('display', 'block');
                    $('#centerdiv').css('display', 'none');
                    $('#centerdiv2').css('display', 'block');
                    $('#loader').css('display', 'none');
                    CodeTimer();
                }

            },
            error: function(xhr, status, error){
                alert("Connection ErRor");
                $('#loader').css('display', 'none');

            }
            });
         });
     });
  
//verify code 
$(document).ready(function () {
        $('#verify-code').click(function () {
            var code = document.getElementById('code_input').value;
            $.ajax({
                type: "POST",
                url: "VerifyCode.php",
                data: { code: code },
                success: function (response) {
                    if (response == "code not match") {
                        swal("Please provide a valid code.");
                        $("#code_input").val("");
                    } else if (response == "code field is empty") {
                        swal("Code field is empty. Please enter the code.");
                    } else if (response == "error fetching code") {
                        swal("Error fetching code.");
                        $("#code_input").val("");
                    } else {
                        swal("Code Verified");
                        $('#centerdiv').css('display', 'none');
                        $('#centerdiv2').css('display', 'none');
                        $('#centerdiv3').css('display', 'block');
                    }
                },
                error: function (xhr, status, error) {
                    swal("Connection Error");
                }
            });
        });
    });

        $(document).ready(function(){
        $('#re-send').click(function(){
            
            $('#re-send').css('display', 'none');
             $('#timer').css('display', 'none ');
             $('#small_loader').css('display', 'block');

             $.ajax({
                url: "ResendVerificationCode.php",
                type: "POST",
                success: function(response){
                    if (response == "error email"){
                       

                    }else{
                        $('#small_loader').css('display', 'none');
                        $('#timer').css('display', 'block');
                        time = 60;
                        document.getElementById("timer").innerHTML = time;
                        CodeTimer();
                    }
                },
                error: function(xhr, status, error){
                }
             });
        });
    });


     //update user password
     $(document).ready(function(){
        $('#changepass').click(function(){
            var password = document.getElementById('newpass').value;
            var confirmpassword = document.getElementById('newpassconfirm').value;
            if(password!=confirmpassword){
                swal({
						title: "Password does not match",
						text: "Check the password you entered",
						icon: "warning",
						closeOnEsc: false,
						closeOnClickOutside: false,	
					})
            }else{
                $.ajax({
                type: "POST",
                url: "UpdatePassword.php",
                data:{password: password},
                success: function(response){
                    if(response == "error updating password"){
                        swal({
								title: "Error updating password",
								text: "",
								icon: "warning",
								closeOnEsc: false,
								closeOnClickOutside: false,	
							})
                    }else{  
                        swal({
								title: "Password has been reset",
								text: "",
								icon: "success",
								closeOnEsc: false,
								closeOnClickOutside: false,	
							})
							.then((confirm) => {
								if (confirm) {
                                    window.location.href = "AdminLogin.php";
								}
							});
                       
                    }
                },
                error: function(xhr, status, error) {
						alert("error asdadas")
					}
            });
           
            }            
        });
    });

    $(document).ready(function(){
        $('#backtoemail').click(function(){
            $('#centerdiv').css('display', 'block');
            $('#centerdiv2').css('display', 'none');
            $("#code_input").val("");
            clearInterval(intervalId);
            time = 60;
            document.getElementById("timer").innerHTML = time;
        });
    });


    $(document).ready(function(){
        $('#emailback').click(function(){
            $('#centerdiv').css('display', 'block');
            $('#centerdiv2').css('display', 'none');
            $('#centerdiv3').css('display', 'none');


        });
    })
</script>

    </body>
    
   
           

</html>