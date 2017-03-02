<?php

use Facebook\WebDriver\WebDriverBy;

class EditMailboxNewClientsPage extends MailboxNewClientsPage
{
    private $DELETE_BUTTON = "//*[@id=\"form_submit\"]";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowDeleteButton($webDriver)
    {
        SimpleWait::waitShow($webDriver,$this->DELETE_BUTTON);
    }
    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnDeleteButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->DELETE_BUTTON));
        $button->click();
    }
}