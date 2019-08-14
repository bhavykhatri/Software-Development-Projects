#!/bin/bash

db=db.txt
add_entry () {
  local name=$1
  local team=$2
  local avg=$3

  awk "/^$name,/" db.txt|awk ' {print $1} ' FS=','>tmp.txt
  output="$(cat tmp.txt)"

  [[ !  -z  $output  ]] && echo "I am not zero"
  if [[ !  -z  $output ]]
  then
    if [ $output == $name ];
    then
      echo "Entry with name $name already exist. Do you want to replace it?"
      read response
      if [ $response == "yes" ];
      then
        sed -i -e "s/^$name,.*/$name, $team, $avg/"  $db
        return
      elif [ $response == "no" ];
      then
        return
      fi
    fi
  fi
  echo "$name, $team, $avg">>$db
}

search_entry(){

  return
}
