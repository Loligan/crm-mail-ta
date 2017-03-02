<?php

use Facebook\WebDriver\WebDriverBy;
require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";
class MailboxesForDealingWithClientPage
{
    private $ADD_NEW_MAILBOX_FOR_DEALING_WITH_CLIENTS_BUTTON = "/html/body/div[1]/div[2]/h2/a";
    private $EDIT_BUTTONS = "/html/body/div[1]/div[2]/div[1]/div[2]/div/table/tbody/tr/td[9]/div/a[1]/i";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowAddNewMailboxButton($webDriver){
        SimpleWait::waitShow($webDriver,$this->ADD_NEW_MAILBOX_FOR_DEALING_WITH_CLIENTS_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnAddNewMailboxButton($webDriver){
        $button = $webDriver->findElement(WebDriverBy::xpath($this->ADD_NEW_MAILBOX_FOR_DEALING_WITH_CLIENTS_BUTTON));
        $button->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @return int
     */
    public function getCountMailboxes($webDriver)
    {
       $buttons = $webDriver->findElements(WebDriverBy::xpath($this->EDIT_BUTTONS));
       return count($buttons);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnFirstEditButton($webDriver)
    {
        $buttons = $webDriver->findElements(WebDriverBy::xpath($this->EDIT_BUTTONS));
        $buttons[0]->click();
    }
}