#!/bin/bash
#declare -x SCRIPTPATH="${0}"
declare -x RUNDIRECTORY="${0%%/*}"
#declare -x SCRIPTNAME="${0##*/}"

#najpierw trzeba utworzyc baze
#mysql -h localhost -u root -p
#mysql> create database gplafferoshop;
#mysql> quit;
mysql -h localhost -u root -p --default_character_set utf8 gplafferoshop < $RUNDIRECTORY/gplafferoshop.sql
