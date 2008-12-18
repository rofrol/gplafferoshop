#!/bin/bash
#najpierw trzeba utworzyc baze
#mysql -h localhost -u root -p
#mysql> create database gplafferoshop;
#mysql> quit;
mysql -h localhost -u root -p --default_character_set utf8 gplafferoshop < gplafferoshop.sql
