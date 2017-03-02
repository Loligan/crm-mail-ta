<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";

class AddNewMailboxNewClientsPage
{
    private $EMAIL_IMPUT = "//*[@id=\"mailtrade_sitebundle_agent_email\"]";
    private $IMAP_HOST_INPUT = "//*[@id=\"mailtrade_sitebundle_agent_host\"]";
    private $IMAP_PORT_INPUT = "//*[@id=\"mailtrade_sitebundle_agent_port\"]";
    private $PASSWORD_INPUT = "//*[@id=\"mailtrade_sitebundle_agent_password\"]";
    private $SOCKS5_PROXIES_INPUT = "//*[@id=\"mailtrade_sitebundle_agent_proxiesString\"]";
    private $CREATE_BUTTON = "//*[@id=\"mailtrade_sitebundle_agent_submit\"]";
    private $PROXY_ALIVE_MESSAGE = ".alert-success";
    private $LABEL_PROXY_HELP = "//*[@id=\"mailtrade_sitebundle_agent\"]/div[7]/div/div";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowEmailInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->EMAIL_IMPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowImapHostInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->IMAP_HOST_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowImapPortInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->IMAP_PORT_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowPasswordInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->PASSWORD_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowProxyInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SOCKS5_PROXIES_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkCreateButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->CREATE_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowAllProxyAreAlive($webDriver)
    {
        SimpleWait::waitShowByCSSSelector($webDriver, $this->PROXY_ALIVE_MESSAGE);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInEmailInput($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->EMAIL_IMPUT));
        $input->clear();
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInImapHostInput($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->IMAP_HOST_INPUT));
        $input->clear();
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInImapPortInput($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->IMAP_PORT_INPUT));
        $input->clear();
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInPasswordInput($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->PASSWORD_INPUT));
        $input->clear();
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function setTextInProxyInput($webDriver, $text)
    {
        $input = $webDriver->findElement(WebDriverBy::xpath($this->SOCKS5_PROXIES_INPUT));
        $input->clear();
        $input->sendKeys($text);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnCreateButton($webDriver)
    {
        $webDriver->executeScript("scroll(0, 9999);");
        $button = $webDriver->findElement(WebDriverBy::xpath($this->CREATE_BUTTON));
        SimpleWait::waitingOfClick($webDriver,$button);
    }
    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnSpace($webDriver){
        $space = $webDriver->findElement(WebDriverBy::xpath($this->LABEL_PROXY_HELP));
        $mouse = $webDriver->getMouse();
        $mouse->click($space->getCoordinates());
    }
}