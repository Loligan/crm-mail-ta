#!/usr/bin/env bash

set -e


ME=`basename $0`
function print_help() {
    echo "Чтобы вызвать автотест по ID введите команду:"
    echo "-t ID_тестов"
    echo "Чтобы вызвать автотест по ID и имени теста введите команду:"
    echo "-t ID_тестов -g Заголовок_теста"
    echo
}

function run_scenario() {
cd ..
if [ -z "$TITLE" ];then
bin/behat --tags="@ID=$TAG";
else
bin/behat --tags="@ID=$TAG" --name="$TITLE"
fi
}


# Если скрипт запущен без аргументов, открываем справку.
if [ $# = 0 ]; then
    print_help
fi

while getopts "t:g:" opt; do
  case $opt in
    t)
      TAG=$OPTARG
      ;;
      g)
      TITLE=$OPTARG;
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2
      exit 1
      ;;
  esac
done

run_scenario;