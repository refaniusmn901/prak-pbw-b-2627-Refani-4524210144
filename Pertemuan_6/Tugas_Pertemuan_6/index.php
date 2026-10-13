<?php
include "koneksi.php";

// MODIFIKASI: fitur pencarian berdasarkan NIM atau Nama
$cari = trim($_GET['cari'] ?? '');

if ($cari !== '') {
    $like = "%" . $cari . "%";
    $stmt = mysqli_prepare(
        $koneksi,
        "SELECT * FROM mahasiswa WHERE nim LIKE ? OR nama LIKE ? ORDER BY nama ASC"
    );
    mysqli_stmt_bind_param($stmt, "ss", $like, $like);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nama ASC");
}

$total = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Mahasiswa</h2>

        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <a href="create.php"
            class="inline-block bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                + Tambah Mahasiswa
            </a>

            <!-- Form pencarian -->
            <form method="GET" action="index.php" class="flex gap-2">
                <input type="text" name="cari" value="<?= h($cari) ?>"
                    placeholder="Cari NIM / Nama..."
                    class="p-2 border border-gray-300 rounded">
                <button type="submit" class="bg-gray-700 text-white px-4 rounded">Cari</button>
                <?php if ($cari !== '') { ?>
                    <a href="index.php" class="px-3 py-2 text-gray-600 hover:underline">Reset</a>
                <?php } ?>
            </form>
        </div>

        <p class="text-sm text-gray-500 mb-2">Total: <?= $total ?> mahasiswa</p>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 p-3 font-semibold">NIM</th>
                        <th class="border border-gray-200 p-3 font-semibold">Nama</th>
                        <th class="border border-gray-200 p-3 font-semibold">Email</th>
                        <th class="border border-gray-200 p-3 font-semibold">Prodi</th>
                        <th class="border border-gray-200 p-3 font-semibold">Angkatan</th>
                        <th class="border border-gray-200 p-3 font-semibold">IPK</th>
                        <th class="border border-gray-200 p-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($total === 0) { ?>
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    <?php } ?>

                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-200 p-3"><?= h($data['nim']) ?></td>
                            <td class="border border-gray-200 p-3"><?= h($data['nama']) ?></td>
                            <td class="border border-gray-200 p-3"><?= h($data['email']) ?></td>
                            <td class="border border-gray-200 p-3"><?= h($data['prodi']) ?></td>
                            <td class="border border-gray-200 p-3"><?= h($data['angkatan']) ?></td>
                            <td class="border border-gray-200 p-3"><?= number_format((float) $data['ipk'], 2) ?></td>
                            <td class="border border-gray-200 p-3 text-center">
                                <a href="edit.php?nim=<?= urlencode($data['nim']) ?>"
                                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                    Edit
                                </a>
                                <span class="mx-1 text-gray-300">|</span>
                                <a href="delete.php?nim=<?= urlencode($data['nim']) ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-red-600 hover:text-red-800 hover:underline font-medium">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>