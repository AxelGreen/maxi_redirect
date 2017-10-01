#!/bin/bash
# TODO: improve replacement
# change index location and add Directory tag
sed -i "s/^.*DocumentRoot.*$/DocumentRoot \/var\/www\n<Directory \"\/var\/www\">\nAllowOverride All\n<\/Directory>/" /etc/apache2/sites-available/000-default.conf
#enable rewrite module
a2enmod rewrite
# restart Apache to apply changes
/etc/init.d/apache2 restart