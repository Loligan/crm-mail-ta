<?php

require_once "TextBugReport/TextReport.php";
require_once "RedmineReport/RedmineSimpleReport.php";
require_once "GifRecord/GifRecord.php";

class Report
{

    private $isPrivate;
    private $status;
    private $priority;
    private $assignedUserId;
    private $passStepsLines;
    private $trigerFailStep;

    private $textReport;
    private $gifRecord;


    private $urlRedmine;
    private $userRedmine;
    private $passwordRedmine;
    private $nameProject;
    private $isRerun;

    /**
     * TextReport constructor.
     * @param $projectId
     * @param $title
     * @param $description
     * @param $isPrivate
     * @param $status
     * @param $priority
     * @param $attachment
     * @param $assignedUserId
     */
    public function __construct($isPrivate, $status, $priority, $assignedUserId, $urlRedmine, $userRedmine, $passwordRedmine, $nameProject)
    {
        $this->isPrivate = $isPrivate;
        $this->status = $status;
        $this->priority = $priority;
        $this->assignedUserId = $assignedUserId;

        $this->passStepsLines = array();
        $this->trigerFailStep = false;
        $this->textReport = new TextReport();

        $this->urlRedmine = $urlRedmine;
        $this->userRedmine = $userRedmine;
        $this->passwordRedmine = $passwordRedmine;
        $this->nameProject = $nameProject;
        $this->isRerun = $this->isRerun();
    }


    private function isRerun()
    {
        if (file_exists("scenario.rerun")) {
            return true;
        } else {
            return false;
        }
    }

    private function setAllStepsInTextReport($afterScenarioScope)
    {
        $fullSteps = "";
        foreach ($afterScenarioScope->getScenario()->getSteps() as $step) {
            $fullSteps = $fullSteps . "# " . $step->getText() . "\n";

        }
        $this->textReport->setFullSteps($fullSteps);
    }

    /**
     * @param Behat\Behat\Hook\Scope\AfterScenarioScope $afterScenarioScope
     */
    private function getTestID($afterScenarioScope)
    {
        $tags = $afterScenarioScope->getScenario()->getTags();
        foreach ($tags as $tag) {
            if (stristr($tag, "ID=")) {
                preg_match("/(?:ID=)(.*)/", $tag, $result);
                return $result[1];
            }
        }
    }

    private function getPriorityID($afterScenarioScope)
    {
        $tags = $afterScenarioScope->getScenario()->getTags();
        foreach ($tags as $tag) {
            if (stristr($tag, "PRIORITY=")) {
                preg_match("/(?:PRIORITY=)(.*)/", $tag, $result);
                return $result[1];
            }
        }
    }

    private function getAssignedID($afterScenarioScope)
    {
        $tags = $afterScenarioScope->getScenario()->getTags();
        foreach ($tags as $tag) {
            if (stristr($tag, "ASSIGNED=")) {
                preg_match("/(?:ASSIGNED=)(.*)/", $tag, $result);
                return $result[1];
            }
        }
    }

    public function afterScenario($afterScenarioScope)
    {

        $this->setAllStepsInTextReport($afterScenarioScope);


        if ($this->isRerun) {
            $this->gifRecord->stop();
            $this->textReport->setIdTest($this->getTestID($afterScenarioScope));
            $priority = $this->getPriorityID($afterScenarioScope);
            $assigned = $this->getAssignedID($afterScenarioScope);
            $this->textReport->afterScenario();
            $report = new RedmineSimpleReport($this->urlRedmine, $this->userRedmine, $this->passwordRedmine, $this->nameProject);

            $report->createIssue($this->textReport->getTitle(), $this->textReport->getDescription(), $priority, $assigned);
        }
    }

    public function afterStep($afterStepScope, $webDriver)
    {
        if ($this->isRerun) {
            $this->textReport->afterStep($afterStepScope, $webDriver);
        }
    }

    public function beforeScenario($beforeScenarioScope)
    {
        if ($this->isRerun) {
            $this->gifRecord = new GifRecord();
            $this->textReport->setAdditionallyLine($this->gifRecord->run());
            $this->textReport->beforeScenario($beforeScenarioScope);
        }
    }


}