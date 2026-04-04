#!/bin/bash

echo "INSTALL KNS PANEL..."

apt update -y
apt install apache2 mariadb-server php php-mysql libapache2-mod-php git -y

systemctl enable apache2
systemctl start apache2

systemctl enable mariadb
systemctl start mariadb

mysql -u root <<EOF
CREATE DATABASE kns_panel;
CREATE USER 'knsuser'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON kns_panel.* TO 'knsuser'@'localhost';
FLUSH PRIVILEGES;
EOF

cd /var/www/html
rm -rf panel
git clone https://github.com/KoMeT-NeSanTuy/kns-panel.git panel

cd panel

mysql -u root kns_panel < database.sql

cp config.sample.php config.php

sed -i "s/DB_USER/knsuser/g" config.php
sed -i "s/DB_PASS/password123/g" config.php
sed -i "s/DB_NAME/kns_panel/g" config.php

chown -R www-data:www-data /var/www/html/panel
chmod -R 755 /var/www/html/panel

systemctl restart apache2

echo "SELESAI! buka http://IP/panel"
