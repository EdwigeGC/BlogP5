<?php

namespace App\model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactManager
{
    public function sendMail($name,  $email, $message)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //Ask PHPMailer to use SMTP
            $mail->IsSMTP();
            $mail->Host = 'smtp.mail.com';                             //SMTP name
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'username@mail.com';                    // SMTP username
            $mail->Password   = 'password';                             // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('username@mail.com');    //add recipient e-mail adress

            // Content

            $mail->isHTML(true);    // Set email format to HTML
            $mail->Subject = 'Blog P5: formulaire de contact';
            $mail->Body = '<html>
            <p>De:<br>' . $name . '<br></p>
            <p>Adresse E-mail:<br> ' . $email . '<br></p>
            <p>Message:<br>' . $message . '</p>
            </html>';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
