Feature: Проверка Template Page

  Scenario: Проверка наличия элементов на странице Template
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    Then Перенаправило на страницу Templates

  Scenario: Проверка наличия элементов на странице Template
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    And На странице присутствуют элемент [New Tempale]
