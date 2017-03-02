Feature: Создание Mailboxes for dealing with client

  Scenario: Проверка наличия элементов на странице Mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    Then На странице Mailboxes for dealing with clients присутствует элемент --Sender name--
    Then На странице Mailboxes for dealing with clients присутствует элемент --Email--
    Then На странице Mailboxes for dealing with clients присутствует элемент --Максимальное количество привязанных клиентов--
    Then На странице Mailboxes for dealing with clients присутствует элемент --Задержка между отправками (в секундах)--
    Then На странице mailboxes for dealing with clients присутствует элемент preset "Mail.ru IMAP"
    Then На странице Mailboxes for dealing with clients присутствует элемент --Password--
    Then На странице Mailboxes for dealing with clients присутствует элемент --SOCKS5 proxies--
    Then На странице Mailboxes for dealing with clients присутствует кнопка [CREATE]

  Scenario: Проверка наличия элементов на странице Mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    And Ввести в поле =Sender name= "Eric Cartman" на странице Mailboxes for dealing with clients
    And Ввести в поле =Email= "uih12h321hu@mail.ru" на странице Mailboxes for dealing with clients
    And Ввести в поле =Максимальное количество привязанных клиентов= "5" на странице Mailboxes for dealing with clients
    And Ввести в поле =Задержка между отправками (в секундах)= "10" на странице Mailboxes for dealing with clients
    And Раскрыть список Preset на странице Mailboxes for dealing with clients
    And Выбрать Preset "Mail.ru IMAP" на странице Mailboxes for dealing with clients
    And Ввести в поле =Password= "123kl1jKLJklj312" на странице Mailboxes for dealing with clients
    And Ввести в поле =SOCKS5 proxies= "149.56.173.148:pass1839@158.69.207.241:5237" на странице Mailboxes for dealing with clients
    And Нажать кнопку [CREATE] на странице Mailboxes for dealing with clients

