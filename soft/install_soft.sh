#!/bin/bash -x

# add repositories
apt-get update
which add-apt-repository > /dev/null 2>&1
if [ $? -ne 0 ]; then
    apt-get install -y software-properties-common
fi

# for php 7.0
version=$(awk '{print $3}' /etc/*-release)
if [ "${version}" == "8" ]; then
    echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
    echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
    wget https://www.dotdeb.org/dotdeb.gpg
    apt-key add dotdeb.gpg && rm dotdeb.gpg
else
    add-apt-repository -y ppa:ondrej/php
fi

# start installation
apt-get update
apt-get install -y fail2ban htop
apt install -y apache2
apt-get install -y --allow-unauthenticated php7.0 php7.0-opcache php7.0-mbstring php7.0-bcmath php7.0-zip php7.0-geoip php7.0-curl php7.0-json php7.0-pgsql php7.0-cli apache2-mod-php7.0

# composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
