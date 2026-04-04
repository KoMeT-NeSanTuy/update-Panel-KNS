# 🚀 KNS Panel (Auto Install)

Panel sederhana untuk management router MikroTik + remote access (L2TP & Winbox style seperti fazznet).

---

## ✨ Fitur

* Multi user login
* Management router
* Siap integrasi L2TP
* Auto install (1 command)
* Berbasis PHP + MySQL

---

## ⚡ Instalasi Cepat (1 Command)

### 1. Install Git

```bash
apt update
apt install git -y
```

### 2. Clone Repository

```bash
git clone https://github.com/KoMeT-NeSanTuy/kns-panel.git
cd kns-panel
```

### 3. Jalankan Installer

```bash
bash install.sh
```

---

## 🌐 Akses Panel

Buka di browser:

```
http://IP_SERVER/panel
```

---

## 🔐 Login Default

```
Username: admin
Password: admin123
```

---

## ⚙️ Yang Akan Terinstall Otomatis

* Apache2
* PHP + MySQL
* MariaDB
* Database `kns_panel`
* Web panel di `/var/www/html/panel`

---

## 📁 Struktur Project

```
panel/
├── config.php
├── login.php
├── index.php
├── routers.php
├── add-router.php
├── database.sql
├── install.sh
```

---

## ⚠️ Catatan

* Pastikan VPS fresh (Ubuntu)
* Jalankan sebagai root
* Port 80 harus terbuka

---

## 🚀 Roadmap

* [ ] Auto generate port
* [ ] L2TP integration
* [ ] Remote Winbox system
* [ ] Cloudflare subdomain automation

---

## 👨‍💻 Author

KNS Project - Nesantuy

---

🔥 Simple, cepat, dan siap dikembangkan jadi layanan seperti fazznet
