#!/bin/bash
# listed connection from all IPs
sed -i "s/^.*listen_addresses.*$/listen_addresses = '*'/" /etc/postgresql/9.6/main/postgresql.conf
# trust connections from central server. Don't ask password
echo "host    postgres        postgres        88.99.195.32/0  trust" >> /etc/postgresql/9.6/main/pg_hba.conf
# trust connections from localhost. Don't ask password
sed -i "s/^.*host.*all.*all.*127\.0\.0\.1.*md5.*$/host    all             all             127.0.0.1\/32            trust/" /etc/postgresql/9.6/main/pg_hba.conf
# change server configuration
# DB Version: 9.6
# OS Type: linux
# DB Type: web
# Total Memory (RAM): 256 MB
# Number of Connections: 20
sed -i "s/^.*max_connections.*=.*$/max_connections = 20/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^shared_buffers.*=.*$/shared_buffers = 64MB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*effective_cache_size.*=.*$/effective_cache_size = 192MB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*work_mem =.*$/work_mem = 3276kB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*maintenance_work_mem.*=.*$/maintenance_work_mem = 16MB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*min_wal_size.*=.*$/min_wal_size = 1GB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*max_wal_size.*=.*$/max_wal_size = 2GB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*checkpoint_completion_target.*=.*$/checkpoint_completion_target = 0.7/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*wal_buffers.*=.*$/wal_buffers = 1966kB/" /etc/postgresql/9.6/main/postgresql.conf
sed -i "s/^.*default_statistics_target.*=.*$/default_statistics_target = 100/" /etc/postgresql/9.6/main/postgresql.conf
# restart postgres to apply changes
/etc/init.d/postgresql restart
