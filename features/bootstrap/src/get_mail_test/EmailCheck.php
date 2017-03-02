<?php
require_once "EmailSender.php";
require_once "EmailParser.php";

class EmailCheck
{
    /**
     * @var EmailSender $emailSender
     */
    private static $emailSender;
    private static $email;
    private static $password;
    /**
     * @var EmailParser $emailParser
     */
    private static $emailParser;

    public static function init($email, $password)
    {
        if (is_null(self::$emailSender)) {
            self::$emailSender = new EmailSender($email,$password);
        }
        self::$emailParser = new EmailParser($email,$password);
    }

    public static function clearOldJSON()
    {
        self::$emailSender->deleteOld();
    }

    public static function clearLetterOnEmailBox()
    {
        try {
            self::$emailParser->deleteAllEmails();
        } catch (Error $e) {
        }
    }

    public static function addLetter($emailFrom, $title, $body)
    {
        self::$emailSender->emailAdded(new EmailGhost($emailFrom, $title, $body));
    }

    public static function checkEmailByTitle($title)
    {
        $sendEmail = self::$emailSender->getEmailByTitle($title);
        if(is_null($sendEmail)){
            return false;
        }
        $result = self::$emailParser->check($sendEmail->getFrom(), $sendEmail->getTitle(), $sendEmail->getBody());
        return $result;
    }

    public static function emailIsAlive(){
        self::$emailParser->emailOnMailRuIsAlive();
        return true;
    }
}
