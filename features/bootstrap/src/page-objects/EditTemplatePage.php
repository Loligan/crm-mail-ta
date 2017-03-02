<?php
use Facebook\WebDriver\WebDriverBy;

require_once "CreateTemplatePage.php";
require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";
class EditTemplatePage extends CreateTemplatePage
{
    private $DELETE_BUTTON = "//*[@id=\"form_submit\"]";

    /**
    * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnDeleteButton($webDriver){
        SimpleWait::waitShow($webDriver,$this->DELETE_BUTTON);
        $button = $webDriver->findElement(WebDriverBy::xpath($this->DELETE_BUTTON));
        $button->click();
    }
}