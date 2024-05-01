<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../ConnectionDB/connection.php');

if(isset($_POST["action"])){
    try {
        $mail = new PHPMailer(true); 

        $mail->isSMTP();
        $mail->Host  = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'wmsushop@gmail.com'; 
        $mail->Password = 'jnit zbvc dopp rkks'; 
        $mail->SMTPSecure = 'tsl';
        $mail->Port = 587;

        $mail->setFrom('wmsushop@gmail.com', 'wmsuShop');
        $mail->addAddress($_POST["email"]); // Use the email address from the form

        $mail->isHTML(true);
        $mail->Subject = 'Confirmation Link for Your Registration';
        $mail->Body = 'Your account has been approved: <a href="index.php?email=' . urlencode($_POST["email"]) . '">Confirm Registration</a>';
        $mail->AltBody = 'Click on the following link to confirm your registration: index.php';

        $mail->send();
    echo "<script>alert('Message has been sent');</script>";
} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
}
}
?>
