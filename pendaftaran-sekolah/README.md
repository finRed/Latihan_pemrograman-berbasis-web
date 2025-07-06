# Sistem Pendaftaran Sekolah dengan AJAX Login

Sistem pendaftaran siswa sekolah dengan fitur autentikasi AJAX yang modern dan responsif.

## Fitur

- ✅ Login dan Register dengan AJAX
- ✅ Validasi form real-time
- ✅ Password strength indicator
- ✅ Session management
- ✅ Responsive design dengan Bootstrap 5
- ✅ Modern UI dengan Font Awesome icons
- ✅ CRUD siswa dengan autentikasi
- ✅ Logout dengan AJAX

## Setup

### 1. Database Setup
1. Import file `db_sekolah.sql` ke MySQL/MariaDB
2. Pastikan database `db_sekolah` sudah dibuat

### 2. Konfigurasi Database
Edit file `config.php` sesuai dengan konfigurasi database Anda:
```php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sekolah";
```

### 3. Create Admin User
1. Akses `create_admin.php` di browser
2. Admin user akan dibuat dengan kredensial:
   - Username: `admin`
   - Password: `admin123`
3. **PENTING**: Hapus file `create_admin.php` setelah admin user dibuat!

### 4. Akses Sistem
1. Buka `login.php` di browser
2. Login dengan kredensial admin atau register user baru
3. Setelah login, Anda akan diarahkan ke halaman utama

## Struktur File

```
pendaftaran-sekolah/
├── config.php              # Konfigurasi database
├── db_sekolah.sql          # Struktur database
├── login.php               # Halaman login
├── register.php            # Halaman register
├── auth_handler.php        # Handler AJAX untuk auth
├── index.php               # Halaman utama (dengan auth)
├── tambah.php              # Tambah siswa
├── edit.php                # Edit siswa
├── hapus.php               # Hapus siswa
├── create_admin.php        # Script buat admin (hapus setelah digunakan)
└── README.md               # Dokumentasi ini
```

## Keamanan

- ✅ Password di-hash menggunakan `password_hash()`
- ✅ Prepared statements untuk mencegah SQL injection
- ✅ Session management
- ✅ Input validation dan sanitization
- ✅ CSRF protection (session-based)

## Teknologi

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5
- **Icons**: Font Awesome 6
- **AJAX**: jQuery 3.6

## Penggunaan

### Login
1. Buka `login.php`
2. Masukkan username dan password
3. Sistem akan memvalidasi dan redirect ke dashboard

### Register
1. Buka `register.php`
2. Isi semua field yang diperlukan
3. Password strength indicator akan membantu
4. Setelah berhasil, login dengan akun baru

### Manajemen Siswa
1. Login ke sistem
2. Tambah, edit, atau hapus data siswa
3. Semua operasi memerlukan autentikasi

## Troubleshooting

### Database Connection Error
- Pastikan XAMPP/WAMP berjalan
- Periksa konfigurasi di `config.php`
- Pastikan database `db_sekolah` sudah dibuat

### Login Gagal
- Pastikan admin user sudah dibuat
- Periksa username dan password
- Pastikan tabel `users` sudah ada

### AJAX Error
- Periksa console browser untuk error JavaScript
- Pastikan jQuery sudah dimuat
- Periksa network tab untuk response dari server

## Kontribusi

Silakan fork dan submit pull request untuk perbaikan atau fitur baru.

## Lisensi

Open source - bebas digunakan untuk keperluan pendidikan. 