<?php

use Facebook\WebDriver\WebDriverBy;

class EditMailboxForDealingWithClientPage
{
    private $REMOVE_CLIENTS_BUTTOMS = "/html/body/div[1]/div/ul/li/span/button";
    private $ACCEPT_DELETE_BUTTON = "//*[@id=\"modalConfirmYes\"]";
    private $DELETE_BUTTON = "//*[@id=\"form_submit\"]";
    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function removeAllClients($webDriver)
    {while (true){
        $removeButtons = $webDriver->findElements(WebDriverBy::xpath($this->REMOVE_CLIENTS_BUTTOMS));
        if (count($removeButtons) > 0) {
            $removeButtons[0]->click();
            SimpleWait::waitShow($webDriver, $this->ACCEPT_DELETE_BUTTON);
            $acceptButton = $webDriver->findElement(WebDriverBy::xpath($this->ACCEPT_DELETE_BUTTON));
            SimpleWait::waitingOfClick($webDriver, $acceptButton);
        }else{
            break;
        }
        }

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