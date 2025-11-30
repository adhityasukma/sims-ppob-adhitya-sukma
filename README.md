# SIMS PPOB - Adhitya Sukma

**SIMS PPOB** adalah aplikasi Assignment Front End Web Programmer yang dibuat mengunakan framework CodeIgniter 4.5.2 dan Aplikasi **SIMS PPOB** memiliki
beberapa fitur seperti:

1. Registrasi
2. Login
3. Lihat Profile
4. Update Profile Data
5. Update Profile Picture
6. Top Up
7. Pembayaran
8. Riwayat Transaksi

## Dokumentasi API SIMS PPOB

Aplikasi SIMS PPOB integration dengan API dari SIMS PPOB sebagai berikut:
https://api-doc-tht.nutech-integrasi.app

# Kebutuhan Aplikasi

1. Minimun PHP Version: PHP 8.1 or higher. https://codeigniter4.github.io/userguide/intro/requirements.html
1. PHP Extensions:

- intl
- mbstring
- json
- mysqlnd (if planning to use MySQL)
- libcurl (if planning to use the HTTP\CURLRequest library)

1. Download dan Install xampp https://www.apachefriends.org/download.html
1. Donwload dan Install Composer https://getcomposer.org/
1. Download dan Install gitbash https://git-scm.com/downloads
1. Copy File ENV
   CodeIgniter perlu file .env.
   Jika .env belum ada maka Buka gitbash atau command prompt (CMD) di dalam directory aplikasi sims ppob lalu jalankan baris berikut:

```
cp env .env
```

1. Set Mode Development (Opsional)
   Buka file .env lalu ubah:

```
CI_ENVIRONMENT = development
```

1. Konfigurasi BaseURL
   Buka .env, aktifkan bagian baseURL:

```
app.baseURL = 'http://localhost:8080/'
```

# Install Dependencies Composer

1. Buka gitbash di dalam directory aplikasi sims ppob lalu jalankan baris berikut:

```
composer install
```

# Jalankan Aplikasi

1. Jalankan Aplikasi dengan mengetik perintah berikut:

```
php spark serve
```

7. Kemudian akses di browser:

```
http://localhost:8080
```
