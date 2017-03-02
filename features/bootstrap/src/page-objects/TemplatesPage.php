<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";

class TemplatesPage
{

    private $NEW_TEMPLATE_BUTTON = "html/body/div[1]/div[2]/div[2]/div[3]/div/a";
    private $SUBJECT_LINES_TEXT = "html/body/div[1]/div[2]/div[2]/div[1]/div[2]/div[2]/table/tbody/tr/td[2]";
    private $NAME_LINES_TEXT = "html/body/div[1]/div[2]/div[2]/div[1]/div[2]/div[2]/table/tbody/tr/td[1]";
    private $EDIT_BUTTONS = "html/body/div[1]/div[2]/div[2]/div[1]/div[2]/div[2]/table/tbody/tr/td[5]/a[1]";

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkNewTemplateButtonShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->NEW_TEMPLATE_BUTTON);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnNewTemplatesButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->NEW_TEMPLATE_BUTTON));
        SimpleWait::waitingOfClick($webDriver, $button);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $text
     * @return bool
     * @throws Exception
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkTemplateBySubjectName($webDriver, $text)
    {
        $textSubjects = $webDriver->findElements(WebDriverBy::xpath($this->SUBJECT_LINES_TEXT));
        if (!is_null($textSubjects)) {
            foreach ($textSubjects as $textSubject) {
                if ($textSubject->getText() == $text) {
                    return true;
                }
            }
        }
        throw new Exception("In table not found template with subject name: " . $text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $text
     * @return bool
     * @throws Exception
     */
    public function checkTemplateByName($webDriver, $text)
    {
        $textSubjects = $webDriver->findElements(WebDriverBy::xpath($this->NAME_LINES_TEXT));
        if (!is_null($textSubjects)) {
            foreach ($textSubjects as $textSubject) {
                if ($textSubject->getText() == $text) {
                    return true;
                }
            }
        }
        throw new Exception("In table not found template with name: " . $text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $nameLine
     * @throws Exception
     */
    public function clickOnEditButtonBySubjectName($webDriver, $nameLine)
    {
        $names = $webDriver->findElements(WebDriverBy::xpath($this->SUBJECT_LINES_TEXT));
        if (count($names) != 0) {
            $numberLine = 0;
            foreach ($names as $name) {
                if ($name->getText() == $nameLine) {
                    break;
                } else {
                    $numberLine++;
                }
            }
            $buttons = $webDriver->findElements(WebDriverBy::xpath($this->EDIT_BUTTONS));
            $buttons[$numberLine]->click();
        } else {
            throw new Exception("On page not lines with templates");
        }
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param $nameLine
     * @throws Exception
     */
    public function checkedThatNoElementByName($webDriver, $nameLine)
    {
        $names = $webDriver->findElements(WebDriverBy::xpath($this->NAME_LINES_TEXT));
        if(count($names)!=0){
            foreach ($names as $name){
                if($name->getText()==$nameLine){
                    throw new Exception("The table is an entry with the name: ".$nameLine);
                }
            }
        }
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @return mixed
     */
    public function getColumnTemplates($webDriver)
    {
        $templates = $webDriver->findElements(WebDriverBy::xpath($this->NAME_LINES_TEXT));
        return count($templates);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnFirstEditButton($webDriver)
    {
        $editButtons = $webDriver->findElements(WebDriverBy::xpath($this->EDIT_BUTTONS));
        $editButtons[0]->click();
    }

}