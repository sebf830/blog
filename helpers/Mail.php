<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Mail{

    
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = MAILHOST;
        $this->mail->SMTPAuth = "true";
        $this->mail->SMTPSecure = MAILENCRYPT;
        $this->mail->Port = MAILPORT;
        $this->mail->Username = MAILUSER;
        $this->mail->Password = MAILPSWD;
        $this->mail->iSHtml(true);
        $this->mail->setFrom(MAILUSER);
    }

    public function sendTo($email)
    {
        $this->mail->addAddress($email);
    }

    public function subject($subject)
    {
        $this->mail->Subject = $subject;
    }

    public function message($msg)
    {
        $this->mail->Body = $msg;
    }

    public function send()
    {
        if (!$this->mail->Send()) {
            return false;
        }
        $this->mail->smtpClose();
        return true;
    }
}