Feature: Отправка Email

#  @Send
  Scenario Outline: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    And Ввести в поле =Sender name= "<senderName>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Email= "<email>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Максимальное количество привязанных клиентов= "50" на странице Mailboxes for dealing with clients
    And Ввести в поле =Задержка между отправками (в секундах)= "10" на странице Mailboxes for dealing with clients
    And Раскрыть список Preset на странице Mailboxes for dealing with clients
    And Выбрать Preset "<presetEmail>" на странице Mailboxes for dealing with clients
    And Ввести в поле =SOCKS5 proxies= "<proxy>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Password= "<password>" на странице Mailboxes for dealing with clients
    And Ждать 2
    And Нажать кнопку [CREATE] на странице Mailboxes for dealing with clients
    And Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "<nameTemplate>"
    And Ввести в поле Subjects separated: "<subjectEmail>"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text ввести текст из файла "<bodySource>"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Ввести в поле Hotkey значение "<hotkey>"
    And Нажать кнопку [Create] на странице New template
    And Ждать 4
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
    And Нажать на элемент [Home page] в шапке
    And Нажать на папку Новые извлеченные на странице Folder
    And Ждать 2
    And Поставить флажок в записи с email "<clientEmail>" на странице Folder
    And Нажать кнопку [Move current client sending template] на странице Folder
    And Раскрыть список Template на странице Folder в окне Move clients
    And Ждать 1
    And Выбрать Template "<nameTemplate>" категории "Образец категории для автоматических шаблонов" в списке Template на странице Folder в окне Move clients
    And Нажать кнопку [Move] на странице Folder в окне Move clients
    And Ждать 3
    Then Появилось сообщение об успешном удалении записи на странице Folder
    Examples:
      | senderName | email               | presetEmail  | password         | proxy                                       | nameTemplate | subjectEmail | bodySource | hotkey | clientEmail              |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA     | Hi mr. Eric  | test_1     | f      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_2   | Hi mr. Kenny | test_2     | u      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_3   | Hi mr. Kyle  | test_3     | c      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_4   | Hi mr. Stan  | test_4     | k      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_5   | Hi mr. Habr  | test_5     | g      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_6   | Hi mr. Fin   | test_6     | z      | vasya12312o907hj@mail.ru |


#  @Send
  Scenario Outline: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    And Ввести в поле =Sender name= "<senderName>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Email= "<email>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Максимальное количество привязанных клиентов= "50" на странице Mailboxes for dealing with clients
    And Ввести в поле =Задержка между отправками (в секундах)= "10" на странице Mailboxes for dealing with clients
    And Раскрыть список Preset на странице Mailboxes for dealing with clients
    And Выбрать Preset "<presetEmail>" на странице Mailboxes for dealing with clients
    And Ввести в поле =SOCKS5 proxies= "<proxy>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Password= "<password>" на странице Mailboxes for dealing with clients
    And Ждать 2
    And Нажать кнопку [CREATE] на странице Mailboxes for dealing with clients
    And Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "<nameTemplate>"
    And Ввести в поле Subjects separated: "<subjectEmail>"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text ввести текст из файла "<bodySource>"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Ввести в поле Hotkey значение "<hotkey>"
    And Нажать кнопку [Create] на странице New template
    And Ждать 4
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
    And Нажать на элемент [Home page] в шапке
    And Нажать на папку Новые извлеченные на странице Folder
    And Ждать 2
    And Поставить флажок в записи с email "<clientEmail>" на странице Folder
    And Нажать кнопку [Move current client sending template] на странице Folder
    And Раскрыть список Template на странице Folder в окне Move clients
    And Ждать 1
    And Выбрать Template "<nameTemplate>" категории "Образец категории для автоматических шаблонов" в списке Template на странице Folder в окне Move clients
    And Нажать кнопку [Move] на странице Folder в окне Move clients
    And Ждать 3
    Then Появилось сообщение об успешном удалении записи на странице Folder
    Examples:
      | senderName | email                | presetEmail  | password      | proxy                                       | nameTemplate | subjectEmail | bodySource | hotkey | clientEmail              |
      | Test TA    | uih1212321hu@mail.ru | Mail.ru IMAP | 123kl1j123312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA     | Hi mr. Eric  | test_1     | f      | vasya12312o907hj@mail.ru |
      | Test TA    | uih1212321hu@mail.ru | Mail.ru IMAP | 123kl1j123312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_2   | Hi mr. Kenny | test_2     | u      | vasya12312o907hj@mail.ru |
      | Test TA    | uih1212321hu@mail.ru | Mail.ru IMAP | 123kl1j123312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_3   | Hi mr. Kyle  | test_3     | c      | vasya12312o907hj@mail.ru |
      | Test TA    | uih1212321hu@mail.ru | Mail.ru IMAP | 123kl1j123312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_4   | Hi mr. Stan  | test_4     | k      | vasya12312o907hj@mail.ru |
      | Test TA    | uih1212321hu@mail.ru | Mail.ru IMAP | 123kl1j123312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_5   | Hi mr. Habr  | test_5     | g      | vasya12312o907hj@mail.ru |
      | Test TA    | uih1212321hu@mail.ru | Mail.ru IMAP | 123kl1j123312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_6   | Hi mr. Fin   | test_6     | z      | vasya12312o907hj@mail.ru |


  # @Send
  Scenario Outline: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    And Ввести в поле =Sender name= "<senderName>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Email= "<email>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Максимальное количество привязанных клиентов= "50" на странице Mailboxes for dealing with clients
    And Ввести в поле =Задержка между отправками (в секундах)= "10" на странице Mailboxes for dealing with clients
    And Раскрыть список Preset на странице Mailboxes for dealing with clients
    And Выбрать Preset "<presetEmail>" на странице Mailboxes for dealing with clients
    And Ввести в поле =SOCKS5 proxies= "<proxy>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Password= "<password>" на странице Mailboxes for dealing with clients
    And Ждать 2
    And Нажать кнопку [CREATE] на странице Mailboxes for dealing with clients
    And Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "<nameTemplate>"
    And Ввести в поле Subjects separated: "<subjectEmail>"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text ввести текст из файла "<bodySource>"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Ввести в поле Hotkey значение "<hotkey>"
    And Нажать кнопку [Create] на странице New template
    And Ждать 4
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
    And Нажать на элемент [Home page] в шапке
    And Нажать на папку Новые извлеченные на странице Folder
    And Ждать 2
    And Поставить флажок в записи с email "<clientEmail>" на странице Folder
    And Нажать кнопку [Move current client sending template] на странице Folder
    And Раскрыть список Template на странице Folder в окне Move clients
    And Ждать 1
    And Выбрать Template "<nameTemplate>" категории "Образец категории для автоматических шаблонов" в списке Template на странице Folder в окне Move clients
    And Нажать кнопку [Move] на странице Folder в окне Move clients
    And Ждать 3
    Then Появилось сообщение об успешном удалении записи на странице Folder
    Examples:
      | senderName | email               | presetEmail  | password         | proxy                                       | nameTemplate | subjectEmail | bodySource | hotkey | clientEmail              |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA     | Hi mr. Eric  | test_1     | f      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_2   | Hi mr. Kenny | test_2     | u      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_3   | Hi mr. Kyle  | test_3     | c      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_4   | Hi mr. Stan  | test_4     | k      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_5   | Hi mr. Habr  | test_5     | g      | vasya12312o907hj@mail.ru |
      | Test TA    | uih12h321hu@mail.ru | Mail.ru IMAP | 123kl1jKLJklj312 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_6   | Hi mr. Fin   | test_6     | z      | vasya12312o907hj@mail.ru |



#  @Send
  Scenario Outline: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    And Ввести в поле =Sender name= "<senderName>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Email= "<email>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Максимальное количество привязанных клиентов= "50" на странице Mailboxes for dealing with clients
    And Ввести в поле =Задержка между отправками (в секундах)= "10" на странице Mailboxes for dealing with clients
    And Раскрыть список Preset на странице Mailboxes for dealing with clients
    And Выбрать Preset "<presetEmail>" на странице Mailboxes for dealing with clients
    And Ввести в поле =SOCKS5 proxies= "<proxy>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Password= "<password>" на странице Mailboxes for dealing with clients
    And Ждать 2
    And Нажать кнопку [CREATE] на странице Mailboxes for dealing with clients
    And Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "<nameTemplate>"
    And Ввести в поле Subjects separated: "<subjectEmail>"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text ввести текст из файла "<bodySource>"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Ввести в поле Hotkey значение "<hotkey>"
    And Нажать кнопку [Create] на странице New template
    And Ждать 4
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
    And Нажать на элемент [Home page] в шапке
    And Нажать на папку Новые извлеченные на странице Folder
    And Ждать 2
    And Поставить флажок в записи с email "<clientEmail>" на странице Folder
    And Нажать кнопку [Move current client sending template] на странице Folder
    And Раскрыть список Template на странице Folder в окне Move clients
    And Ждать 1
    And Выбрать Template "<nameTemplate>" категории "Образец категории для автоматических шаблонов" в списке Template на странице Folder в окне Move clients
    And Нажать кнопку [Move] на странице Folder в окне Move clients
    And Ждать 3
    Then Появилось сообщение об успешном удалении записи на странице Folder
    Examples:
      | senderName | email               | presetEmail  | password         | proxy                                       | nameTemplate | subjectEmail | bodySource | hotkey | clientEmail              |
      | Test TA    | 13sinister666@gmail.com | Gmail IMAP | 5377jerr | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA     | Hi mr. Eric  | test_1     | f      | vasya12312o907hj@mail.ru |
      | Test TA    | 13sinister666@gmail.com | Gmail IMAP | 5377jerr | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_2   | Hi mr. Kenny | test_2     | u      | vasya12312o907hj@mail.ru |
      | Test TA    | 13sinister666@gmail.com | Gmail IMAP | 5377jerr | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_3   | Hi mr. Kyle  | test_3     | c      | vasya12312o907hj@mail.ru |
      | Test TA    | 13sinister666@gmail.com | Gmail IMAP | 5377jerr | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_4   | Hi mr. Stan  | test_4     | k      | vasya12312o907hj@mail.ru |
      | Test TA    | 13sinister666@gmail.com | Gmail IMAP | 5377jerr | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_5   | Hi mr. Habr  | test_5     | g      | vasya12312o907hj@mail.ru |
      | Test TA    | 13sinister666@gmail.com | Gmail IMAP | 5377jerr | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_6   | Hi mr. Fin   | test_6     | z      | vasya12312o907hj@mail.ru |

  @Send
  Scenario Outline: Создание и удаление ящика Add new mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    And Нажать на кнопку [Add new mailbox for dealing with clients] на странице Mailboxes for dealing with clients
    And Ввести в поле =Sender name= "<senderName>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Email= "<email>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Максимальное количество привязанных клиентов= "50" на странице Mailboxes for dealing with clients
    And Ввести в поле =Задержка между отправками (в секундах)= "10" на странице Mailboxes for dealing with clients
    And Раскрыть список Preset на странице Mailboxes for dealing with clients
    And Выбрать Preset "<presetEmail>" на странице Mailboxes for dealing with clients
    And Ввести в поле =SOCKS5 proxies= "<proxy>" на странице Mailboxes for dealing with clients
    And Ввести в поле =Password= "<password>" на странице Mailboxes for dealing with clients
    And Ждать 2
    And Нажать кнопку [CREATE] на странице Mailboxes for dealing with clients
    And Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "<nameTemplate>"
    And Ввести в поле Subjects separated: "<subjectEmail>"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text ввести текст из файла "<bodySource>"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Ввести в поле Hotkey значение "<hotkey>"
    And Нажать кнопку [Create] на странице New template
    And Ждать 4
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
    And Нажать на элемент [Home page] в шапке
    And Нажать на папку Новые извлеченные на странице Folder
    And Ждать 2
    And Поставить флажок в записи с email "<clientEmail>" на странице Folder
    And Нажать кнопку [Move current client sending template] на странице Folder
    And Раскрыть список Template на странице Folder в окне Move clients
    And Ждать 1
    And Выбрать Template "<nameTemplate>" категории "Образец категории для автоматических шаблонов" в списке Template на странице Folder в окне Move clients
    And Нажать кнопку [Move] на странице Folder в окне Move clients
    And Ждать 3
    Then Появилось сообщение об успешном удалении записи на странице Folder
    Examples:
      | senderName | email                    | presetEmail | password        | proxy                                       | nameTemplate | subjectEmail | bodySource | hotkey | clientEmail              |
      | Test TA    | carolina@turinetersa.com | 1and1 IMAP  | JU6G734FHg4][34 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA     | Hi mr. Eric  | test_1     | f      | vasya12312o907hj@mail.ru |
      | Test TA    | carolina@turinetersa.com | 1and1 IMAP  | JU6G734FHg4][34 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_2   | Hi mr. Kenny | test_2     | u      | vasya12312o907hj@mail.ru |
      | Test TA    | carolina@turinetersa.com | 1and1 IMAP  | JU6G734FHg4][34 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_3   | Hi mr. Kyle  | test_3     | c      | vasya12312o907hj@mail.ru |
      | Test TA    | carolina@turinetersa.com | 1and1 IMAP  | JU6G734FHg4][34 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_4   | Hi mr. Stan  | test_4     | k      | vasya12312o907hj@mail.ru |
      | Test TA    | carolina@turinetersa.com | 1and1 IMAP  | JU6G734FHg4][34 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_5   | Hi mr. Habr  | test_5     | g      | vasya12312o907hj@mail.ru |
      | Test TA    | carolina@turinetersa.com | 1and1 IMAP  | JU6G734FHg4][34 | 149.56.173.148:pass1839@158.69.207.241:5237 | Hello TA_6   | Hi mr. Fin   | test_6     | z      | vasya12312o907hj@mail.ru |

