<?php

require_once '/home/meldon/PhpstormProjects/crm-mail-ta/vendor/autoload.php';

class RedmineSimpleReport
{
    private $client;
    private $projectId;
    private $isPrivate;
    private $newStatus;
    private $closeStatus;
    private $redmineURL;

    public function __construct($redmineURL, $login, $password)
    {
        $this->client = new \Redmine\Client($redmineURL, $login, $password);
        $this->projectId = $this->client->project->getIdByName("Mail Trade CRM");
        $this->isPrivate = true;
        $this->newStatus = 1;
        $this->closeStatus = 5;
        $this->redmineURL = $redmineURL;
    }


    private function getIssueByName($subject)
    {
        $issue = $this->client->issue->all([
            'project_id' => $this->projectId,
            'subject' => $subject,
            'status_id' => $this->newStatus
        ]);

        if (count($issue['issues']) == 0) {
            $issue = $this->client->issue->all([
                'project_id' => $this->projectId,
                'subject' => $subject,
                'status_id' => $this->closeStatus
            ]);
        }
        return $issue;
    }

    private function isCloseStatusIssue($subject)
    {
        $issue = $this->client->issue->all([
            'project_id' => $this->projectId,
            'subject' => $subject,
            'status_id' => $this->closeStatus
        ]);
        if (count($issue['issues']) == 0) {
            return false;
        } else {
            return true;
        }

    }

    private function isCreateIssue($subject)
    {
        $issue = $this->getIssueByName($subject);
        if (count($issue['issues']) == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function createIssue($subject, $description, $priority_id, $assign_to_id, $images = null)
    {
        if ($this->isCreateIssue($subject)) {
            if (!$this->isCloseStatusIssue($subject)) {
//               ADD LINES IN COMMENT IN CREATING BUG
                $this->addLinesInComment($subject, $description,$images);
                print "ADD COMMENT WITH STEPS IN OPENED ISSUE";

            } else {
//                EDIT CREATING BUG
                $this->editIssue($subject, $description, $priority_id, $assign_to_id);
                print "ADD COMMENT AND EDIT STATUS WITH STEPS IN OPENED ISSUE";
            }
        } else {
//            CREATE NEW BUG
//            $this->getAttachJSON($images);
            $this->client->issue->create([
                'subject' => $subject,
                'description' => $description,
                'project_id' => $this->projectId,
                'is_private' => $this->isPrivate,
                'priority_id' => $priority_id,
                'assigned_to_id' => $assign_to_id,

            ]);
            print "CREATE NEW ISSUE";
        }
    }

    public function getAllComments($name){
        print_r($this->getIssueByName($name));
    }

    private function editIssue($subject, $description, $priority_id, $assign_to_id, $images = null)
    {
        $id = $this->getIdIssue($subject);

        $this->client->issue->addNoteToIssue($id, $description);

        $this->client->issue->update($id, [
            'priority_id' => $priority_id,
            'assigned_to_id' => $assign_to_id,
            'status_id' => $this->newStatus,
            'uploads' => $this->getAttachJSON($images)
        ]);
    }

    private function getIdIssue($subject)
    {
        $issues = $this->client->issue->all([
            'subject' => $subject,
            'project_id' => $this->projectId,
            'status_id' => $this->newStatus
        ]);

        if (count($issues['issues']) == 0) {
            $issues = $this->client->issue->all([
                'subject' => $subject,
                'project_id' => $this->projectId,
                'status_id' => $this->closeStatus
            ]);
        }
        return $issues['issues'][0]['id'];
    }

    private function addLinesInComment($subject, $description,$images)
    {
        $id = $this->getIdIssue($subject);
        $image_txt = "";
        if(!is_null($images)){
            foreach ($images as $image){
                $image_txt.='
                 !'.$this->getUrlImageUpload($image).'!
                 ';
            }
        }
        $this->client->issue->addNoteToIssue($id, $description.'
        '.$image_txt);
    }
}

