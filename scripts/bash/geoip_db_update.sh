#!/bin/bash
rm /usr/share/GeoIP/GeoIP.dat
rm /usr/share/GeoIP/GeoIPv6.dat
wget http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz
gunzip GeoLiteCity.dat.gz
mkdir /usr/share/GeoIP
mv GeoLiteCity.dat /usr/share/GeoIP/GeoIPCity.dat
rm GeoLiteCity.dat
/etc/init.d/apache2 restart