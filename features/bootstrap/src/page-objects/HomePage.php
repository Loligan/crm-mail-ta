<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";

class HomePage
{
    private $USERNAME_INPUT = ".//*[@id='username']";
    private $PASSWORD_INPUT = ".//*[@id='password']";
    private $LOGIN_BUTTON = ".//*[@id='_submit']";

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowUsernameInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->USERNAME_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $text
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function sendKeyInUsernameInput($webDriver, $text)
    {
        $usernameInput = $webDriver->findElement(WebDriverBy::xpath($this->USERNAME_INPUT));
        $usernameInput->sendKeys($text);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowPasswordInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->PASSWORD_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $text
     * @internal param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function sendKeyInPasswordInput($webDriver, $text)
    {
        $passwordInput = $webDriver->findElement(WebDriverBy::xpath($this->PASSWORD_INPUT));
        $passwordInput->sendKeys($text);
    }

    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowLoginButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->LOGIN_BUTTON);
    }
    /**
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnLoginButton($webDriver)
    {
        $loginButton = $webDriver->findElement(WebDriverBy::xpath($this->LOGIN_BUTTON));
        $loginButton->click();
    }
}