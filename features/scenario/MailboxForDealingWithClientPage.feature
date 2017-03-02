Feature: Страница Mailboxes for dealing with client

  Scenario: Проверка наличия элементов на странице Mailbox to fetch new clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    Then Перенаправило на страницу Mailboxes for dealing with clients
    And На странице Mailbox to fetch new clients присутствует кнопка [Add new mailbox for dealing with clients]

