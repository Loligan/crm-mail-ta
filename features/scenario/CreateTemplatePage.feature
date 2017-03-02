Feature: Тестирование Create Template

  Scenario: Проверка полей ввода и кнопок на странице
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    Then Перенаправило на странице New Template

  Scenario: Проверка полей ввода и кнопок на странице
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And На странице присутствуют поле ввода Name
    And На странице присутствуют поле ввода Subject separated
    And На странице присутствуют поле ввода Body text
    And На странице присутствуют Кнопку [Source] в Body text
    And На странице присутствуют поле ввода Categories: Образец категории для автоматических шаблонов
    And На странице присутствуют поле ввода Create


  Scenario: Проверка полей ввода и кнопок на странице
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    And Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    When Нажать на кнопку [Source] в области ввода тела email
    And Появилась облать ввода исходного текста email

  Scenario: Проверка создание Template
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "TextName"
    And Ввести в поле Subjects separated: "TextSeparated"
    When Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text: "BodyText"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Нажать кнопку [Create] на странице New template
    Then На странице Template появилась запись с Subject "TextSeparated"
    Then На странице Template появилась запись с Name "TextName"


  Scenario: Проверка открытия страницы Edit Template
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "TextName"
    And Ввести в поле Subjects separated: "TextSeparated"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text: "BodyText"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Нажать кнопку [Create] на странице New template
    And Нажать кнопку Edit рядом с записью с Subject "TextSeparated"
    Then Перенаправило на страницу Edit Template

  Scenario: Проверка создания и удаления Template
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    And Нажать на кнопку [New Template]
    And Ввести в поле Name: "TextName"
    And Ввести в поле Subjects separated: "TextSeparated"
    And Нажать на кнопку [Source] в области ввода тела email
    And Ждать 1
    And Ввести в поле Body Text: "BodyText"
    And Выбрать значение в Categories: Образец категории для автоматических шаблонов
    And Нажать кнопку [Create] на странице New template
    And Нажать кнопку Edit рядом с записью с Subject "TextSeparated"
    And Нажать на копку [Delete] на странице Edit Template
    Then Перенаправило на страницу Templates
    And В таблице нет записи с Subject "TextName"
