# Panduan Instalasi Cepat

## Langkah 1: Setup Database

1. Buka phpMyAdmin atau MySQL client
2. Buat database baru:
```sql
CREATE DATABASE aplikasi_beasiswa;
```

3. Import file `database_schema.sql`:
   - Di phpMyAdmin: Pilih database → Import → Pilih file `database_schema.sql` → Go
   - Atau via command line: `mysql -u root -p aplikasi_beasiswa < database_schema.sql`

## Langkah 2: Konfigurasi Database

Edit file: `application/config/database.php`

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',           // Sesuaikan
    'password' => '',                // Sesuaikan
    'database' => 'aplikasi_beasiswa',
    'dbdriver' => 'mysqli',
    // ... biarkan yang lain default
);
```

## Langkah 3: Konfigurasi Base URL

Edit file: `application/config/config.php`

```php
// Untuk localhost dengan folder
$config['base_url'] = 'http://localhost/Aplikasi-keputusan-beasiswa/';

// Atau untuk root
$config['base_url'] = 'http://localhost/';
```

## Langkah 4: Jalankan Aplikasi

### Opsi A: PHP Built-in Server
```bash
cd "C:\tugas\CodeIgniter\Aplikasi keputusan beasiswa"
php -S localhost:8000
```
Buka: http://localhost:8000

### Opsi B: XAMPP/WAMP
1. Copy folder aplikasi ke `htdocs` atau `www`
2. Akses melalui: http://localhost/nama-folder

## Langkah 5: Login dan Mulai

1. Buka aplikasi di browser
2. Dashboard akan muncul
3. Mulai dengan:
   - Tambah Kriteria
   - Tambah Mahasiswa
   - Input Penilaian
   - Hitung Hasil SMART

## Troubleshooting

### Error: Database connection failed
- Pastikan database sudah dibuat
- Cek username dan password di `database.php`
- Pastikan MySQL service berjalan

### Error: 404 Not Found
- Cek `base_url` di `config.php`
- Pastikan `.htaccess` ada (jika pakai Apache)
- Cek folder permissions

### Error: Class not found
- Pastikan semua file sudah ter-upload dengan benar
- Cek struktur folder sesuai CodeIgniter 3

## Data Sample

Setelah import `database_schema.sql`, sudah ada 5 kriteria sample:
- IPK (30%)
- Penghasilan Orang Tua (25%)
- Jumlah Tanggungan (20%)
- Prestasi Akademik (15%)
- Aktivitas Organisasi (10%)

Anda bisa mengedit atau menambah kriteria sesuai kebutuhan.

