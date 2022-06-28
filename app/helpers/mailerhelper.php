<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';



class mailerhelper
{
    public static function sendMail($email, $brand_name, $subject, $msg,$altBody ='')
    {
        $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username ='filip.janjesic@gmail.com';  // YOUR gmail email
        $mail->Password ='';  // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom($email, $brand_name);
        $mail->addAddress($email, $brand_name);
        $mail->addReplyTo($email, $brand_name); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail -> isHTML(true);

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
    }
}



?>