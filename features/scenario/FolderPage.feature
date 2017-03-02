Feature: Проверка на странице Folder page

  @ID=01-00 @PRIORITY=5 @ASSIGNED=6
  Scenario: Проверка элементов в шапке на странице Folder Page
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    Then На странице Folder присутствет элемент [Templates] в шапке


  Scenario: Проверка элементов в шапке на странице Folder Page
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And На странице Folder присутствет элемент [Setting] в шапке
    And Навести курсор на элемент [Setting] в шапке
    And На странице Folder присутствет элемент [Setting]->[ImportClients CSV] в шапке
    And На странице Folder присутствет элемент [Setting]->[Import Clients EML] в шапке


  Scenario: Проверка элементов на странице Folder Page
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    Then На странице Folder присутствет элемент [Move current client sending template]
    And На странице Folder присутствет элемент [Remove current client]

