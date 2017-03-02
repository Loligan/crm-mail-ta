<?php

use Facebook\WebDriver\WebDriverBy;

class CreateTemplatePage
{
    private $NAME_INPUT = ".//*[@id='mailtrade_sitebundle_template_name']";
    private $SUBJECTS_SEPARATED_INPUT = ".//*[@id='mailtrade_sitebundle_template_subjects']";
    private $BODY_TEXT_INPUT = "html/body";
    private $BODY_GET_SOURCE_BUTTON = "#cke_21";
    private $BODY_SOURCE_INPUT = ".//*[@id='cke_1_contents']/textarea";
    private $AUTO_CATEGOIES_LINE = ".//*[@id='mailtrade_sitebundle_template_templateCategories']/option[1]";
    private $CREATE_BUTTON = ".//*[@id='mailtrade_sitebundle_template_submit']";
    private $HOTKEY_INPUT = "//*[@id=\"mailtrade_sitebundle_template_hotkey\"]";

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkNameInputShop($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->NAME_INPUT);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkSubjectSeparatedInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SUBJECTS_SEPARATED_INPUT);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkBodyTextInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->BODY_TEXT_INPUT);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkGetSourceButton($webDriver)
    {
        SimpleWait::waitShowByCSSSelector($webDriver, $this->BODY_GET_SOURCE_BUTTON);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkAutoCategoriesLine($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->AUTO_CATEGOIES_LINE);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkCreateButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->CREATE_BUTTON);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnGetSourceButtom($webDriver)
    {
        SimpleWait::waitShowByCSSSelector($webDriver, $this->BODY_GET_SOURCE_BUTTON);
        $button = $webDriver->findElement(WebDriverBy::cssSelector($this->BODY_GET_SOURCE_BUTTON));
        while (count($webDriver->findElements(WebDriverBy::xpath($this->BODY_SOURCE_INPUT))) == 0) {
            sleep(0.5);
            SimpleWait::waitingOfClick($webDriver, $button);
        }
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkSourceBodyInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->BODY_SOURCE_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $text
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInNameInput($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->NAME_INPUT));
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $text
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInSubjectSeparated($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->SUBJECTS_SEPARATED_INPUT));
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param mixed $text
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInBodyMail($webDriver, $text)
    {
        SimpleWait::waitShow($webDriver, $this->BODY_SOURCE_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->BODY_SOURCE_INPUT));
        $input->sendKeys($text);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnCreateButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->CREATE_BUTTON));
        $button->click();
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setAutoCategoriesLine($webDriver)
    {
        $line = $webDriver->findElement(WebDriverBy::xpath($this->AUTO_CATEGOIES_LINE));
        $line->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInHotkeyInput($webDriver, $value)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->HOTKEY_INPUT));
        $input->sendKeys($value);
    }
}