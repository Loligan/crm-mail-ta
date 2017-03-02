<?php
require_once "EmailGhost.php";

class EmailSender
{
    private $emails;
    private $filename = "letters-buf.json";

    private function getDataFile()
    {
        if (file_exists($this->filename) == false) {
            return null;
        }
        $data = file_get_contents($this->filename);
        $data = json_decode($data, true);
        return $data;
    }

    private function saveDataToFile($data)
    {
        if (file_exists($this->filename) == true) {
            unlink($this->filename);
        }
        $json = json_encode($data);
        file_put_contents($this->filename, $json);
    }


    /**
     * @param EmailGhost $email
     */
    public function emailAdded($email)
    {
        $arrays = $this->getDataFile();
        if (is_null($arrays)) {
            $arrays = array();
        }
        array_push($arrays, [
            "email-from" => $email->getFrom(),
            "title" => $email->getTitle(),
            "body" => $email->getBody()
        ]);
        $this->saveDataToFile($arrays);
    }

    public function getEmailByTitle($title){
        $arrays = $this->getDataFile();
        if (is_null($arrays)) {
         return null;
        }
        foreach ($arrays as $letter){
            if($letter["title"]==$title){
                return new EmailGhost($letter["email-from"],$letter["title"],$letter["body"]);
            }
        }
    }

    public function deleteOld()
    {
        if (file_exists($this->filename) == true) {
            unlink($this->filename);
        }
    }

}
