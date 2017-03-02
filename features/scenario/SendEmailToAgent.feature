Feature: Отправка email на ящик агента
  @Test
  Scenario Outline: Отправить сообщение на mail.ru ящик
    Then Отправить <email-agent> письмо с темой <email-subject> и текстом из файла <email-body-file> через ящик <email-sender> пароль <password-sender>
    Examples:
      | email-agent         | email-subject | email-body-file | email-sender             | password-sender |
#      | uih1212321hu@mail.ru | "Test TA"     | mail1           | vasya12312o907hj@mail.ru | 123jashdJKH213  |
      | uih1212321hu@mail.ru | "GgEz"     | mail1           | vasya12312o907hj@mail.ru | 123jashdJKH213  |

  Scenario Outline: Отправка спам писем (для папки "Спам")
    Then Отправить <email-agent> письмо с темой <email-subject> и текстом из файла <email-body-file> через ящик <email-sender> пароль <password-sender>
    Examples:
      | email-agent         | email-subject | email-body-file | email-sender             | password-sender |
      | uih12h321hu@mail.ru | "Test TA"     | spm1           | spm213asdi@mail.ru | 123kl1j123312  |
      | uih12h321hu@mail.ru | "Test TA"     | spm2           | spm213asdi@mail.ru | 123kl1j123312  |
      | uih1212321hu@mail.ru | "Test TA"     | spm3         | spm213asdi@mail.ru | 123kl1j123312  |
      | uih1212321hu@mail.ru | "Test TA"     | spm4           | spm213asdi@mail.ru | 123kl1j123312  |