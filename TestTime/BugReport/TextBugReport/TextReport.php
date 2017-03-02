<?php

require_once "/home/meldon/PhpstormProjects/All4bom_TA/features/bootstrap/src/BugReport/LastPhraseReport/LastPhrase.php";

class TextReport
{
    private $title;
    private $description;
    private $fullSteps;
    private $passStepsLines;
    private $failStepLine;
    private $isGiven;
    private $lastURL;
    private $lastConsoleLog;
    private $idTest;
    private $additionallyLine;

    /**
     * @param mixed $idTest
     */
    public function setIdTest($idTest)
    {
        $this->idTest = $idTest;
    }

    public function __construct()
    {
        $this->passStepsLines = array();
        $this->isGiven = false;
        $this->lastURL = "";
        $this->lastConsoleLog = "";
    }

    /**
     * @param mixed $additionallyLine
     */
    public function setAdditionallyLine($additionallyLine)
    {
        $this->additionallyLine = $additionallyLine;
    }

    public function afterStep($AfterStepScope, $webDriver)
    {
        $textStep = $AfterStepScope->getStep()->getText();

        if ($AfterStepScope->getTestResult()->isPassed()) {
            $this->addPassStepLine($textStep);
        } else {
//            if($AfterStepScope->getStep()->getKeywordType() == "Given"){
//                $this->isGiven = true;
//            }
            $this->setFailStepLine($textStep);

            $this->lastURL = $webDriver->getCurrentURL();
            $this->lastConsoleLog = var_export($webDriver->manage()->getLog("browser"), true);
        }
    }

    private function addPassStepLine($text)
    {
        array_push($this->passStepsLines, $text);
    }

    public function beforeScenario($BeforeScenarioScope)
    {
        if (!$this->isGiven) {
            $this->setTitle($BeforeScenarioScope);
        }
    }


    /**
     * @param mixed $title
     */
    private function setTitle($BeforeScenarioScope)
    {
        $titleLime = $BeforeScenarioScope->getScenario()->getSteps()[0]->getLine() - 1;
        $filePath = $BeforeScenarioScope->getFeature()->getFile();
        $file = fopen($filePath, "r");
        for ($i = 1; $i < $titleLime; $i++) {
            fgets($file);
        }
        $title = fgets($file);
        $title = trim(substr($title, strpos($title, ":") + 1));
        fclose($file);

        $this->title = $title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $failStepLine
     */
    private function setFailStepLine($failStepLine)
    {
        $this->failStepLine = $failStepLine;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $fullSteps
     */
    public function setFullSteps($fullSteps)
    {
        $this->fullSteps = $fullSteps;
    }

    /**
     * @return bool
     */
    public function isGiven()
    {
        return $this->isGiven;
    }


    public function afterScenario()
    {
//        IF FAIL IN GIVEN STEPS
        if ($this->isGiven) {
            $this->title = $this->failStepLine;
        }

        $this->description = $this->title .
            "\n\n*Шаги сценария:*\n" . $this->fullSteps . "\n" .
            "\n\n*Пройденнные шаги:*\n";

        foreach ($this->passStepsLines as $step) {
            $this->description = $this->description . "\n # " . $step;
        }

        $this->description = $this->description .
            "\n\n*Шаг на котором возникла ошибка:*\n" .
            $this->failStepLine .
            "\n*Последняя фраза:*\n" .
            LastPhrase::getPhrase() .
            "\n*Последний URL:*\n" . $this->lastURL .
            "\n*Лог с консоли:*\n" . $this->lastConsoleLog.
        "\n*Примечания*\nИмя gif:\n".$this->additionallyLine."".
        "\n";
        $this->title = "[".$this->idTest."] ". $this->title;
    }


}