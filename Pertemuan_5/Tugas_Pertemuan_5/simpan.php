<?php
include "koneksi.php";
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak valid. <a href='form.php'>Kembali ke form</a>");
}
 
$nim      = trim($_POST['nim'] ?? '');
$nama     = trim($_POST['nama'] ?? '');
$email    = trim($_POST['email'] ?? '');
$prodi    = trim($_POST['prodi'] ?? '');
$angkatan = trim($_POST['angkatan'] ?? '');
$ipk      = trim($_POST['ipk'] ?? '');
 
// modifikasi
$error = [];
 
if ($nim === '' || !ctype_digit($nim)) {
    $error[] = "NIM harus diisi dan berupa angka.";
}
if ($nama === '') {
    $error[] = "Nama tidak boleh kosong.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = "Format email tidak valid.";
}
if ($prodi === '') {
    $error[] = "Prodi harus dipilih.";
}
if (!ctype_digit($angkatan) || $angkatan < 2000 || $angkatan > 2100) {
    $error[] = "Angkatan harus berupa tahun antara 2000-2100.";
}
if (!is_numeric($ipk) || $ipk < 0 || $ipk > 4) {
    $error[] = "IPK harus berupa angka antara 0.00 - 4.00.";
}
 
if (!empty($error)) {
    echo "<b>Data gagal disimpan:</b><ul>";
    foreach ($error as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul><a href='form.php'>Kembali ke form</a>";
    exit;
}
 
// modifikasi
$cek = mysqli_prepare($koneksi, "SELECT nim FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($cek, "s", $nim);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);
 
if (mysqli_stmt_num_rows($cek) > 0) {
    echo "Data gagal disimpan: NIM <b>" . htmlspecialchars($nim) . "</b> sudah terdaftar.<br>";
    echo "<a href='form.php'>Kembali ke form</a>";
    exit;
}
mysqli_stmt_close($cek);
 
// modifikasi
$stmt = mysqli_prepare($koneksi,
    "INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk)
     VALUES (?, ?, ?, ?, ?, ?)");
 
$angkatan = (int) $angkatan;
$ipk      = (float) $ipk;
mysqli_stmt_bind_param($stmt, "ssssid", $nim, $nama, $email, $prodi, $angkatan, $ipk);
 
if (mysqli_stmt_execute($stmt)) {
    echo "Data berhasil disimpan.<br>";
    echo "<a href='data.php'>Lihat data</a> | <a href='form.php'>Tambah lagi</a>";
} else {
    echo "Data gagal disimpan: " . htmlspecialchars(mysqli_stmt_error($stmt));
}
 
mysqli_stmt_close($stmt);
