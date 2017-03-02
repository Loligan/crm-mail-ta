<?php

require_once '/home/meldon/PhpstormProjects/crm-mail-ta/vendor/autoload.php';
require_once '../RedmineListener/RedmineListener.php';
require_once '../RunnableTests/RunnableTest.php';

class RedmineListener
{
    private $client;
    private $projectId;
    private $isPrivate;
    private $newStatus;
    private $closeStatus;
    private $redmineURL;
    private $login;
    private $password;

    function __construct($redmineURL, $login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->isPrivate = true;
        $this->newStatus = 1;
        $this->closeStatus = 5;
        $this->redmineURL = $redmineURL;
    }

    private function getAllCloseReportWithAssignedRobot(&$ids,&$titles)
    {
        $issues = $this->client->issue->all([
            'project_id' => $this->projectId,
            'assigned_to_id' => 5
        ]);
        if (!empty($issues["issues"])) {
             self::getAllTitles($issues["issues"],$ids,$titles);
             return true;
        } else {
            return false;
        }
    }

    private static function getAllTitles($issues, &$ids, &$titles)
    {
        $ids = array();
        $titles = array();
        count($issues);
        $titles = array();
        for ($i = 0; $i < count($issues); $i++) {
            array_push($titles, $issues[0]["subject"]);
            array_push($ids, $issues[0]["id"]);
        }
    }

    private static function getTitlesAndTags(array $titlesWithTags,&$titles,&$tags){
        $titles = array();
        $tags = array();
        $countTitlesWithTags = count($titlesWithTags);
        for($i=0;$i<$countTitlesWithTags;$i++){
            $titleWithTags = $titlesWithTags[$i];
           preg_match_all("/([[])(.*)([]])(.*)/",$titleWithTags,$result);
            $tag = $result[2][0];
            preg_match_all("/([[].*[]])(.*)/",$titleWithTags,$result);
            $title = trim($result[2][0]);
            array_push($titles,$title);
            array_push($tags,$tag);
        }
    }

    public function run($sleepMinutes)
    {
        $sleepMinutes*=60;
        while (true) {
            try{
                $this->client = new \Redmine\Client($this->redmineURL, $this->login, $this->password);
                $this->projectId = $this->client->project->getIdByName("Mail Trade CRM");
            $result = $this->getAllCloseReportWithAssignedRobot($ids,$titles);
            var_dump($result);
            if ($result == false) {
                sleep($sleepMinutes);
            } else {
               self::getTitlesAndTags($titles,$titlesWithoutTag,$tags);
//                var_dump($ids);
//                var_dump($tags);
//                TODO запустить тест по тегу, если прошел то закрыть и оставить без Assigned to
               if(RunnableTest::runByTag($tags[0])){
                    $this->client->issue->update($ids[0],[
                        "assigned_to_id" => 1,
                        "status_id" => 5
                    ]);
               }else{
                   $this->client->issue->update($ids[0],[
                       "assigned_to_id" => 1,
                       "status_id" => 2
                   ]);
               }
            }
        }catch (Exception $e){};
        }
    }
}

