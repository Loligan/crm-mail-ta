Feature: Страница Add new mailboxes to fetch new clients

  Scenario: Проверка перенаправления на страницу New mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes to fetch new clients] в шапке
    And Нажать кнопку [Add new mailbox to fetch new clients] на странице Mailbox to fetch new clients
    Then Перенаправило на страницу Add new mailbox to fetch new clients
    And На странице Add new mailbox to fetch new clients присутствует элемент Email input
    And На странице Add new mailbox to fetch new clients присутствует элемент IMAP host input
    And На странице Add new mailbox to fetch new clients присутствует элемент IMAP port input
    And На странице Add new mailbox to fetch new clients присутствует элемент password input
    And На странице Add new mailbox to fetch new clients присутствует элемент SOCKS5 proxies
    And На странице Add new mailbox to fetch new clients присутствует кнопка [Create]

  Scenario: Создание ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes to fetch new clients] в шапке
    And Нажать кнопку [Add new mailbox to fetch new clients] на странице Mailbox to fetch new clients
    And Ввести в поле Email "13sinister666@gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP host input "imap.gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP port input "993", на странице Add new mailbox to fetch new clients
    And Ввести в поле Password "5377jerr", на странице Add new mailbox to fetch new clients
    And Ввести в поле SOCKS5 proxies "149.56.173.148:pass1839@158.69.207.241:5237", на странице Add new mailbox to fetch new clients
    And Нажать на пустое простое пространство на странице Add new mailbox to fetch new clients
    And Появилось сообщение All proxies are alive на странице Add new mailbox to fetch new clients
    And Нажать кнопку [Create], на странице Add new mailbox to fetch new clients
    Then Перенаправило на страницу Mailboxes to fetch new clients
    And На странице Mailboxes to fetch new clients появилась запись с Email "13sinister666@gmail.com"

  Scenario: Создание ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes to fetch new clients] в шапке
    And Нажать кнопку [Add new mailbox to fetch new clients] на странице Mailbox to fetch new clients
    And Ввести в поле Email "13sinister666@gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP host input "imap.gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP port input "993", на странице Add new mailbox to fetch new clients
    And Ввести в поле Password "5377jerr", на странице Add new mailbox to fetch new clients
    And Ввести в поле SOCKS5 proxies "149.56.173.148:pass1839@158.69.207.241:5237", на странице Add new mailbox to fetch new clients
    And Нажать на пустое простое пространство на странице Add new mailbox to fetch new clients
    And Появилось сообщение All proxies are alive на странице Add new mailbox to fetch new clients
    And Нажать кнопку [Create], на странице Add new mailbox to fetch new clients
    Then Перенаправило на страницу Mailboxes to fetch new clients
    And На странице Mailboxes to fetch new clients появилась запись с Email "13sinister666@gmail.com"


  Scenario: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes to fetch new clients] в шапке
    And Нажать кнопку [Add new mailbox to fetch new clients] на странице Mailbox to fetch new clients
    And Ввести в поле Email "13sinister666@gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP host input "imap.gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP port input "993", на странице Add new mailbox to fetch new clients
    And Ввести в поле Password "5377jerr", на странице Add new mailbox to fetch new clients
    And Ввести в поле SOCKS5 proxies "149.56.173.148:pass1839@158.69.207.241:5237", на странице Add new mailbox to fetch new clients
    And Нажать на пустое простое пространство на странице Add new mailbox to fetch new clients
    And Появилось сообщение All proxies are alive на странице Add new mailbox to fetch new clients
    And Нажать кнопку [Create], на странице Add new mailbox to fetch new clients
    And Нажать кнопку [Edit] рядом с записью с email "13sinister666@gmail.com" на странице Mailbox to fetch new clients
    Then Перенаправило на страницу Edit mailboxes to fetch new clients
    And На странице Edit mailboxes to fetch new clients присутствует кнопка [Delete]

  Scenario: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes to fetch new clients] в шапке
    And Нажать кнопку [Add new mailbox to fetch new clients] на странице Mailbox to fetch new clients
    And Ввести в поле Email "13sinister666@gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP host input "imap.gmail.com", на странице Add new mailbox to fetch new clients
    And Ввести в поле IMAP port input "993", на странице Add new mailbox to fetch new clients
    And Ввести в поле Password "5377jerr", на странице Add new mailbox to fetch new clients
    And Ввести в поле SOCKS5 proxies "149.56.173.148:pass1839@158.69.207.241:5237", на странице Add new mailbox to fetch new clients
    And Нажать на пустое простое пространство на странице Add new mailbox to fetch new clients
    And Появилось сообщение All proxies are alive на странице Add new mailbox to fetch new clients
    And Нажать кнопку [Create], на странице Add new mailbox to fetch new clients
    And Нажать кнопку [Edit] рядом с записью с email "13sinister666@gmail.com" на странице Mailbox to fetch new clients
    And Нажать кнопку [Delete] на странице Edit mailboxes to fetch new clients
    And Перенаправило на страницу Mailboxes to fetch new clients

