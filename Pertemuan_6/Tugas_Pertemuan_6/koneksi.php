<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';

$koneksi = mysqli_connect($host, $user, $password, 'akademik');

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// MODIFIKASI: tidak terus mencetak teks "Koneksi berhasil"
mysqli_set_charset($koneksi, 'utf8mb4');

// Daftar prodi dipakai bersama oleh create.php dan edit.php
$daftar_prodi = [
    'Teknik Informatika',
    'Sistem Informasi',
    'Teknik Elektro',
    'Manajemen',
    'Akuntansi',
];

function h($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}
function notif($pesan, $tujuan = null)
{
    $js = json_encode($pesan);
    if ($tujuan) {
        echo "<script>alert($js); window.location.href = '$tujuan';</script>";
    } else {
        echo "<script>alert($js); window.history.back();</script>";
    }
    exit;
}

// Validasi data mahasiswa, mengembalikan array pesan error
function validasi_mahasiswa($nim, $nama, $email, $prodi, $angkatan, $ipk)
{
    $error = [];
    if ($nim === '') {
        $error[] = "NIM tidak boleh kosong.";
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
    if (!ctype_digit($angkatan) || (int) $angkatan < 2000 || (int) $angkatan > 2100) {
        $error[] = "Angkatan harus berupa tahun antara 2000-2100.";
    }
    if (!is_numeric($ipk) || $ipk < 0 || $ipk > 4) {
        $error[] = "IPK harus berupa angka antara 0.00 - 4.00.";
    }
    return $error;
}
?>