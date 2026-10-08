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

// modifikasi tambah data
$dataAwal = [
    "dosen" => "INSERT IGNORE INTO dosen (id, nidn, nama, email) VALUES
        (1, '0401018801', 'Dr. Rina Wijaya', 'rina.wijaya@example.com'),
        (2, '0402028502', 'Hendra Kusuma, M.Kom', 'hendra.kusuma@example.com')",

    "mata_kuliah" => "INSERT IGNORE INTO mata_kuliah (id, kode_mk, nama_mk, sks, dosen_id) VALUES
        (1, 'IF101', 'Pemrograman Web', 3, 1),
        (2, 'IF102', 'Basis Data', 3, 2),
        (3, 'IF103', 'Algoritma dan Pemrograman', 4, 1)",

    "jadwal" => "INSERT IGNORE INTO jadwal (id, mata_kuliah_id, hari, jam_mulai, jam_selesai, ruangan) VALUES
        (1, 1, 'Senin', '08:00:00', '10:30:00', 'R101'),
        (2, 2, 'Selasa', '10:00:00', '12:30:00', 'R102'),
        (3, 3, 'Rabu', '13:00:00', '16:00:00', 'LAB1')",

    "krs" => "INSERT IGNORE INTO krs (id, mahasiswa_id, semester, tahun_ajaran) VALUES
        (1, 1, 1, '2021/2022'),
        (2, 2, 1, '2021/2022'),
        (3, 3, 1, '2021/2022')",

    "mk_krs" => "INSERT IGNORE INTO mk_krs (id, krs_id, mata_kuliah_id) VALUES
        (1, 1, 1), (2, 1, 2), (3, 1, 3),
        (4, 2, 1), (5, 2, 2), (6, 2, 3),
        (7, 3, 1), (8, 3, 2), (9, 3, 3)",

    "nilai" => "INSERT IGNORE INTO nilai (id, mk_krs_id, nilai_angka, nilai_huruf) VALUES
        (1, 1, 88, 'A'),  (2, 2, 85, 'A'),  (3, 3, 90, 'A'),
        (4, 4, 76, 'B+'), (5, 5, 78, 'B+'), (6, 6, 74, 'B'),
        (7, 7, 92, 'A'),  (8, 8, 95, 'A'),  (9, 9, 91, 'A')"
];

foreach ($dataAwal as $namaTabel => $query) {
    if (mysqli_query($koneksi, $query)) {
        echo "[INSERT] Data $namaTabel berhasil dimasukkan.\n";
    } else {
        echo "[ERROR] Gagal memasukkan data $namaTabel: " . mysqli_error($koneksi) . "\n";
    }
}
echo "\n";


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