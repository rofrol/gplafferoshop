rsync -vaWH --delete --exclude=.git ./ /var/www/localhost/htdocs/php5/gplafferoshop/
chown -R rofrol: .
chown -R apache: /var/www/localhost/htdocs/php5/gplafferoshop