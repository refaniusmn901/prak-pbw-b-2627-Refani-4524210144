<?php
include "koneksi.php";

$nim = $_GET['nim'] ?? '';

// MODIFIKASI: prepared statement + cek apakah data benar-benar terhapus
try {
    $stmt = mysqli_prepare($koneksi, "DELETE FROM mahasiswa WHERE nim = ?");
    mysqli_stmt_bind_param($stmt, "s", $nim);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        notif('Data mahasiswa berhasil dihapus', 'index.php');
    } else {
        notif('Data tidak ditemukan', 'index.php');
    }
} catch (mysqli_sql_exception $e) {
    notif('Data gagal dihapus: ' . $e->getMessage());
}
?>