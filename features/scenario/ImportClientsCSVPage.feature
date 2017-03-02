Feature: Страница Setting >> Import Clients CSV Page

  Scenario: Проверка элементов на странице Import Clients CSV Page
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    Then Перенаправило на страницу Import Client
    And На странице Import Client CSV присутствет элемент Select File
    And На странице Import Client CSV присутствет кнопка [Import clients]

  Scenario: Проверка загрузки одного клиента
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    Then Перенаправило на страницу Import Client
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов

  Scenario: Проверка загрузки одного клиента в папке "Новые извлеченные"
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
    And Выбрать файл с одним клиентом в ImportClients CSV
    And Нажать кнопку [Import clients] в ImportClients CSV
    And Перенаправило на страницу Import Client
    And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
    And Нажать на элемент [Home page] в шапке
    And Нажать на папку Новые извлеченные на странице Folder
    Then В таблице присутствует запись с email "vasya12312o907hj@mail.ru"

    Scenario: Создание и удаление одного клиента из папки "Новые извлеченные"
      Given Перейти на главную страницу
      And Ввести в поле Username стандаотное значение
      And Ввести в поле Password стандаотное значение
      When Нажать кнпоку [Login]
      And Навести курсор на элемент [Setting] в шапке
      And Нажать на элемент [Setting]->[ImportClients CSV] в шапке
      And Выбрать файл с одним клиентом в ImportClients CSV
      And Нажать кнопку [Import clients] в ImportClients CSV
      And Перенаправило на страницу Import Client
      And На странице ImportClients CSV повилось сообщение об успешной загрузке клиентов
      And Нажать на элемент [Home page] в шапке
      And Нажать на папку Новые извлеченные на странице Folder
      And Ждать 2
      Then Поставить флажок в записи с email "13sinister666@gmail.com" на странице Folder
      And Нажать кнопку [Remove current client] на странице Folder
      And Появилось сообщение об успешном удалении записи на странице Folder
      And Ждать 2
      And В таблице нет записи с email "13sinister666@gmail.com" на странице Folder