Feature: Проверка страницы Login

  @ID=00-00 @PRIORITY=5 @ASSIGNED=6
  Scenario: Наличие инпутов и кнопки Login на странице
    Given Перейти на главную страницу
    Then На странице имеется поле ввода Username
    And На странице имеется поле ввода Password
    And На странице имеется кнопка [LOGIN]

  @ID=00-01 @PRIORITY=5 @ASSIGNED=6
  Scenario: Авторизация с стандартным логином и паролем
    Given Перейти на главную страницу
    When Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    Then Перенаправит на страницу Folder


    Scenario: Проверка автоматического логаута спустя 15 минут
      Given Перейти на главную страницу
      When Ввести в поле Username стандаотное значение
      And Ввести в поле Password стандаотное значение
      And Нажать кнпоку [Login]
      And Перенаправит на страницу Folder
      And Ждать 960
      And Обновить страницу
      Then На странице имеется поле ввода Username