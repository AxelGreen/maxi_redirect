#!/bin/bash -x
# copy install log
cp /root/maxi_redirect/install.log /var/log/sender4you/install.log
# remove all installation files
rm -rf /root/maxi_redirect/
rm -rf /root/install_run.sh
rm -rf /root/install_run.log