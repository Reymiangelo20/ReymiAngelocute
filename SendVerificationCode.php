<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\EVL\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\EVL\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\EVL\PHPMailer-master\src\SMTP.php';
include('login_server.php');
session_start();

$email = $_POST['email'];

if(!empty($email)){

    $checkemail = "SELECT * FROM `e_logsheetaccounts` WHERE depedEmail = '$email'";
    $result = $conn->query($checkemail);
    if(mysqli_num_rows($result)>0){
        while($row = $result->fetch_assoc()){
            $admin_email  = $row['depedEmail'];           
        }
        
        $_SESSION['email_data'] = $admin_email;
        $mail = new PHPMailer(true);
        $mail->isSMTP();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code_length = 10; // You can change the length as needed
        $finalcode = '';
        for ($i = 0; $i < $code_length; $i++) {
            $random_index = mt_rand(0, strlen($characters) - 1);
            $finalcode .= $characters[$random_index];
        }

        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        //sender username
        $mail ->Username = 'schoolsdivisionoffice@gmail.com';
        //two way pass
        $mail ->Password = 'dohbihlwmzwlzobk';
        $mail ->SMTPSecure='ssl';
        $mail ->Port='465';
        //sender
        $mail ->setFrom('schoolsdivisionoffice@gmail.com','Division Office CSJDM');
        //receiver
        $mail -> addAddress($admin_email);
        $mail->isHTML(true);
        $mail->Subject='Forgot Password';
        $mail->Body="Your New Password Is: ".$finalcode;
        
        $sendcode = "UPDATE `e_logsheetaccounts` SET `accountPass`= '$finalcode' WHERE depedEmail = '$admin_email'";
        $conn->query($sendcode);
        $mail->send();
        $status = "success";
    }else{
    $status = "email does not exists";
    }
   
}
else{
    $status = "Empty Input field";
}



echo $status;



?>
