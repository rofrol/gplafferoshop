#!/bin/bash
#!/bin/bash
#declare -x SCRIPTPATH="${0}"
declare -x RUNDIRECTORY="${0%%/*}"
declare -x SCRIPTNAME="${0##*/}"

if [ "$RUNDIRECTORY" == "$SCRIPTNAME" ]; then
   RUNDIRECTORY="."
fi

if [ ! -d /var/www/localhost/htdocs/php5/gplafferoshop ]; then mkdir -p /var/www/localhost/htdocs/php5/gplafferoshop; fi
rsync -vaWH --delete --exclude=.git --exclude=*.swp $RUNDIRECTORY/../ /var/www/localhost/htdocs/php5/gplafferoshop/
#chown -R rofrol: $RUNDIRECTORY/../
chown -R apache: /var/www/localhost/htdocs/php5/
