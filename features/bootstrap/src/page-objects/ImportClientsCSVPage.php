<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";

class ImportClientsCSVPage
{
    private $FILE_INPUT = "//*[@id=\"form_file\"]";
    private $IMPORT_CLIENTS_BUTTON = "//*[@id=\"form_submit\"]";
    private $ALERT_SUCCESS_MESSAGE = ".alert-success";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowFileInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->FILE_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowImportClientsButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->IMPORT_CLIENTS_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function selectOneClientInFileInput($webDriver)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->FILE_INPUT));
        $input->sendKeys("/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/page-objects/files/1client.csv");
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnImportClientsButton($webDriver){
        $button = $webDriver->findElement(WebDriverBy::xpath($this->IMPORT_CLIENTS_BUTTON));
        $button->click();
    }


    public function checkShowSuccessImportMessage($webDriver)
    {
        SimpleWait::waitShowByCSSSelector($webDriver,$this->ALERT_SUCCESS_MESSAGE);
    }
}