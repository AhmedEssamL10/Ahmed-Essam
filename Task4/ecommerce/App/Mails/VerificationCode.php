<?php

namespace App\Mails;


use App\Mails\Contract\Mail;
use PHPMailer\PHPMailer\Exception;

class VerificationCode extends Mail
{
    public const MAIL_FROM_NAME = "Ecommerce";
    public function send(string $mailTo, string $subject, string $body): bool
    {
        try {
            //Recipients
            $this->mail->setFrom(self::MAIL_FROM, self::MAIL_FROM_NAME);
            $this->mail->addAddress($mailTo);     //Add a recipient
            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML (contant of mail)
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
