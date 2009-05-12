#!/bin/bash
#declare -x SCRIPTPATH="${0}"
declare -x RUNDIRECTORY="${0%%/*}"
declare -x SCRIPTNAME="${0##*/}"

if [ "$RUNDIRECTORY" == "$SCRIPTNAME" ]; then
   RUNDIRECTORY="."
fi

#najpierw trzeba utworzyc baze
mysql -u root -p -e "create database gplafferoshop;"
mysql -h localhost -u root -p --default_character_set utf8 gplafferoshop < $RUNDIRECTORY/gplafferoshop.sql

