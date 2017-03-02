<?php
require_once "/home/meldon/PhpstormProjects/crm-mail-ta/vendor/autoload.php";
require_once "src/page-objects/HomePage.php";
require_once "src/page-objects/FolderPage.php";
require_once "src/page-objects/TemplatesPage.php";
require_once "src/page-objects/CreateTemplatePage.php";
require_once "src/page-objects/EditTemplatePage.php";
require_once "src/page-objects/MailboxNewClientsPage.php";
require_once "src/page-objects/AddNewMailboxNewClientsPage.php";
require_once "src/page-objects/EditMailboxNewClientsPage.php";
require_once "src/page-objects/ImportClientsCSVPage.php";
require_once "src/page-objects/MailboxesForDealingWithClientPage.php";
require_once "src/page-objects/CreateMailboxesForDealingWithClientPage.php";
require_once "src/page-objects/EditMailboxForDealingWithClientPage.php";
require_once "src/get_mail_test/EmailCheck.php";
require_once "/home/meldon/PhpstormProjects/crm-mail-ta/TestTime/BugReport/Report.php";
require_once "/home/meldon/PhpstormProjects/crm-mail-ta/TestTime/BugReport/LastPhraseReport/LastPhrase.php";
require_once "/home/meldon/PhpstormProjects/crm-mail-ta/features/bootstrap/src/send_mail_test/SendMailer.php";
//require_once "../../vendor/autoload.php";
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    /**require 'EmailCheck.php';
     * EmailCheck::init();
     * EmailCheck::clearOldJSON();
     * EmailCheck::clearLetterOnEmailBox();
     * @var Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     */
    private $webDriver;
    private $homePage;
    private $folderPage;
    private $templatesPage;
    private $createTemplatePage;
    private $editTemplatePage;
    private $mailboxNewClientsPage;
    private $addNewMailboxNewClientsPage;
    private $editMailboxNewClientsPage;
    private $importClientsCSVPage;
    private $mailboxesForDealingWithClientPage;
    private $createMailboxesForDealingWithClientPage;
    private $editMailboxForDealingWithClientPage;

//    private $username = "TestManager";
    private $username = "TestAdmin";
    private $password = "12345";
    private $report;

    private $subjectLetterBuf;
    private $bodyLetterBuf;


    public function __construct()
    {
        $this->homePage = new HomePage();
        $this->folderPage = new FolderPage();
        $this->templatesPage = new TemplatesPage();
        $this->createTemplatePage = new CreateTemplatePage();
        $this->editTemplatePage = new EditTemplatePage();
        $this->mailboxNewClientsPage = new MailboxNewClientsPage();
        $this->addNewMailboxNewClientsPage = new AddNewMailboxNewClientsPage();
        $this->editMailboxNewClientsPage = new EditMailboxNewClientsPage();
        $this->importClientsCSVPage = new ImportClientsCSVPage();
        $this->mailboxesForDealingWithClientPage = new MailboxesForDealingWithClientPage();
        $this->createMailboxesForDealingWithClientPage = new CreateMailboxesForDealingWithClientPage();
        $this->editMailboxForDealingWithClientPage = new EditMailboxForDealingWithClientPage();
    }


    /**
     * @BeforeScenario
     */
    public function BeforeScenario(\Behat\Behat\Hook\Scope\BeforeScenarioScope $scope)
    {

        $capabilities = DesiredCapabilities::chrome();
        $this->webDriver = RemoteWebDriver::create("http://localhost:4444/wd/hub", $capabilities, 90 * 1000, 90 * 1000);
        $this->webDriver->manage()->window();
        $this->webDriver->manage()->window()->maximize();

        $this->report = new Report(true, 1, 2, 5, "http://127.0.0.1/redmine/", "MrRobot", "12345678", "All4BOM");
        $this->report->beforeScenario($scope);
    }

    /**
     * @AfterScenario
     */
    public function AfterScenario(Behat\Behat\Hook\Scope\AfterScenarioScope $scope)
    {
        if ($this->webDriver) {
            $this->webDriver->quit();
        }
        $this->report->afterScenario($scope);
    }

    /**
     * @AfterStep
     * @param \Behat\Behat\Hook\Scope\AfterStepScope $scope
     */
    public function afterStep(Behat\Behat\Hook\Scope\AfterStepScope $scope)
    {
        $this->report->afterStep($scope, $this->webDriver);

    }


    /**
     * @Given /^Перейти на главную страницу$/
     */
    public function goToMainPage()
    {
        $this->webDriver->get("https://94.156.175.83/");

    }

    /**
     * @Then /^На странице имеется поле ввода Username$/
     */
    public function checkUsernameInput()
    {
        $this->homePage->checkShowUsernameInput($this->webDriver);
    }

    /**
     * @Given /^На странице имеется поле ввода Password$/
     */
    public function checkPasswordInput()
    {
        $this->homePage->checkShowPasswordInput($this->webDriver);
    }

    /**
     * @Given /^На странице имеется кнопка \[LOGIN\]$/
     */
    public function checkLoginButton()
    {
        $this->homePage->checkShowLoginButton($this->webDriver);
    }

    /**
     * @When /^Ввести в поле Username стандаотное значение$/
     */
    public function sendStandardUsernameKey()
    {
        SimpleWait::waitShow($this->webDriver, "/html/body/div/div/a[@title=\"Close Toolbar\"]");
        $button = $this->webDriver->findElement(\Facebook\WebDriver\WebDriverBy::xpath("/html/body/div/div/a[@title=\"Close Toolbar\"]"));
        SimpleWait::waitingOfClick($this->webDriver, $button);

        $this->homePage->sendKeyInUsernameInput($this->webDriver, $this->username);
    }

    /**
     * @Given /^Ввести в поле Password стандаотное значение$/
     */
    public function sendStandardPasswordKey()
    {
        $this->homePage->sendKeyInPasswordInput($this->webDriver, $this->password);
    }

    /**
     * @Given /^Нажать кнпоку \[Login\]$/
     */
    public function clickOnLoginButton()
    {
        $this->homePage->clickOnLoginButton($this->webDriver);
    }

    /**
     * @Then /^Перенаправит на страницу Folder$/
     */
    public function checkRedirectFolderPage()
    {
        if (!$this->webDriver->getTitle() == "All clients") {
            throw new Exception("Real Title: " . $this->webDriver->getTitle() . " .But not: " . "All clients");
        }
    }

    /**
     * @Then /^На странице Folder присутствет элемент \[Templates\] в шапке$/
     */
    public function checkTemplateTabOnTop()
    {
        $this->folderPage->checkTemplateTabShow($this->webDriver);
    }

    /**
     * @Given /^На странице Folder присутствет элемент \[Setting\] в шапке$/
     */
    public function checkSettingTabOnTop()
    {
        $this->folderPage->checkSettingTabShow($this->webDriver);
    }

    /**
     * @Given /^На странице Folder присутствет элемент \[Setting\]\->\[ImportClients CSV\] в шапке$/
     */
    public function checkSettingImportClientsCsvTabOnTop()
    {
        $this->folderPage->checkImportCsvSettingTabShow($this->webDriver);
    }

    /**
     * @Given /^На странице Folder присутствет элемент \[Setting\]\->\[Import Clients EML\] в шапке$/
     */
    public function checkSettingImportClientsEmlTabOnTop()
    {
        $this->folderPage->checkImportEmlSettingTabShow($this->webDriver);
    }

    /**
     * @Given /^Навести курсор на элемент \[Setting\] в шапке$/
     */
    public function moveToSettingTabOnTop()
    {
        $this->folderPage->moveMouseToSettingTab($this->webDriver);
    }

    /**
     * @Then /^На странице Folder присутствет элемент \[Move current client sending template\]$/
     */
    public function checkMoveCurrentButton()
    {
        $this->folderPage->checkMoveClientButton($this->webDriver);
    }

    /**
     * @Given /^На странице Folder присутствет элемент \[Remove current client\]$/
     */
    public function checkRemoveCurrentButton()
    {
        $this->folderPage->checkRemoveClientButton($this->webDriver);
    }

    /**
     * @When /^Нажать на элемент \[Templates\] в шапке$/
     */
    public function clickOnTemplatesTabOnTop()
    {
        $this->folderPage->clickOnTemplatesTab($this->webDriver);
    }

    /**
     * @Then /^Перенаправило на страницу Templates$/
     */
    public function checkTemplatePageTitile()
    {
        if ($this->webDriver->getTitle() != "Templates") {
            throw new Exception("In title '" . $this->webDriver->getTitle() . " text");
        }
    }

    /**
     * @Given /^На странице присутствуют элемент \[New Tempale\]$/
     */
    public function checkNewTemplateButtonInTemplatesPage()
    {
        $this->templatesPage->checkNewTemplateButtonShow($this->webDriver);
    }

    /**
     * @Given /^Нажать на кнопку \[New Template\]$/
     */
    public function clickOnNewTemplateButtonInTemplatesPage()
    {
        $this->templatesPage->clickOnNewTemplatesButton($this->webDriver);
    }

    /**
     * @Then /^Перенаправило на странице New Template$/
     */
    public function checkTitleCreateTemplatePage()
    {
        if ($this->webDriver->getTitle() != "Create template") {
            throw new Exception("In title '" . $this->webDriver->getTitle() . " text");
        }
    }

    /**
     * @Given /^На странице присутствуют поле ввода Name$/
     */
    public function checkNameInputOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkNameInputShop($this->webDriver);
    }

    /**
     * @Given /^На странице присутствуют поле ввода Subject separated$/
     */
    public function checkSubjectSeparatedInputOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkSubjectSeparatedInput($this->webDriver);
    }

    /**
     * @Given /^На странице присутствуют поле ввода Body text$/
     */
    public function checkBodyTextInputOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkBodyTextInput($this->webDriver);
    }

    /**
     * @Given /^На странице присутствуют Кнопку \[Source\] в Body text$/
     */
    public function checkGetSourceTextInputOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkGetSourceButton($this->webDriver);
    }

    /**
     * @Given /^На странице присутствуют поле ввода Categories: Образец категории для автоматических шаблонов$/
     */
    public function checkAutoCategoriesLineOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkAutoCategoriesLine($this->webDriver);
    }

    /**
     * @Given /^На странице присутствуют поле ввода Create$/
     */
    public function checkCreateButtonOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkCreateButton($this->webDriver);
    }

    /**
     * @When /^Нажать на кнопку \[Source\] в области ввода тела email$/
     */
    public function clickOnSourceButtonOnCreateTemplatePage()
    {
        $this->createTemplatePage->clickOnGetSourceButtom($this->webDriver);
    }

    /**
     * @Given /^Появилась облать ввода исходного текста email$/
     */
    public function checkSourceTextInputOnCreateTemplatePage()
    {
        $this->createTemplatePage->checkSourceBodyInput($this->webDriver);
    }

    /**
     * @Given /^Ждать ([^"]*)$/
     */
    public function sleepWait($arg1)
    {
        sleep($arg1);
    }

    /**
     * @Given /^Ввести в поле Name: "([^"]*)"$/
     */
    public function setTextInNameInputInCreateTemplatePage($arg1)
    {
        $this->createTemplatePage->setTextInNameInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле Subjects separated: "([^"]*)"$/
     */
    public function setSubjectSeparatedInputOnCreateTemplatePage($arg1)
    {
        $this->createTemplatePage->setTextInSubjectSeparated($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле Body Text: "([^"]*)"$/
     */
    public function setBodyTextInputOnCreateTemplatePage($arg1)
    {
        $this->createTemplatePage->setTextInBodyMail($this->webDriver, $arg1);
    }

    /**
     * @Given /^Выбрать значение в Categories: Образец категории для автоматических шаблонов$/
     */
    public function setAutoPatternLineInCreateTemplatePage()
    {
        $this->createTemplatePage->setAutoCategoriesLine($this->webDriver);
    }

    /**
     * @Given /^Нажать кнопку \[Create\] на странице New template$/
     */
    public function clickOnCreateButtonOnCreateTemplatePage()
    {
        $this->createTemplatePage->clickOnCreateButton($this->webDriver);
    }

    /**
     * @Then /^На странице Template появилась запись с Subject "([^"]*)"$/
     */
    public function checkTemplateOnTableInTemplatesPages($arg1)
    {
        $this->templatesPage->checkTemplateBySubjectName($this->webDriver, $arg1);
    }

    /**
     * @Then /^На странице Template появилась запись с Name "([^"]*)"$/
     */
    public function checkTemplateOnTableWithNameInTemplatesPages($arg1)
    {
        $this->templatesPage->checkTemplateByName($this->webDriver, $arg1);
    }

    /**
     * @Given /^Нажать кнопку Edit рядом с записью с Subject "([^"]*)"$/
     */
    public function clickOnEditButtonBySubjectNameInTemplatesPages($arg1)
    {
        $this->templatesPage->clickOnEditButtonBySubjectName($this->webDriver, $arg1);
    }

    /**
     * @Then /^Перенаправило на страницу Edit Template$/
     */
    public function checkEditTemplatePage()
    {
        if ($this->webDriver->getTitle() != "Edit template") {
            throw new Exception("Page not be Edit template. In title next text: " . $this->webDriver->getTitle());
        }
    }

    /**
     * @Given /^Нажать на копку \[Delete\] на странице Edit Template$/
     */
    public function clickOnDeleteButtonOnEditTemplatePage()
    {
        $this->editTemplatePage->clickOnDeleteButton($this->webDriver);
    }

    /**
     * @Given /^В таблице нет записи с Subject "([^"]*)"$/
     */
    public function checkNoElementByNameInTableInTemplatesPage($arg1)
    {
        $this->templatesPage->checkedThatNoElementByName($this->webDriver, $arg1);
    }

    /**
     * @Given /^Нажать на элемент \[Setting\]\->\[Mailboxes to fetch new clients\] в шапке$/
     */
    public function clickOnMailboxNewClientTabInTop()
    {
        $this->folderPage->clickOnMailboxNewClientTab($this->webDriver);
    }

    /**
     * @Then /^Перенаправило на страницу Mailboxes to fetch new clients$/
     */
    public function checkTitleMailboxToFetchNewClients()
    {
        if ($this->webDriver->getTitle() != "Agents") {
            throw new Exception("Page not be Mailboxes to fetch new clients. In title next text: " . $this->webDriver->getTitle());
        }
    }

    /**
     * @Given /^На странице Mailbox to fetch new clients присутствует кнопка \[Add new mailbox to fetch new clients\]$/
     */
    public function checkAddNewMailboxOnMailboxNewClientsPage()
    {
        $this->mailboxNewClientsPage->checkShowAddNewMailboxButton($this->webDriver);
    }

    /**
     * @Given /^Нажать кнопку \[Add new mailbox to fetch new clients\] на странице Mailbox to fetch new clients$/
     */
    public function clickOnNewMailboxToFetchNewClientsOnMailboxesToFetchNewClientsPage()
    {
        $this->mailboxNewClientsPage->clickOnAddNewMailboxButton($this->webDriver);
    }

    /**
     * @Then /^Перенаправило на страницу Add new mailbox to fetch new clients$/
     */
    public function checkAddNewMailboxToFetchNewClientsPageTitle()
    {
        if ($this->webDriver->getTitle() != "Create agent") {
            throw new Exception("Page not be Add new mailbox to fetch new clients. In title next text: " . $this->webDriver->getTitle());
        }
    }

    /**
     * @Given /^На странице Add new mailbox to fetch new clients присутствует элемент Email input$/
     */
    public function checkEmailInputInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkShowEmailInput($this->webDriver);
    }

    /**
     * @Given /^На странице Add new mailbox to fetch new clients присутствует элемент IMAP host input$/
     */
    public function checkImapHostInputInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkShowImapHostInput($this->webDriver);
    }

    /**
     * @Given /^На странице Add new mailbox to fetch new clients присутствует элемент IMAP port input$/
     */
    public function checkImapPortInputInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkShowImapPortInput($this->webDriver);
    }

    /**
     * @Given /^На странице Add new mailbox to fetch new clients присутствует элемент password input$/
     */
    public function checkPasswordInputInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkShowPasswordInput($this->webDriver);
    }

    /**
     * @Given /^На странице Add new mailbox to fetch new clients присутствует элемент SOCKS5 proxies$/
     */
    public function checkProxieInputInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkShowProxyInput($this->webDriver);
    }

    /**
     * @Given /^На странице Add new mailbox to fetch new clients присутствует кнопка \[Create\]$/
     */
    public function checkCreateButtonInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkCreateButton($this->webDriver);
    }

    /**
     * @Given /^Ввести в поле Email "([^"]*)", на странице Add new mailbox to fetch new clients$/
     */
    public function setTextInEmailInputInAddNewMailboxToFetchNewClientsPage($arg1)
    {
        $this->addNewMailboxNewClientsPage->setTextInEmailInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле IMAP host input "([^"]*)", на странице Add new mailbox to fetch new clients$/
     */
    public function setTextInImapHostInputInAddNewMailboxToFetchNewClientsPage($arg1)
    {
        $this->addNewMailboxNewClientsPage->setTextInImapHostInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле IMAP port input "([^"]*)", на странице Add new mailbox to fetch new clients$/
     */
    public function setTextInImapPortInputInAddNewMailboxToFetchNewClientsPage($arg1)
    {
        $this->addNewMailboxNewClientsPage->setTextInImapPortInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле Password "([^"]*)", на странице Add new mailbox to fetch new clients$/
     */
    public function setTextInPasswordInputInAddNewMailboxToFetchNewClientsPage($arg1)
    {
        $this->addNewMailboxNewClientsPage->setTextInPasswordInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле SOCKS5 proxies "([^"]*)", на странице Add new mailbox to fetch new clients$/
     */
    public function setTextInSockInputInAddNewMailboxToFetchNewClientsPage($arg1)
    {
        $this->addNewMailboxNewClientsPage->setTextInProxyInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Нажать на пустое простое пространство на странице Add new mailbox to fetch new clients$/
     */
    public function clickOnSpaceInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->clickOnSpace($this->webDriver);
    }

    /**
     * @Given /^Появилось сообщение All proxies are alive на странице Add new mailbox to fetch new clients$/
     */
    public function checkProxyAliveInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->checkShowAllProxyAreAlive($this->webDriver);
    }

    /**
     * @Given /^Нажать кнопку \[Create\], на странице Add new mailbox to fetch new clients$/
     */
    public function clickOnCreateButtonInAddNewMailboxToFetchNewClientsPage()
    {
        $this->addNewMailboxNewClientsPage->clickOnCreateButton($this->webDriver);
    }

    /**
     * @Given /^На странице Mailboxes to fetch new clients появилась запись с Email "([^"]*)"$/
     */
    public function checkLineWithEmailLabelInTableInMailboxToFetchNewClientsTab($arg1)
    {
        $this->mailboxNewClientsPage->checkLineEnabledByEmailName($this->webDriver, $arg1);
    }

    /**
     * @Given /^Нажать кнопку \[Edit\] рядом с записью с email "([^"]*)" на странице Mailbox to fetch new clients$/
     */
    public function clickOnEditButtonByEmailInTableMailboxToFetchNewClientsTab($arg1)
    {
        $this->mailboxNewClientsPage->clickOnEditButtonByEmailName($this->webDriver, $arg1);
    }

    /**
     * @Then /^Перенаправило на страницу Edit mailboxes to fetch new clients$/
     */
    public function checkEditMailboxNewCLientTitle()
    {
        if ($this->webDriver->getTitle() != "Edit agent") {
            throw new Exception("Page not be Edit mailbox to fetch new clients. In title next text: " . $this->webDriver->getTitle());
        }
    }

    /**
     * @Given /^На странице Edit mailboxes to fetch new clients присутствует кнопка \[Delete\]$/
     */
    public function checkShowDeleteButtonOnEditAgentPage()
    {
        $this->editMailboxNewClientsPage->checkShowDeleteButton($this->webDriver);
    }

    /**
     * @Given /^Нажать кнопку \[Delete\] на странице Edit mailboxes to fetch new clients$/
     */
    public function clickOnDeleteButtonOnEditAgentPage()
    {
        $this->editMailboxNewClientsPage->clickOnDeleteButton($this->webDriver);
    }

    /**
     * @Given /^Нажать на элемент \[Setting\]\->\[ImportClients CSV\] в шапке$/
     */
    public function clickOnImportClientsCSVTab()
    {
        $this->folderPage->clickOnImportClientCSV($this->webDriver);
    }

    /**
     * @Then /^Перенаправило на страницу Import Client$/
     */
    public function checkTitleImportClients()
    {
        if ($this->webDriver->getTitle() != "Import clients") {
            throw new Exception("Page not be Import clients. In title next text: " . $this->webDriver->getTitle());
        }
    }

    /**
     * @Given /^На странице Import Client CSV присутствет элемент Select File$/
     */
    public function checkShowFileInputInImportClientsCSV()
    {
        $this->importClientsCSVPage->checkShowFileInput($this->webDriver);
    }

    /**
     * @Given /^На странице Import Client CSV присутствет кнопка \[Import clients\]$/
     */
    public function checkShowImportClientsButtonInImportClientCSVPage()
    {
        $this->importClientsCSVPage->checkShowImportClientsButton($this->webDriver);
    }

    /**
     * @Given /^Выбрать файл с одним клиентом в ImportClients CSV$/
     */
    public function setCSVFileWithOneClients()
    {
        $this->importClientsCSVPage->selectOneClientInFileInput($this->webDriver);
    }

    /**
     * @Given /^Нажать кнопку \[Import clients\] в ImportClients CSV$/
     */
    public function clickOnImportClientsButtonInImportClientsCSV()
    {
        $this->importClientsCSVPage->clickOnImportClientsButton($this->webDriver);
    }

    /**
     * @Given /^На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов$/
     */
    public function checkImportClientSuccessImportInImportClientCSV()
    {
        $this->importClientsCSVPage->checkShowSuccessImportMessage($this->webDriver);
    }

    /**
     * @Given /^Нажать на элемент \[Home page\] в шапке$/
     */
    public function clickOnHomePageTabInTop()
    {
        $this->folderPage->clickOnHomePageTab($this->webDriver);
    }

    /**
     * @Given /^Нажать на папку Новые извлеченные на странице Folder$/
     */
    public function clickOnNewImportOnFolderPage()
    {
        $this->folderPage->clickOnNewImportFolder($this->webDriver);
    }

    /**
     * @Then /^В таблице присутствует запись с email "([^"]*)"$/
     */
    public function checkLineInTableByEmailOnFolderPage($arg1)
    {
        $this->folderPage->checkLineInTableByEmail($this->webDriver, $arg1);
    }

    /**
     * @Then /^Поставить флажок в записи с email "([^"]*)" на странице Folder$/
     */
    public function setCheckboxInLineByEmail($arg1)
    {
        $this->folderPage->setCheckboxInLineByEmail($this->webDriver, $arg1);
    }

    /**
     * @Given /^Нажать кнопку \[Remove current client\] на странице Folder$/
     */
    public function clickOnRemoverCurrentClientOnFolderPage()
    {
        $this->folderPage->clickOnRemoveCurrentClientButton($this->webDriver);
    }

    /**
     * @Given /^В таблице нет записи с email "([^"]*)" на странице Folder$/
     */
    public function checkDeleteClientFromTableInFolderPage($arg1)
    {
        $this->folderPage->checkDeleteLineByEmail($this->webDriver, $arg1);
    }

    /**
     * @Given /^Появилось сообщение об успешном удалении записи на странице Folder$/
     */
    public function checkSuccessMessageOnFolderPage()
    {
        $this->folderPage->checkSuccessMessage($this->webDriver);
    }

    /**
     * @Given /^Нажать кнопку \[Move current client sending template\] на странице Folder$/
     */
    public function clickOnMoveButtonOnFolderPage()
    {
        $this->folderPage->clickOnMoveCurrentClinetSendingTemplateButton($this->webDriver);
    }

    /**
     * @Given /^Раскрыть список Template на странице Folder в окне Move clients$/
     */
    public function clickOnSelectTemplateOnFolderPage()
    {
        $this->folderPage->clickOnSelectTemplate($this->webDriver);
    }

    /**
     * @Given /^Выбрать Template "([^"]*)" категории "([^"]*)" в списке Template на странице Folder в окне Move clients$/
     */
    public function setTemplateByNameAndByNameCategoryInFolderPage($arg1, $arg2)
    {
        $this->folderPage->selectLineInTemplateListByName($this->webDriver, $arg1, $arg2);
    }

    /**
     * @Given /^Нажать кнопку \[Move\] на странице Folder в окне Move clients$/
     */
    public function clickOnMoveButtonOnFolderPageOnMoveClientsModal()
    {
        $this->folderPage->clickOnMoveButton($this->webDriver);
    }

    /**
     * @Given /^Нажать на элемент \[Setting\]\->\[Mailboxes for dealing with clients\] в шапке$/
     */
    public function clickOnMailboxesForDealingWithClientsTabInTop()
    {
        $this->folderPage->clickOnMailboxForDealingWithClientsTab($this->webDriver);
    }

    /**
     * @Then /^Перенаправило на страницу Mailboxes for dealing with clients$/
     */
    public function checkMailboxTitle()
    {

    }

    /**
     * @Given /^На странице Mailbox to fetch new clients присутствует кнопка \[Add new mailbox for dealing with clients\]$/
     */
    public function checkAddNewMailboxForDealingWithClientsShowButton()
    {
        $this->mailboxesForDealingWithClientPage->checkShowAddNewMailboxButton($this->webDriver);
    }

    /**
     * @Given /^Нажать на кнопку \[Add new mailbox for dealing with clients\] на странице Mailboxes for dealing with clients$/
     */
    public function clickOnAddNewMailboxButtonOnMailboxesForDealingWithClientsPage()
    {
        $this->mailboxesForDealingWithClientPage->clickOnAddNewMailboxButton($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-Email\-\-$/
     */
    public function checkEmailInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowEmailInput($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-Максимальное количество привязанных клиентов\-\-$/
     */
    public function checkMaxClientsInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowMaxClientInput($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-Задержка между отправками \(в секундах\)\-\-$/
     */
    public function checkTimeoutInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowTimeoutInput($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-Password\-\-$/
     */
    public function checkPasswordInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowPasswordInput($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-SOCKS5 proxies\-\-$/
     */
    public function checkSock5ProxiesInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowSock5Input($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-SMTP host\-\-$/
     */
    public function checkSmtpHostInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowSmtpHostInput($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-SMTP port\-\-$/
     */
    public function checkSmtpPortInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowSmtpPortInput($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует кнопка \[CREATE\]$/
     */
    public function checkCreateButtonInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowCreateButton($this->webDriver);
    }

    /**
     * @Given /^Ввести в поле =Email= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInEmailInputInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInEmailInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле =Максимальное количество привязанных клиентов= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInMaxClientInputInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInMaxClientInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле =Задержка между отправками \(в секундах\)= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInTimeoutInputInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInTimeoutInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле =Password= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInPasswordInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInPasswordInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле =SOCKS5 proxies= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInSock5InMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInSock5Input($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле =SMTP host= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInSmtpHostInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInSmtpHostInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Ввести в поле =SMTP port= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInSmtpPortInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInSmtpPortInput($this->webDriver, $arg1);
    }

    /**
     * @Given /^Нажать кнопку \[CREATE\] на странице Mailboxes for dealing with clients$/
     */
    public function clickOnCreateButtonInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->clickOnCreateButton($this->webDriver);
    }

    /**
     * @Then /^На странице Mailboxes for dealing with clients присутствует элемент \-\-Sender name\-\-$/
     */
    public function checkSenderNameInputInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->checkShowSenderNameInput($this->webDriver);
    }

    /**
     * @Given /^Ввести в поле =Sender name= "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function setTextInSenderNameInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->setTextInSenderNameInput($this->webDriver, $arg1);
    }

    /**
     * @Then /^На странице mailboxes for dealing with clients присутствует элемент preset "([^"]*)"$/
     */
    public function checkPresetByNameInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->checkPresetByName($this->webDriver, $arg1);
    }

    /**
     * @Given /^Раскрыть список Preset на странице Mailboxes for dealing with clients$/
     */
    public function showOptionsInMailboxForDealingWithClientsPage()
    {
        $this->createMailboxesForDealingWithClientPage->clickOnSelectPreset($this->webDriver);
    }

    /**
     * @Given /^Выбрать Preset "([^"]*)" на странице Mailboxes for dealing with clients$/
     */
    public function clickOnOptionByNameInMailboxForDealingWithClientsPage($arg1)
    {
        $this->createMailboxesForDealingWithClientPage->clickOnPresetByName($this->webDriver, $arg1);
    }


    /**
     * @Then /^Проверить что на ящике присутствует письмо от (.*), с темой (.*) и html телом письма (.*). Email: (.*), password: (.*)$/
     */
    public function checkEmailBySenderEmailAndSubjectAndHtmlBody($emailSender, $subject, $bodyFileName, $email, $password)
    {
        EmailCheck::init($email, $password);
        EmailCheck::clearOldJSON();
        $body = file_get_contents("/home/meldon/PhpstormProjects/crm-mail-ta/email-body/" . $bodyFileName);
        EmailCheck::addLetter($emailSender, $subject, $body);
        $result = EmailCheck::checkEmailByTitle($subject);
        if (!$result) {
            throw new Exception("Email not be find with:\nsubject" . $subject . "\nbody: \n" . $body);
        }
    }

    /**
     * @Given /^Ввести в поле Body Text ввести текст из файла "([^"]*)"$/
     */
    public function setBodySourceTextFromFile($arg1)
    {
        $body = file_get_contents("/home/meldon/PhpstormProjects/crm-mail-ta/email-body/" . $arg1);
        $this->createTemplatePage->setTextInBodyMail($this->webDriver, $body);
    }

    /**
     * @Given /^Ввести в поле Hotkey значение "([^"]*)"$/
     */
    public function setHotkeyValueInCreateTemplate($arg1)
    {
        $this->createTemplatePage->setTextInHotkeyInput($this->webDriver, $arg1);
    }

    /**
     * @Then /^Удалить все Templates$/
     */
    public function deleteAllTemplates()
    {
        while (true) {
            $count = $this->templatesPage->getColumnTemplates($this->webDriver);
            if ($count > 0) {
                $this->templatesPage->clickOnFirstEditButton($this->webDriver);
                $this->editTemplatePage->clickOnDeleteButton($this->webDriver);
            } else {
                break;
            }
        }
    }

    /**
     * @Then /^Удалить все Mailboxes for dealing with clients$/
     */
    public function deleteAllEmails()
    {
        $count = $this->mailboxesForDealingWithClientPage->getCountMailboxes($this->webDriver);
        if ($count > 0) {
            $this->mailboxesForDealingWithClientPage->clickOnFirstEditButton($this->webDriver);
            $this->editMailboxForDealingWithClientPage->removeAllClients($this->webDriver);
            $this->editMailboxForDealingWithClientPage->clickOnDeleteButton($this->webDriver);
        }

    }


    /**
     * @Then /^Проверить прокси: "([^"]*)":"([^"]*)"$/
     */
    public function checkProxy($proxy, $port)
    {
        if (!@fsockopen($proxy, $port, $er, $ers, 30)) {
            throw new Exception("proxy: " . $proxy . "is not alive. " . $ers);
        }
    }

    /**
     * @Then /^Удалить всех клиентов в All clients$/
     */
    public function deleteAllClient()
    {
    }

    /**
     * @Then /^Проверить ящик Mail\.ru: Login: "([^"]*)", password: "([^"]*)"$/
     */
    public function checkEmailIsAlive($email, $password)
    {
        EmailCheck::init($email, $password);
    }

    /**
     * @Then /^Очистить электронный ящик от писем\. Login: "([^"]*)", password: "([^"]*)"$/
     */
    public function clearEmail($email, $password)
    {
        EmailCheck::init($email, $password);
        EmailCheck::clearLetterOnEmailBox();
    }

    /**
     * @Then /^Отправить (.*) письмо с темой (.*) и текстом из файла (.*) через ящик (.*) пароль (.*)$/
     */
    public function sendEmail($emailAgent, $emailSubject, $emailBodyFile, $emailSender, $passwordSender)
    {
        $sendMailer = new SendMailer();
        $sendMailer->createMailRuSmtpSslConnect($emailSender,$passwordSender);
        $sendMailer->createEmailFromFile($emailAgent,$emailSubject,$emailBodyFile);
        $sendMailer->send();
    }

    /**
     * @Given /^Обновить страницу$/
     */
    public function reloadPage()
    {
        $this->webDriver->navigate()->refresh();
    }



}
