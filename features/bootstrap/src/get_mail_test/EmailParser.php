<?php

require_once "EmailGhost.php";

class EmailParser
{
    private $mbox;
    private $MC;
    private $emails;
    private $email;
    private $password;

    /**
     * EmailParser constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

        $this->emails = array();
        $this->before();
        $this->getAllEmails();
        $this->after();
    }


    private function before()
    {
//        try {
        $this->mbox = imap_open("{imap.mail.ru:993/imap/ssl}INBOX", $this->email, $this->password)
        or die("can't connect: " . imap_last_error());
        $this->MC = imap_check($this->mbox);
//        } catch (Exception $e) {
//            print_r($e);
//        }
    }

    private function after()
    {
        try {
            if ($this->MC->Nmsgs == 0) {
                imap_close($this->mbox);
            }
        } catch (Exception $e) {
        }
    }

    public function emailOnMailRuIsAlive()
    {
        try {
            $this->before();
            $this->after();
        } catch (Exception $e) {
            throw new Exception("Email is not alive: " . $e);
        }
    }

    private function getAllEmails()
    {
        try {
            $result = imap_fetch_overview($this->mbox, "1:{$this->MC->Nmsgs}", 0);
            foreach ($result as $overview) {
                $from = $overview->from;
                $title = $overview->subject;
                $body = imap_body($this->mbox, $overview->msgno, 0);
                array(array_push($this->emails, new EmailGhost($from, $title, $body)));
            }
        } catch (Exception $e) {

        }
    }

    public function deleteAllEmails()
    {
        try {
            $this->before();
            $result = imap_fetch_overview($this->mbox, "1:{$this->MC->Nmsgs}", 0);
            foreach ($result as $overview) {
                imap_delete($this->mbox, $overview->msgno);
            }
            $this->after();
        } catch (Exception $e) {
        }
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param string $theme
     * @return EmailGhost|null
     */
    private function getEmailByTheme
    ($theme)
    {
//        var_dump($this->email-body);
        foreach ($this->emails as $email) {
            if ($email->getTitle() == $theme) {
                return $email;
            }
        }
        return null;
    }

    private function getBodyFromMailRu($body)
    {
        try {
            $body = imap_qprint($body);
            preg_match("/(html; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable)(.*)--/sU", $body, $res);
            $newBody = str_replace("\r\n","",$res[2]);
//            var_dump($res);
//            var_dump($newBody);
//            $body = str_replace("=\r\n", "", $res[0]);
//            preg_match("/(\r\n)(.*)(\r\n--)/", $body, $res2);
//
//            preg_match("/(\n\n)(.*)(\n--)/", $body, $res3);
//            $result = $res2[2];
//            var_dump(str_replace("\n","",$res2[2]));
//            var_dump(str_replace("\r\n","",$res2[2]));
        }catch (Exception $e){
            throw new Exception("Not be found body in: \n".$body);
        }
        return $newBody;
    }

    public function check($emailTo, $title, $body)
    {
        $email = $this->getEmailByTheme($title);
        if (!is_null($email)) {
            if ($email->getTitle() != $title) {
                print "TITLE NOT EQUALS";
                return false;
            }
            $emailBody = $this->getBodyFromMailRu($email->getBody());
            if (strcmp($body, $emailBody) != 0) {
                print "BODY NOT EQUALS\nBODY TEST:\n" . $body . "\n\nBODY EMAIL:\n" . $emailBody;
                return false;
            }
            return true;
        }
        return false;
    }
}
