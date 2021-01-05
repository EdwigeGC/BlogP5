<?php

namespace App\utilities;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\utilities\ContactConstant;

/**
 * Configuration for contact form
 */
class ContactConfiguration
{
    /**
     * Function used to send datas filled in the form by email
     *
     * @param string $name name of the email sender
     * @param string $email email adresse of the email sender
     * @param string $message message of the email sender
     */
    public function sendMail(string $name,  string $email, string $message)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //Ask PHPMailer to use SMTP
            $mail->IsSMTP();
            $mail->Host = ContactConstant::HOST;                             //SMTP name
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = ContactConstant::USERNAME;                    // SMTP username
            $mail->Password   = ContactConstant::PASSWORD;                             // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress(ContactConstant::USERNAME);    //add recipient e-mail adress

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
