# SIMS PPOB - Adhitya Sukma

**SIMS PPOB** adalah aplikasi Assignment yang dibuat mengunakan framework CodeIgniter 4.5.2 dan Aplikasi **SIMS PPOB** memiliki
beberapa fitur seperti:

1. Registrasi
2. Login
3. Lihat Profile
4. Update Profile Data
5. Update Profile Picture
6. Top Up
7. Pembayaran
8. Riwayat Transaksi

# Fitur

| Login | Registrasi |
|-------|------------|
| <a href="https://prnt.sc/lwj1hTorGLDN" target="_blank"><img src="https://image.prntscr.com/image/YssZctNBTGiHvYl1VgFsXA.png" width="100%"></a> | <a href="https://prnt.sc/NakWOXa8-UU0" target="_blank"><img src="https://image.prntscr.com/image/EMKTdelCTGSn9sMX6ziQrg.png" width="100%"></a> |

| Dashboard | Lihat Profile |
|-----------|----------------|
| <a href="https://prnt.sc/OWSEYvHR7wky" target="_blank"><img src="https://image.prntscr.com/image/w9OZHz3_QqiuTbeuf3yyTA.png" width="100%"></a> | <a href="https://prnt.sc/uae_Iu4--n1E" target="_blank"><img src="https://image.prntscr.com/image/9TciGiXFSGW_POkiMMHc3w.png" width="100%"></a> |

| Top Up | Pembayaran |
|--------|-------------|
| <a href="https://prnt.sc/kNZmoS4AhJX0" target="_blank"><img src="https://image.prntscr.com/image/FfgMGDudT0eRExuyNxkqcg.png" width="100%"></a> | <a href="https://prnt.sc/y01STXoD86D7" target="_blank"><img src="https://image.prntscr.com/image/8RjW9M0OR16ab2BWT_xiPQ.png" width="100%"></a> |

| Riwayat Transaksi |  |
|--------------------|--|
| <a href="https://prnt.sc/T0Q7OFgO6sig" target="_blank"><img src="https://image.prntscr.com/image/dDAeRlDPRsKA2jJpWortQw.png" width="100%"></a> |  |




# Kebutuhan Aplikasi

1. Minimun PHP Version: PHP 8.1 or higher. https://codeigniter4.github.io/userguide/intro/requirements.html
1. PHP Extensions:

- intl
- mbstring
- json
- mysqlnd (if planning to use MySQL)
- libcurl (if planning to use the HTTP\CURLRequest library)

3. Download dan Install xampp https://www.apachefriends.org/download.html
4. Donwload dan Install Composer https://getcomposer.org/
5. Download dan Install gitbash https://git-scm.com/downloads
6. Copy File ENV karena
   CodeIgniter perlu file .env.
   Jika .env belum ada maka buka gitbash atau command prompt (CMD) di dalam directory aplikasi sims ppob lalu jalankan baris berikut:

```
cp env .env
```

7. Set Mode Development (Opsional)
   
   Buka file .env lalu ubah:

```
CI_ENVIRONMENT = development
```

8. Konfigurasi BaseURL
   
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

2. Kemudian akses di browser:

```
http://localhost:8080
```
