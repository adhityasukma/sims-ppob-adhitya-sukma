# SIMS PPOB - Adhitya Sukma

SIMS PPOB adalah test assignment berupa Aplikasi yang dibuat mengunakan framework Codeigniter versi 4++ memiliki
beberapa fitur seperti:

1. Registrasi
2. Login
3. Lihat Profile
4. Update Profile Data
5. Update Profile Picture
6. Top Up
7. Pembayaran
8. Riwayat Transaksi

# Kebutuhan Aplikasi

1. Minimun PHP Version 7.4
1. Download dan Install xampp https://www.apachefriends.org/download.html
1. Donwload dan Install Composer https://getcomposer.org/
1. Download dan Install gitbash https://git-scm.com/downloads

## Konfigurasi Database

1. Buka phpmyadmin dan buat database baru yaitu **sims-ppob**
2. Copy dan Paste file env kemudian file tersebut di rename menjadi .env
3. Buka file .env kemudian edit baris berikut disesuaikan dengan konfigurasi Database di phpMyadmin:
   > database.default.hostname = localhost
   > database.default.database = sims-ppob
   > database.default.username = root
   > database.default.password =
   > database.default.DBDriver = MySQLi
   > database.default.DBPrefix =
   > database.default.port = 3306
4. Buka gitbash di dalam directory aplikasi sims ppob lalu jalankan baris berikut:

```
composer install
php spark migrate
php spark db:seed BannersSeeder
php spark db:seed ServicesSeeder
```

5. Jalankan Aplikasi dengan mengetik perintah berikut:

```
php spark serve
```
