<?php
require "../EmailCheck.php";
EmailCheck::init("vasya12312o907hj@mail.ru","123jashdJKH213");
EmailCheck::addLetter("uih12h321hu@mail.ru","Hi mr. Vasya :D","<p><strong>Hello man</strong></p><p><em><strong>This is test message</strong></em></p>");
EmailCheck::addLetter("uih12h321hu@mail.ru","Hi mr. Hordon :D","<p><strong>Hello bro</strong></p><p><em><strong>This is test messageeeeees</strong></em></p>");
$res = EmailCheck::checkEmailByTitle("Hi mr. Hordon :D");
var_dump($res);