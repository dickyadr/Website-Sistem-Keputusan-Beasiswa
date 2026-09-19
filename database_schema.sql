-- Database Schema untuk Sistem Keputusan Beasiswa dengan Metode SMART
-- Database: aplikasi_beasiswa

CREATE DATABASE IF NOT EXISTS aplikasi_beasiswa CHARACTER SET utf8 COLLATE utf8_general_ci;
USE aplikasi_beasiswa;

-- Tabel Kriteria
CREATE TABLE IF NOT EXISTS kriteria (
    id_kriteria INT(11) NOT NULL AUTO_INCREMENT,
    nama_kriteria VARCHAR(100) NOT NULL,
    bobot DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    tipe ENUM('benefit', 'cost') NOT NULL DEFAULT 'benefit',
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_kriteria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabel Mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id_mahasiswa INT(11) NOT NULL AUTO_INCREMENT,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50),
    semester INT(2),
    ipk DECIMAL(3,2),
    alamat TEXT,
    no_hp VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_mahasiswa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabel Penilaian
CREATE TABLE IF NOT EXISTS penilaian (
    id_penilaian INT(11) NOT NULL AUTO_INCREMENT,
    id_mahasiswa INT(11) NOT NULL,
    id_kriteria INT(11) NOT NULL,
    nilai DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_penilaian),
    FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id_mahasiswa) ON DELETE CASCADE,
    FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) ON DELETE CASCADE,
    UNIQUE KEY unique_penilaian (id_mahasiswa, id_kriteria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabel Hasil Perhitungan SMART
CREATE TABLE IF NOT EXISTS hasil (
    id_hasil INT(11) NOT NULL AUTO_INCREMENT,
    id_mahasiswa INT(11) NOT NULL,
    total_nilai DECIMAL(10,4) NOT NULL DEFAULT 0.0000,
    ranking INT(11) DEFAULT NULL,
    status ENUM('Lulus', 'Tidak Lulus') DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_hasil),
    FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id_mahasiswa) ON DELETE CASCADE,
    UNIQUE KEY unique_hasil (id_mahasiswa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert Data Sample Kriteria
INSERT INTO kriteria (nama_kriteria, bobot, tipe, keterangan) VALUES
('IPK', 30.00, 'benefit', 'Indeks Prestasi Kumulatif'),
('Penghasilan Orang Tua', 25.00, 'cost', 'Penghasilan per bulan (semakin rendah semakin baik)'),
('Jumlah Tanggungan', 20.00, 'benefit', 'Jumlah anggota keluarga yang ditanggung'),
('Prestasi Akademik', 15.00, 'benefit', 'Prestasi akademik dan non-akademik'),
('Aktivitas Organisasi', 10.00, 'benefit', 'Keaktifan dalam organisasi');

