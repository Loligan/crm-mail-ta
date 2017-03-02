<?php
use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/simple-wait/SimpleWait.php";

class FolderPage
{
    private $TEMPLATE_TAB = ".//*[@id='bs-example-navbar-collapse-3']/ul/li[1]/a";
    private $SETTING_TAB = ".//*[@id='bs-example-navbar-collapse-3']/ul/li[3]/a";
    private $IMPORT_CLIENT_CSV_SETTING_TAB = "//*[@id=\"bs-example-navbar-collapse-3\"]/ul/li[3]/ul/li[6]/a";
    private $IMPORT_CLIENT_EML_SETTING_TAB = ".//*[@id='bs-example-navbar-collapse-3']/ul/li[3]/ul/li[7]/a";
    private $MAILBOXES_TO_FETCH_NEW_CLIENT_SETTING_TAB = ".//*[@id='bs-example-navbar-collapse-3']/ul/li[3]/ul/li[3]/a";
    private $MAILBOXES_TO_DEALING_CLIENT_SETTING_TAB = "//*[@id=\"bs-example-navbar-collapse-3\"]/ul/li[3]/ul/li[4]/a";
    private $MOVE_CLIENT_BUTTON = ".//*[@id='mass-actions']/div[1]/div/a";
    private $REMOVE_CURRENT_CLIENT_BUTTON = ".//*[@id='remove-checked']";
    private $HOME_TAB = "/html/body/nav/div/div[1]/a";
//    private $NEW_IMPORT_FOLDER = "//*[@id=\"li-folder-1328\"]/a/span[1]";
    private $NEW_IMPORT_FOLDER = "//*[@id=\"li-folder-1328\"]/a/span[1]";
    private $EMAIL_LINE_LABELS = "//*[@id=\"table\"]/tbody/tr/td[3]";
    private $CHECKBOXES_IN_TABLE = "//*[@id=\"table\"]/tbody/tr/td[1]";
    private $ALERT_SUCCESS_MESSAGE = ".alert-success";
    private $CATEGORIES_GROUP = "//*[@id=\"moving-send-template\"]/optgroup";
    private $NAMES_CATEGORY = "//*[@id=\"moving-send-template\"]/optgroup[VALUE]/option";
    private $MOVE_BUTTON_IN_MOVE_CLIENT_MODAL = "//*[@id=\"moveSubmit\"]";
    private $TEMPLATE_SELECT = "//*[@id=\"moving-send-template\"]";
    private $MODAL_WINDOW_MOVE_ACTION = "//*[@id=\"moveModal\"]/div[2]/div";

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkTemplateTabShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->TEMPLATE_TAB);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkSettingTabShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->SETTING_TAB);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkImportCsvSettingTabShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->IMPORT_CLIENT_CSV_SETTING_TAB);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkImportEmlSettingTabShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->IMPORT_CLIENT_EML_SETTING_TAB);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkMailboxFetchSettingTabShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->MAILBOXES_TO_FETCH_NEW_CLIENT_SETTING_TAB);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkMailboxDealingSettingTabShow($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->MAILBOXES_TO_DEALING_CLIENT_SETTING_TAB);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkMoveClientButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->MOVE_CLIENT_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkRemoveClientButton($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->REMOVE_CURRENT_CLIENT_BUTTON);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function moveMouseToSettingTab($webDriver)
    {
        $mouse = $webDriver->getMouse();
        $tab = $webDriver->findElement(WebDriverBy::xpath($this->SETTING_TAB));
        $mouse->mouseMove($tab->getCoordinates());
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnTemplatesTab($webDriver)
    {
        $tab = $webDriver->findElement(WebDriverBy::xpath($this->TEMPLATE_TAB));
        SimpleWait::waitingOfClick($webDriver, $tab);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnMailboxNewClientTab($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->MAILBOXES_TO_FETCH_NEW_CLIENT_SETTING_TAB);
        $tab = $webDriver->findElement(WebDriverBy::xpath($this->MAILBOXES_TO_FETCH_NEW_CLIENT_SETTING_TAB));
        $tab->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnImportClientCSV($webDriver)
    {
        $tab = $webDriver->findElement(WebDriverBy::xpath($this->IMPORT_CLIENT_CSV_SETTING_TAB));
        SimpleWait::waitingOfClick($webDriver, $tab);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnHomePageTab($webDriver)
    {
        $tab = $webDriver->findElement(WebDriverBy::xpath($this->HOME_TAB));
        $tab->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnNewImportFolder($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->NEW_IMPORT_FOLDER);
        $folder = $webDriver->findElement(WebDriverBy::xpath($this->NEW_IMPORT_FOLDER));
        $folder->click();
    }


    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function checkLineInTableByEmail($webDriver, $email)
    {
        SimpleWait::waitShow($webDriver, $this->EMAIL_LINE_LABELS);
        $labels = $webDriver->findElements(WebDriverBy::xpath($this->EMAIL_LINE_LABELS));
        if (count($labels) > 0) {
            foreach ($labels as $label) {
                if ($label->getText() == $email) {
                    return true;
                }
            }
        }
        throw new Exception("In table not fount line with email " . $email);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function setCheckboxInLineByEmail($webDriver, $email)
    {
        $round = 0;
        while (true) {
            $labels = $webDriver->findElements(WebDriverBy::xpath($this->EMAIL_LINE_LABELS));
            if (count($labels) > 0) {
                $numberLine = 0;
                foreach ($labels as $label) {
                    if ($label->getText() == $email) {
                        $checkboxes = $webDriver->findElements(WebDriverBy::xpath($this->CHECKBOXES_IN_TABLE));
                        $checkboxes[$numberLine]->click();
                        return true;
                    } else {
                        $numberLine++;
                    }
                }
            }
            if($round>=5){
                break;
            }
            $round++;
            sleep(1);
        }
        throw new Exception("In table not fount line with email " . $email);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnRemoveCurrentClientButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->REMOVE_CURRENT_CLIENT_BUTTON));
        $button->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function checkDeleteLineByEmail($webDriver, $email)
    {
        $labels = $webDriver->findElements(WebDriverBy::xpath($this->EMAIL_LINE_LABELS));
        if (count($labels) > 0) {
            foreach ($labels as $label) {
                if ($label->getText() == $email) {
                    throw new Exception("In table not fount line with email " . $email);

                }
            }
        }
        return true;
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function checkSuccessMessage($webDriver)
    {
        SimpleWait::waitShowByCSSSelector($webDriver, $this->ALERT_SUCCESS_MESSAGE);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnMoveCurrentClinetSendingTemplateButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->MOVE_CLIENT_BUTTON));
        $button->click();
        SimpleWait::waitShow($webDriver,$this->MODAL_WINDOW_MOVE_ACTION);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $nameTemplate
     * @param  string $nameCategory
     * @return bool
     * @throws Exception
     */
    public function selectLineInTemplateListByName($webDriver, $nameTemplate, $nameCategory)
    {
        $categories = $webDriver->findElements(WebDriverBy::xpath($this->CATEGORIES_GROUP));
        $numberCategory = 0;
        foreach ($categories as $category) {
            if ($category->getText() == $nameCategory) {
                break;
            } else {
                $numberCategory++;
            }
        }
        $xpath = str_replace("VALUE", $numberCategory, $this->NAMES_CATEGORY);
        $namesTamplates = $webDriver->findElements(WebDriverBy::xpath($xpath));
        foreach ($namesTamplates as $name) {
            if (stristr(trim($name->getText()),$nameTemplate)) {
                $name->click();
                return true;
            }
        }
        throw new Exception("Category with name " . $nameTemplate . " not found");
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnMoveButton($webDriver)
    {
        $button = $webDriver->findElement(WebDriverBy::xpath($this->MOVE_BUTTON_IN_MOVE_CLIENT_MODAL));
        $button->click();
        SimpleWait::waitHide($webDriver,$this->MODAL_WINDOW_MOVE_ACTION);
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnSelectTemplate($webDriver)
    {
        SimpleWait::waitShow($webDriver, $this->TEMPLATE_SELECT);
        $select = $webDriver->findElement(WebDriverBy::xpath($this->TEMPLATE_SELECT));
        $select->click();
    }

    /**
     * @param \Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    public function clickOnMailboxForDealingWithClientsTab($webDriver)
    {
        $tab = $webDriver->findElement(WebDriverBy::xpath($this->MAILBOXES_TO_DEALING_CLIENT_SETTING_TAB));
        $tab->click();
    }

}