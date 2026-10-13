<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    notif('Akses tidak valid', 'create.php');
}

$nim      = trim($_POST['nim'] ?? '');
$nama     = trim($_POST['nama'] ?? '');
$email    = trim($_POST['email'] ?? '');
$prodi    = trim($_POST['prodi'] ?? '');
$angkatan = trim($_POST['angkatan'] ?? '');
$ipk      = trim($_POST['ipk'] ?? '');

// MODIFIKASI 1: validasi di sisi server
$error = validasi_mahasiswa($nim, $nama, $email, $prodi, $angkatan, $ipk);
if (!empty($error)) {
    notif("Data gagal disimpan:\n- " . implode("\n- ", $error));
}

// MODIFIKASI 2: cek NIM duplikat sebelum INSERT
$cek = mysqli_prepare($koneksi, "SELECT nim FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($cek, "s", $nim);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);
if (mysqli_stmt_num_rows($cek) > 0) {
    notif("NIM $nim sudah terdaftar, gunakan NIM lain.");
}
mysqli_stmt_close($cek);

// MODIFIKASI 3: prepared statement (anti SQL Injection)
$angkatan = (int) $angkatan;
$ipk      = (float) $ipk;

try {
    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "ssssid", $nim, $nama, $email, $prodi, $angkatan, $ipk);
    mysqli_stmt_execute($stmt);
    notif('Data mahasiswa berhasil disimpan', 'index.php');
} catch (mysqli_sql_exception $e) {
    notif('Data gagal disimpan: ' . $e->getMessage());
}
?>