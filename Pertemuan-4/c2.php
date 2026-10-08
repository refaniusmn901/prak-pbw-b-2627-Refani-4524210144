<?php
require_once 'koneksi.php'; 

mysqli_select_db($koneksi, 'akademik');

echo "===1. PROSES UPDATE DATA===\n";
$sqlUpdate = "UPDATE mahasiswa SET ipk = 3.40 WHERE nim='2021002'";
if (mysqli_query($koneksi, $sqlUpdate)) {
    echo "Data IPK mahasiswa NIM 2021002 berhasil diubah menjadi 3.40.\n\n";
} else {
    echo "Gagal Update: " . mysqli_error($koneksi) . "\n\n";
}

echo "===2. REKAP DATA PER PRODI===\n";
$sqlRekap = "SELECT prodi, COUNT(*) as jumlah, ROUND(AVG(ipk), 2) as rata_ipk 
    FROM mahasiswa 
    GROUP BY prodi
    ORDER BY jumlah DESC";

$resultRekap = mysqli_query($koneksi, $sqlRekap);
if (mysqli_num_rows($resultRekap) > 0) {    
    while ($row = mysqli_fetch_assoc($resultRekap)) {
        echo "Prodi           : " . $row["prodi"] . "\n";
        echo "Jumlah          : " . $row["jumlah"] ."Mahasiswa\n";
        echo "Rata-rata IPK   : " . $row["rata_ipk"] . "\n";
        echo "-----------------------------------\n";
    }
} else {
    echo "Belum ada data rekap prodi.\n";
}   
echo "\n";

// modifikasi tambah group by
echo "===2B. REKAP DATA PER MATA KULIAH===\n";
$sqlRekapMk = "SELECT mk.kode_mk, mk.nama_mk, d.nama AS dosen,
        COUNT(mkk.id) AS jumlah,
        ROUND(AVG(n.nilai_angka), 2) AS rata_nilai
    FROM mata_kuliah mk
    LEFT JOIN dosen d ON d.id = mk.dosen_id
    LEFT JOIN mk_krs mkk ON mkk.mata_kuliah_id = mk.id
    LEFT JOIN nilai n ON n.mk_krs_id = mkk.id
    GROUP BY mk.id, mk.kode_mk, mk.nama_mk, d.nama
    ORDER BY jumlah DESC, mk.kode_mk ASC";

$resultRekapMk = mysqli_query($koneksi, $sqlRekapMk);
if (mysqli_num_rows($resultRekapMk) > 0) {
    while ($row = mysqli_fetch_assoc($resultRekapMk)) {
        echo "Mata Kuliah     : " . $row["kode_mk"] . " - " . $row["nama_mk"] . "\n";
        echo "Dosen           : " . $row["dosen"] . "\n";
        echo "Jumlah          : " . $row["jumlah"] . " Mahasiswa\n";
        echo "Rata-rata Nilai : " . $row["rata_nilai"] . "\n";
        echo "-----------------------------------\n";
    }
} else {
    echo "Belum ada data rekap mata kuliah.\n";
}
echo "\n";


echo "===3. VERIFIKASI DATA (NIM 2021001)===\n";
$sqlVerifikasi = "SELECT * 
    FROM mahasiswa 
    WHERE nim='2021001'";
$sqlVerifikasiResult = mysqli_query($koneksi, $sqlVerifikasi);

if (mysqli_num_rows($sqlVerifikasiResult) > 0) {
    $row = mysqli_fetch_assoc($sqlVerifikasiResult);
    echo "NIM : " . $row["nim"] . "\n";
    echo "Nama: " . $row["nama"] . "\n";
    echo "IPK : " . $row["ipk"] . "\n";
} else {
    echo "Data mahasiswa dengan NIM 2021001 tidak ditemukan.\n";
}

echo "===4. PROSES DELETE DATA===\n"; 
$sqlDelete = "DELETE FROM mahasiswa WHERE nim='2021003'"; 
if (mysqli_query($koneksi, $sqlDelete)) { 
    if (mysqli_affected_rows($koneksi) > 0) { 
        echo "Data mahasiswa dengan NIM 2021003 berhasil dihapus.\n"; 
    } else { echo "Data mahasiswa dengan NIM 2021003 tidak ditemukan.\n"; } 
    
    } else { echo "Gagal menghapus data: " . mysqli_error($koneksi) . "\n"; } 
    
mysqli_close($koneksi); 
?>