<?php
include "koneksi.php";

$nim = $_GET['nim'] ?? '';

// MODIFIKASI: SELECT memakai prepared statement
$stmt = mysqli_prepare($koneksi, "SELECT * FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// MODIFIKASI: tangani data yang tidak ditemukan
if (!$data) {
    notif('Data mahasiswa tidak ditemukan', 'index.php');
}

// Jika prodi lama tidak ada di daftar, tetap tampilkan sebagai pilihan
$prodi_list = $daftar_prodi;
if (!in_array($data['prodi'], $prodi_list)) {
    $prodi_list[] = $data['prodi'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Ubah Data <?= h($data['nama']) ?></title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <form action="update.php" method="POST"
        class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md flex flex-col">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Ubah Data <?= h($data['nama']) ?>
        </h2>

        <!-- MODIFIKASI: NIM readonly karena dipakai sebagai kunci WHERE pada UPDATE -->
        <label for="nim" class="text-sm font-semibold mb-1">NIM (tidak dapat diubah):</label>
        <input type="text" id="nim" name="nim" value="<?= h($data['nim']) ?>" readonly
            class="mb-4 p-2 border border-gray-300 rounded bg-gray-100 text-gray-500">

        <label for="nama" class="text-sm font-semibold mb-1">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= h($data['nama']) ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="email" class="text-sm font-semibold mb-1">Email:</label>
        <input type="email" id="email" name="email" value="<?= h($data['email']) ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="prodi" class="text-sm font-semibold mb-1">Prodi:</label>
        <select id="prodi" name="prodi" required
            class="mb-4 p-2 border border-gray-300 rounded">
            <?php foreach ($prodi_list as $p) { ?>
                <option value="<?= h($p) ?>" <?= $p === $data['prodi'] ? 'selected' : '' ?>>
                    <?= h($p) ?>
                </option>
            <?php } ?>
        </select>

        <label for="angkatan" class="text-sm font-semibold mb-1">Angkatan:</label>
        <input type="number" id="angkatan" name="angkatan" min="2000" max="2100"
            value="<?= h($data['angkatan']) ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="ipk" class="text-sm font-semibold mb-1">IPK (0.00 - 4.00):</label>
        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4"
            value="<?= h($data['ipk']) ?>" required
            class="mb-6 p-2 border border-gray-300 rounded">

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 rounded">
            Simpan
        </button>
        <a href="index.php" class="text-center text-sm text-gray-500 mt-3 hover:underline">
            &larr; Kembali ke daftar
        </a>
    </form>
</body>
</html>