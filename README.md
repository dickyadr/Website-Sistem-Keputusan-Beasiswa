# Website Sistem Keputusan Beasiswa

Aplikasi sistem keputusan beasiswa menggunakan metode **SMART (Simple Multi-Attribute Rating Technique)** yang dibangun dengan **CodeIgniter 3**.

## Fitur

- ✅ Manajemen Kriteria (dengan bobot dan tipe benefit/cost)
- ✅ Manajemen Data Mahasiswa
- ✅ Input Penilaian untuk setiap mahasiswa
- ✅ Perhitungan Otomatis menggunakan Metode SMART
- ✅ Ranking dan Hasil Keputusan
- ✅ Detail Perhitungan per Kriteria
- ✅ Laporan Hasil (Cetak)

## Instalasi

### 1. Persyaratan
- PHP 5.6+ atau PHP 7.x
- MySQL/MariaDB
- Web Server (Apache/Nginx) atau PHP Built-in Server
- CodeIgniter 3.x (sudah termasuk)

### 2. Setup Database

1. Buat database baru:
```sql
CREATE DATABASE aplikasi_beasiswa;
```

2. Import file `database_schema.sql` ke database Anda:
```bash
mysql -u username -p aplikasi_beasiswa < database_schema.sql
```

Atau melalui phpMyAdmin:
- Buka phpMyAdmin
- Pilih database `aplikasi_beasiswa`
- Klik tab "Import"
- Pilih file `database_schema.sql`
- Klik "Go"

### 3. Konfigurasi Database

Edit file `application/config/database.php`:

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',        // Ganti dengan username database Anda
    'password' => '',            // Ganti dengan password database Anda
    'database' => 'aplikasi_beasiswa',
    'dbdriver' => 'mysqli',
    // ... konfigurasi lainnya
);
```

### 4. Konfigurasi Base URL

Edit file `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/Aplikasi-keputusan-beasiswa/';
// Sesuaikan dengan path aplikasi Anda
```

### 5. Jalankan Aplikasi

**Menggunakan PHP Built-in Server:**
```bash
php -S localhost:8000
```

Kemudian buka browser: `http://localhost:8000`

**Menggunakan Apache/Nginx:**
- Pastikan web server sudah dikonfigurasi
- Akses melalui URL yang sudah dikonfigurasi

## Cara Menggunakan

### 1. Setup Kriteria
- Buka menu **Kriteria**
- Tambah kriteria yang akan digunakan untuk penilaian
- Set bobot untuk setiap kriteria (total harus 100%)
- Pilih tipe kriteria:
  - **Benefit**: Semakin besar nilai semakin baik (contoh: IPK, Prestasi)
  - **Cost**: Semakin kecil nilai semakin baik (contoh: Penghasilan)

### 2. Input Data Mahasiswa
- Buka menu **Mahasiswa**
- Tambah data mahasiswa yang akan dinilai
- Lengkapi data seperti NIM, Nama, Jurusan, IPK, dll

### 3. Input Penilaian
- Buka menu **Penilaian**
- Klik "Input Nilai" untuk setiap mahasiswa
- Isi nilai untuk setiap kriteria
- Simpan penilaian

### 4. Hitung Hasil SMART
- Pastikan semua mahasiswa sudah dinilai untuk semua kriteria
- Buka menu **Hasil**
- Klik tombol **"Hitung SMART"** atau **"Hitung Ulang"**
- Sistem akan menghitung dan menampilkan ranking

### 5. Lihat Hasil
- Ranking akan ditampilkan berdasarkan total nilai tertinggi
- Klik "Detail" untuk melihat perhitungan per kriteria
- Gunakan tombol "Cetak" untuk mencetak laporan

## Metode SMART

**SMART (Simple Multi-Attribute Rating Technique)** adalah metode pengambilan keputusan multi-kriteria yang:

1. **Normalisasi Bobot**: Bobot setiap kriteria dinormalisasi sehingga total = 1
2. **Normalisasi Nilai**: Nilai setiap kriteria dinormalisasi berdasarkan tipe (benefit/cost)
3. **Perhitungan Skor Terbobot**: Setiap nilai dikalikan dengan bobot normalisasi
4. **Total Nilai**: Jumlahkan semua skor terbobot untuk mendapatkan total nilai
5. **Ranking**: Urutkan berdasarkan total nilai tertinggi

### Formula Normalisasi

**Benefit (Semakin besar semakin baik):**
```
Nilai Normalisasi = (Nilai - Min) / (Max - Min)
```

**Cost (Semakin kecil semakin baik):**
```
Nilai Normalisasi = (Max - Nilai) / (Max - Min)
```

**Skor Terbobot:**
```
Skor Terbobot = Nilai Normalisasi × Bobot Normalisasi
```

**Total Nilai:**
```
Total = Σ (Skor Terbobot untuk semua kriteria)
```

## Struktur Database

### Tabel `kriteria`
- `id_kriteria`: Primary key
- `nama_kriteria`: Nama kriteria
- `bobot`: Bobot dalam persentase
- `tipe`: benefit atau cost
- `keterangan`: Deskripsi kriteria

### Tabel `mahasiswa`
- `id_mahasiswa`: Primary key
- `nim`: Nomor Induk Mahasiswa (unique)
- `nama`: Nama lengkap
- `jurusan`: Jurusan
- `semester`: Semester
- `ipk`: Indeks Prestasi Kumulatif
- `alamat`: Alamat
- `no_hp`: Nomor HP

### Tabel `penilaian`
- `id_penilaian`: Primary key
- `id_mahasiswa`: Foreign key ke mahasiswa
- `id_kriteria`: Foreign key ke kriteria
- `nilai`: Nilai penilaian

### Tabel `hasil`
- `id_hasil`: Primary key
- `id_mahasiswa`: Foreign key ke mahasiswa
- `total_nilai`: Total nilai hasil perhitungan SMART
- `ranking`: Peringkat
- `status`: Lulus atau Tidak Lulus

## Kontribusi

Silakan lakukan fork dan pull request jika ingin berkontribusi.

## Lisensi

Aplikasi ini dibuat untuk keperluan akademik dan dapat digunakan secara bebas.

## Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

