#!/usr/bin/env bash

player_html="http://www.espncricinfo.com/india/content/player"
stats=player_stats.txt


file_ls="$(grep "<a href=\"/ci/content/player/.*html\">.*</a></td>" indian-players.html\
|awk  '{print $2}' FS="a href=\"/ci/content/player/"\
|awk '{print $1}' FS="\">"\
|sort -u)"

echo $file_ls
>$stats
for file in $file_ls;do
  wget -O player.html "$player_html/$file"
  name="$(grep "<h1>.*<a href=\"/rss/content" player.html \
  | awk 'BEGIN {FS="<h1>|<a href"} {print $2}')"

  team="$(grep "<h3 class=\"PlayersSearchLink\"" player.html \
  |awk 'BEGIN {FS="<b>|</b>"} {print $2}')"

  avg="$(grep "<td class=\"padAst\" nowrap=\"nowrap\|<td nowrap=\"nowrap\">" player.html  \
  |head -6\
  |tail -1\
  |awk 'BEGIN {FS="<td nowrap=\"nowrap\">|</td>"} {print $2}')"

  # echo $name $team $avg
  echo "$name, $team, $avg">>$stats
  rm player.html
done
cat $stats
