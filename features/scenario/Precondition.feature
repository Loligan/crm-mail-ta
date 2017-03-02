Feature: precondition scenarios

  @Precondition
  Scenario: Delete All Templates
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    And Нажать кнпоку [Login]
    When Нажать на элемент [Templates] в шапке
    Then Удалить все Templates

  @Precondition
  Scenario: Delete All Mailboxes for dealing with clients
    Given Перейти на главную страницу
    And Ввести в поле Username стандаотное значение
    And Ввести в поле Password стандаотное значение
    When Нажать кнпоку [Login]
    And Навести курсор на элемент [Setting] в шапке
    And Нажать на элемент [Setting]->[Mailboxes for dealing with clients] в шапке
    Then Удалить все Mailboxes for dealing with clients

  @Precondition
  Scenario: Delete All Clients
    Then Удалить всех клиентов в All clients

  @Precondition
  Scenario: Clear Email
    Then Очистить электронный ящик от писем. Login: "vasya12312o907hj@mail.ru", password: "123jashdJKH213"
    Then Очистить электронный ящик от писем. Login: "va123312o907hj@mail.ru", password: "123jas213JKH213"
    Then Очистить электронный ящик от писем. Login: "uih12h321hu@mail.ru", password: "123kl1jKLJklj312"
    Then Очистить электронный ящик от писем. Login: "uih1212321hu@mail.ru", password: "123kl1j123312"
    Then Очистить электронный ящик от писем. Login: "spm213asdi@mail.ru", password: "123kl1j123312"


  @Precondition
  Scenario: Check alive emails
    Then Проверить ящик Mail.ru: Login: "vasya12312o907hj@mail.ru", password: "123jashdJKH213"

  @Precondition
  Scenario: Check alive proxy
    Then Проверить прокси: "158.69.207.241":"5237"