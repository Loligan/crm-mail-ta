Feature: Check email

  @Check @ID=01-00 @PRIORITY=5 @ASSIGNED=1
  Scenario Outline: Check email #1
    Then Проверить что на ящике присутствует письмо от <email sender>, с темой <subject> и html телом письма <body_file>. Email: <email>, password: <password>
    And Ждать 10
    Examples:
      | email sender | subject      | body_file | email                    | password       |
      | Hello TA     | Hi mr. Eric  | test_1    | vasya12312o907hj@mail.ru | 123jashdJKH213 |
      | Hello TA     | Hi mr. Kenny | test_2    | vasya12312o907hj@mail.ru | 123jashdJKH213 |
      | Hello TA     | Hi mr. Kyle  | test_3    | vasya12312o907hj@mail.ru | 123jashdJKH213 |
      | Hello TA     | Hi mr. Stan  | test_4    | vasya12312o907hj@mail.ru | 123jashdJKH213 |
      | Hello TA     | Hi mr. Habr  | test_5    | vasya12312o907hj@mail.ru | 123jashdJKH213 |
      | Hello TA     | Hi mr. Fin   | test_6    | vasya12312o907hj@mail.ru | 123jashdJKH213 |
