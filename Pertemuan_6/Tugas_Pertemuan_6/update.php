<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    notif('Akses tidak valid', 'index.php');
}

$nim      = trim($_POST['nim'] ?? '');
$nama     = trim($_POST['nama'] ?? '');
$email    = trim($_POST['email'] ?? '');
$prodi    = trim($_POST['prodi'] ?? '');
$angkatan = trim($_POST['angkatan'] ?? '');
$ipk      = trim($_POST['ipk'] ?? '');

// MODIFIKASI: validasi server
$error = validasi_mahasiswa($nim, $nama, $email, $prodi, $angkatan, $ipk);
if (!empty($error)) {
    notif("Data gagal diupdate:\n- " . implode("\n- ", $error));
}

$angkatan = (int) $angkatan;
$ipk      = (float) $ipk;

// MODIFIKASI: prepared statement
try {
    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE mahasiswa
         SET nama = ?, email = ?, prodi = ?, angkatan = ?, ipk = ?
         WHERE nim = ?"
    );
    mysqli_stmt_bind_param($stmt, "sssids", $nama, $email, $prodi, $angkatan, $ipk, $nim);
    mysqli_stmt_execute($stmt);
    notif('Data mahasiswa berhasil diupdate', 'index.php');
} catch (mysqli_sql_exception $e) {
    notif('Data gagal diupdate: ' . $e->getMessage());
}
?>