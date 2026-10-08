<?php
require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik');

$sqlInsert = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2021001', 'Ahmad Fauzi', 'ahmad.fauzi@example.com', 'Teknik Informatika', 2021, 3.75),
('2021002', 'Budi Santoso', 'budi.santoso@example.com', 'Teknik Informatika', 2021, 3.60),
('2021003', 'Citra Dewi', 'citra.dewi@example.com', 'Teknik Informatika', 2021, 3.85)";

if (mysqli_query($koneksi, $sqlInsert)) {
    echo "[INSERT] Data mahasiswa berhasil dimasukkan ke tabel.\n\n";
} else {
    echo "[ERROR] Gagal memasukkan data mahasiswa: " . mysqli_error($koneksi) . "\n\n";
}

$sqlSelect = "SELECT nim, nama, prodi, ipk 
FROM mahasiswa
WHERE ipk >= 3.50
ORDER BY ipk DESC, nama ASC
LIMIT 10";

$result = mysqli_query($koneksi, $sqlSelect);

echo "--- HASIL QUERY SELECT ---\n";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "NIM: " . $row["nim"] . "\n";
        echo "Nama: " . $row["nama"] . "\n";
        echo "Prodi: " . $row["prodi"] . "\n";
        echo  "IPK: " . $row["ipk"] . "\n";
    }
} else {
    echo "Tidak ada mahasiswa dengan kriteria tersebut.\n";
}

mysqli_close($koneksi);