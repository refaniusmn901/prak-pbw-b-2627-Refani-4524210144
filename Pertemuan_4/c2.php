<?php
require_once 'koneksi.php';

myssqli_select_db($koneksi, 'akademik');

echo "=== 1. PROSES UPDATE DATA ===\n";
$sqlUpdate = "UPDATE mahasiswa SET ipk = 3.40 WHERE nim = '2021002'";
if (mysqli_query($koneksi, $sqlUpdate)) {
    echo " Data IPK mahasiswa 2021002 berhasil diubah menjadi 3.40.\n\n";
} else {
    echo " Gagal UPDATE: " . mysqli_error($koneksi) . "\n\n";
}

echo "=== 2. REKAP MAHASIWA PER PRODI ===\n";
$sqlRekap = "SELECT prodi, COUNT(*) AS jumlah, ROUND(AVG(ipk),2) AS 
rata_ipk
FROM mahasiswa
GROUP BY prodi
ORDER BY jumlah DESC";

$result = mysqli_query($koneksi, $sqlRekap);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Prodi: " . $row["prodi"] . "\n";
        echo "Jumlah Mahasiswa: " . $row["jumlah"] . "\n";
        echo "Rata-rata IPK: " . $row["rata_ipk"] . "\n\n";
    }
} else {
    echo "Tidak ada data mahasiswa.\n";
}

