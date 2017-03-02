#!/usr/bin/env bash
#!/usr/bin/env bash

set -e

ME=`basename $0`
function print_help() {
    echo "Чтобы запустить запись gif введите комманду:"
    echo "-r имя_файла"
    echo ""
}

function run_scenario() {
cd /home/meldon/PhpstormProjects/All4bom_TA/features/bootstrap/src/BugReport/GifRecord/gif
ffmpeg -f x11grab -r 7 -s 1366x1050  -i :0 -vf scale=683:525 "$NAME.gif"  > /dev/null 2>&1 &
}

# Если скрипт запущен без аргументов, открываем справку.
if [ $# = 0 ]; then
    print_help
fi

while getopts "r:" opt; do
  case $opt in
    r)
      NAME=$OPTARG
      run_scenario;
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2
      exit 1
      ;;
  esac
done

