🚀 NEXT STEP — TEST INSTALL DI UBUNTU LAIN

Sekarang kita pastikan:
👉 project kamu benar-benar bisa diinstall dari nol

🐧 STEP 1 — SIAPKAN SERVER BARU

Di Ubuntu baru:

sudo apt update
sudo apt install apache2 php mysql-server php-mysql git -y
📥 STEP 2 — CLONE PROJECT

Masuk web root:

cd /var/www/html

Clone dari GitHub kamu:

sudo git clone https://github.com/KoMeT-NeSanTuy/update-Panel-KNS.git
🔐 STEP 3 — SET PERMISSION
sudo chown -R www-data:www-data update-Panel-KNS
sudo chmod -R 755 update-Panel-KNS
🌐 STEP 4 — JALANKAN INSTALLER

Buka browser:

http://IP-SERVER/update-Panel-KNS/install.php
⚙️ STEP 5 — ISI FORM

Isi:

Host: localhost
User: root
Password: (kosong / sesuai server)
Database: kns_panel

Klik Install

✅ STEP 6 — SELESAI

Kalau berhasil:

👉 otomatis:

database dibuat
tabel masuk
config.php dibuat
🔥 STEP 7 (WAJIB AMAN)

Masuk server:

cd /var/www/html/update-Panel-KNS
rm install.php

👉 supaya tidak disalahgunakan

🎯 STEP 8 — TEST APP

Buka:

http://IP-SERVER/update-Panel-KNS/map.php
🧪 KALAU ERROR (CEK INI)
❌ Blank / putih
sudo nano /etc/php/*/apache2/php.ini

ubah:

display_errors = On

restart:

sudo systemctl restart apache2
❌ MySQL error
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
FLUSH PRIVILEGES;
🚀 NEXT LEVEL (KAMU SUDAH MASUK PRO 🔥)

Kalau ini sudah jalan, kita bisa upgrade:

🔥 Level Production:
🔐 Login admin (biar aman)
🌍 Domain + HTTPS
🐳 Docker (1 command install)
🔄 Auto update dari GitHub
📡 Monitoring MikroTik realtime
