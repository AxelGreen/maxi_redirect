#!/bin/bash
# change index location
sed -i "s/^.*DocumentRoot.*$/DocumentRoot \/var\/www/" /etc/apache2/sites-available/000-default.conf

# restart Apache to apply changes
/etc/init.d/apache2 restart