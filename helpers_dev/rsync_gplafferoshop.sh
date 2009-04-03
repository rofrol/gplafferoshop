#!/bin/bash
declare -x RUNDIRECTORY="${0%%/*}"
rsync -vaWH --delete --exclude=.git $RUNDIRECTORY/../ /var/www/localhost/htdocs/php5/gplafferoshop/
chown -R rofrol: $RUNDIRECTORY/../
chown -R apache: /var/www/localhost/htdocs/php5/gplafferoshop