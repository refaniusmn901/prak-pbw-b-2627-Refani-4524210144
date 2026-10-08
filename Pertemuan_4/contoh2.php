<?php
require_once 'koneksi.php';

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik";

if (mysqli_query($koneksi, $sqlCreateDB)) {
    echo "[CREATE] Database berhasil dibuat atau sudah ada.\n";
} else {
    echo "[ERROR] Error membuat database: " . mysqli_error($koneksi) . "\n";
}

mysqli_set_charset($koneksi, "utf8mb4");

mysqli_select_db($koneksi, 'akademik');

$sqlCreateTable = [
    "mahasiswa" => "CREATE TABLE IF NOT EXISTS mahasiswa (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nim VARCHAR(15) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(120) NOT NULL UNIQUE,
        prodi VARCHAR(80) NOT NULL,
        angkatan YEAR NOT NULL,
        ipk DECIMAL(3,2) DEFAULT 0.00
    )ENGINE=InnoDB",

    "dosen" => "CREATE TABLE IF NOT EXISTS dosen (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nidn VARCHAR(20) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(120) NOT NULL UNIQUE
    )ENGINE=InnoDB",

    "mata_kuliah" => "CREATE TABLE IF NOT EXISTS mata_kuliah (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        kode_mk VARCHAR(12) NOT NULL UNIQUE,
        nama_mk VARCHAR(100) NOT NULL,
        sks TINYINT UNSIGNED NOT NULL,
        dosen_id BIGINT UNSIGNED,
        CONSTRAINT fk_mk_dosen
        FOREIGN KEY (dosen_id) REFERENCES
        dosen(id) ON UPDATE CASCADE ON DELETE SET NULL
    )ENGINE=InnoDB",

    "jadwal" => "CREATE TABLE IF NOT EXISTS jadwal (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        mata_kuliah_id BIGINT UNSIGNED NOT NULL,
        hari ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
        jam_mulai TIME NOT NULL,
        jam_selesai TIME NOT NULL,
        ruangan VARCHAR(20) NOT NULL,
        CONSTRAINT fk_jadwal_mk
        FOREIGN KEY (mata_kuliah_id) REFERENCES
        mata_kuliah(id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB",

    "krs" => "CREATE TABLE IF NOT EXISTS krs (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        mahasiswa_id BIGINT UNSIGNED NOT NULL,
        semester TINYINT UNSIGNED NOT NULL,
        tahun_ajaran VARCHAR(9) NOT NULL,
        CONSTRAINT uq_krs UNIQUE (mahasiswa_id, semester, tahun_ajaran),
        CONSTRAINT fk_krs_mahasiswa
        FOREIGN KEY (mahasiswa_id) REFERENCES
        mahasiswa(id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB",

    "mk_krs" => "CREATE TABLE IF NOT EXISTS mk_krs (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        krs_id BIGINT UNSIGNED NOT NULL,
        mata_kuliah_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_mkkrs_krs
        FOREIGN KEY (krs_id) REFERENCES
        krs(id) ON UPDATE CASCADE ON DELETE CASCADE,
        CONSTRAINT fk_mkkrs_mk
        FOREIGN KEY (mata_kuliah_id) REFERENCES
        mata_kuliah(id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB",

    "nilai" => "CREATE TABLE IF NOT EXISTS nilai (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        mk_krs_id BIGINT UNSIGNED NOT NULL UNIQUE,
        nilai_angka DECIMAL(5,2) DEFAULT NULL,
        nilai_huruf CHAR(2) DEFAULT NULL,
        CONSTRAINT fk_nilai_mkkrs
        FOREIGN KEY (mk_krs_id) REFERENCES
        mk_krs(id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB"
];

foreach ($sqlCreateTable as $namaTabel => $query) {
    if (mysqli_query($koneksi, $query)) {
        echo "[CREATE] Tabel $namaTabel berhasil dibuat atau sudah ada.\n";
    } else {
        echo "[ERROR] Gagal membuat tabel $namaTabel: " . mysqli_error($koneksi) . "\n";
    }
}

mysqli_close($koneksi);
?>