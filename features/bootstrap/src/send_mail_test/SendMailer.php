<?php
require "/home/meldon/PhpstormProjects/crm-mail-ta/vendor/autoload.php";

class SendMailer
{
    private $mail;
    private $email;

    public function __construct()
    {
        $this->mail = new PHPMailer();
    }

    public function createMailRuSmtpSslConnect($username,$password){
        $this->email = $username;
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mail.ru';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = '465';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Username = $username;
        $this->mail->Password= $password;
    }

    public function createEmail($sendTo,$subject,$body){
        $this->mail->setFrom($this->email);
        $this->mail->addAddress($sendTo);
        $this->mail->isHTML();
        $this->mail->Subject = ($subject);
        $this->mail->Body= ($body);
    }
    public function createEmailFromFile($sendTo,$subject,$nameFile){
        $this->mail->setFrom($this->email);
        $this->mail->addAddress($sendTo);
        $this->mail->isHTML();
        $this->mail->Subject = ($subject);
        $body = file_get_contents("/home/meldon/PhpstormProjects/crm-mail-ta/email-body-send/".$nameFile);
        $this->mail->Body= ($body);
    }
    public function send(){
        if(!$this->mail->send()) {
            echo 'Message could not be sent.';
            throw new Exception("Mailer Error: " . $this->mail->ErrorInfo);
        } else {
            echo 'Message has been sent';
        }
    }

}