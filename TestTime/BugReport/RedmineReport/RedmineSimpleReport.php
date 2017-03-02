<?php

require_once '/home/meldon/PhpstormProjects/All4bom_TA/vendor/autoload.php';

class RedmineSimpleReport
{
    private $client;
    private $projectId;
    private $isPrivate;
    private $newStatus;
    private $closeStatus;
    private $projectName;

    public function __construct($redmineURL, $login, $password,$projectName)
    {
        $this->projectName = $projectName;
        $this->client = new \Redmine\Client($redmineURL, $login, $password);
        $this->projectId = $this->client->project->getIdByName($this->projectName);
        $this->isPrivate = true;
        $this->newStatus = 1;
        $this->closeStatus = 5;
        $this->inProgressStatus = 2;
    }


    private function getIssueByName($subject)
    {
        $issue = $this->client->issue->all([
            'project_id' => $this->projectId,
            'subject' => $subject,
            'status_id' => $this->newStatus
        ]);

        if (count($issue['issues']) == 0){
            $issue = $this->client->issue->all([
                'project_id' => $this->projectId,
                'subject' => $subject,
                'status_id' => $this->closeStatus
            ]);

            if (count($issue['issues']) == 0){
                $issue = $this->client->issue->all([
                    'project_id' => $this->projectId,
                    'subject' => $subject,
                    'status_id' => $this->inProgressStatus
                ]);
            }
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

    public function createIssue($subject, $description, $priority_id, $assign_to_id)
    {
        if ($this->isCreateIssue($subject)) {
            if (!$this->isCloseStatusIssue($subject)) {
//               ADD LINES IN COMMENT IN CREATING BUG
                $this->addLinesInComment($subject,$description);
//                print "ADD COMMENT WITH STEPS IN OPENED ISSUE";

            } else {
//                EDIT CREATING BUG
                $this->editIssue($subject, $description, $priority_id, $assign_to_id);
//                print "ADD COMMENT AND EDIT STATUS WITH STEPS IN CLOSED ISSUE";
            }
        } else {
//            CREATE NEW BUG
            $this->client->issue->create([
                'subject' => $subject,
                'description' => $description,
                'project_id' => $this->projectId,
                'is_private' => $this->isPrivate,
                'priority_id' => $priority_id,
                'assigned_to_id' => $assign_to_id
            ]);
//            print "CREATE NEW ISSUE";
        }
    }

    private function editIssue($subject, $description, $priority_id, $assign_to_id)
    {
        $id = $this->getIdIssue($subject);

        $this->client->issue->addNoteToIssue($id,$description);

        $this->client->issue->update($id, [
            'priority_id' => $priority_id,
            'assigned_to_id' => $assign_to_id,
            'status_id' => $this->newStatus
        ]);
    }

    private function getIdIssue($subject)
    {
        $issues = $this->client->issue->all([
            'subject' => $subject,
            'project_id' => $this->projectId,
            'status_id' => $this->newStatus
        ]);

        if (count($issues['issues']) == 0){
            $issues = $this->client->issue->all([
                'subject' => $subject,
                'project_id' => $this->projectId,
                'status_id' => $this->closeStatus
            ]);
        }
        return $issues['issues'][0]['id'];
    }

    private function addLinesInComment($subject, $description)
    {
        $id = $this->getIdIssue($subject);
        $this->client->issue->addNoteToIssue($id,$description);
    }
}