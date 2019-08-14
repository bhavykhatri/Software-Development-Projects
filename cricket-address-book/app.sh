#!/bin/bash

source ./utils.sh

#database file
db=db.txt


#Greeting Text
echo "Welcome to Cricket Address Book App"
echo "___________________________________"
echo "Created by: Atul, Bhavy"
echo "___________________________________"
echo "We provide the following functionalities"
echo "add: Add cricketer's data Name, Team, Batting Average"
echo "__________________________"

while [ 1 ]
do
  echo "What do you want to do?"
  read option
  if [ "$option" == "add"  ]
  then
    echo "Cricketer's Name:"
    read name
    echo "Team"
    read team
    echo "Batting Average"
    read average

    add_entry "$name" "$team" "$average"
    # echo "$name, $team, $average">>$db
    echo "Entry Added"

  elif [ "$option" == "search" ]
  then
    echo "Search by name or team"
    read search_entry
    echo "Your search results are as follow:"
    grep -n $search_entry $db
  elif [ "$option" == "remove" ]
  then
    echo "Search by name or team:"
    read search_entry
    echo "Search entries:"
    grep -n $search_entry $db
    echo "Which player number do you want to remove?"
    read player_no
    sed -i "${player_no}d" $db
    echo "Player removed"


  elif [ "$option" == "exit" ]
  then
    echo "Thanks for using Cricket Address Book App!"
    break
  else
    echo "__________________________"
    echo "You have choosen the wrong option! Please choose only among the following"
    echo "add"
    echo "search"
    echo "remove"
    echo "exit"
  fi
  echo "__________________________"
  sleep 1
done
