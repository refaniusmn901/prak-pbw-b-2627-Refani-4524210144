<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$nama_db = 'penjualan';

$koneksi = mysqli_connect($host, $user, $password);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS $nama_db");
mysqli_select_db($koneksi, $nama_db);

mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL
)");

mysqli_set_charset($koneksi, 'utf8mb4');

function h($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}
?>