<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";

class CreateMailboxesForDealingWithClientPage
{
    private $SENDER_NAME_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_name\"]";
    private $EMAIL_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_email\"]";
    private $MAX_CLIENT_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_clientLimit\"]";
    private $TIMEOUT_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_sendingDelay\"]";
    private $PASSWORD_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_password\"]";
    private $SOCK5_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_proxiesString\"]";
    private $SMTP_HOST_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_smtpHost\"]";
    private $SMTP_PORT_INPUT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_smtpPort\"]";
    private $CREATE_BUTTON = "//*[@id=\"mailtrade_sitebundle_user_mail_account_submit\"]";
    private $PRESET_SELECT = "//*[@id=\"mailtrade_sitebundle_user_mail_account_preset\"]";
    private $PRESETS_OPTIONS = "//*[@id=\"mailtrade_sitebundle_user_mail_account_preset\"]/option";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowSenderNameInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SENDER_NAME_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowEmailInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->EMAIL_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowMaxClientInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->MAX_CLIENT_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowTimeoutInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->TIMEOUT_INPUT);
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
    public function checkShowSock5Input($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SOCK5_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowSmtpHostInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SMTP_HOST_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowSmtpPortInput($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SMTP_PORT_INPUT);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkShowCreateButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->CREATE_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInSenderNameInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->SENDER_NAME_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->SENDER_NAME_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInEmailInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->EMAIL_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->EMAIL_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInTimeoutInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->TIMEOUT_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->TIMEOUT_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInPasswordInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->PASSWORD_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->PASSWORD_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInMaxClientInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->MAX_CLIENT_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->MAX_CLIENT_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInSock5Input($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->SOCK5_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->SOCK5_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInSmtpHostInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->SMTP_HOST_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->SMTP_HOST_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $value
     */
    public function setTextInSmtpPortInput($webDriver, $value)
    {
        SimpleWait::waitShow($webDriver, $this->SMTP_PORT_INPUT);
        $input = $webDriver->findElement(WebDriverBy::xpath($this->SMTP_PORT_INPUT));
        $input->clear();
        $input->sendKeys($value);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnCreateButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->CREATE_BUTTON));
        $button->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public function checkPresetByName($webDriver, $name)
    {
        $options = $webDriver->findElements(WebDriverBy::xpath($this->PRESETS_OPTIONS));
        foreach ($options as $option){
            if($option->getText()==$name){
                return true;
            }
        }
        throw new Exception("Preset with name '".$name."' not found");
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public function clickOnPresetByName($webDriver, $name)
    {
        $options = $webDriver->findElements(WebDriverBy::xpath($this->PRESETS_OPTIONS));
        foreach ($options as $option){
            if($option->getText()==$name){
                $option->click();
                return true;
            }
        }
        throw new Exception("Preset with name '".$name."' not found");
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnSelectPreset($webDriver){
     $select = $webDriver->findElement(WebDriverBy::xpath($this->PRESET_SELECT));
     SimpleWait::waitingOfClick($webDriver,$select);
    }

}