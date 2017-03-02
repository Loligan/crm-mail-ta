<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";
class MailboxNewClientsPage
{
    private $ADD_NEW_MAILBOX_TO_FETCH_NEW_CLINTS_BUTTON = "html/body/div[1]/a";
    private $EMAIL_LABELS_IN_TABLE = "/html/body/div[1]/div[2]/div[2]/div[2]/table/tbody/tr/td[1]/b";
    private $EDIT_BUTTONS = "/html/body/div[1]/div[2]/div[2]/div[2]/table/tbody/tr/td[6]/a[1]";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowAddNewMailboxButton($webDriver){
        SimpleWait::waitShow($webDriver,$this->ADD_NEW_MAILBOX_TO_FETCH_NEW_CLINTS_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnAddNewMailboxButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->ADD_NEW_MAILBOX_TO_FETCH_NEW_CLINTS_BUTTON));
        $button->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function checkLineEnabledByEmailName($webDriver, $email)
    {
        $labels = $webDriver->findElements(WebDriverBy::xpath($this->EMAIL_LABELS_IN_TABLE));
        if(count($labels)>0){
            foreach ($labels as $label){
                if($label->getText()==$email){
                    return true;
                }
            }
        }
        throw new Exception("In table not found line woth Email: ".$email);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $email
     */
    public function clickOnEditButtonByEmailName($webDriver, $email)
    {
        $labels = $webDriver->findElements(WebDriverBy::xpath($this->EMAIL_LABELS_IN_TABLE));
        if(count($labels)>0){
            $numberLine = 0;
            foreach ($labels as $label){
                if($label->getText()==$email){
                    break;
                }else{
                    $numberLine++;
                }
            }
            $editButtons = $webDriver->findElements(WebDriverBy::xpath($this->EDIT_BUTTONS));
            $editButtons[$numberLine]->click();
        }
    }
}