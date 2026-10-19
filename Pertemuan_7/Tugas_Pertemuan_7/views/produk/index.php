<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Daftar Produk</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Produk</h2>

        <?php if ($pesan === 'tambah') { ?>
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">Produk berhasil ditambahkan.</div>
        <?php } elseif ($pesan === 'ubah') { ?>
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">Produk berhasil diubah.</div>
        <?php } ?>

        <a href="index.php?aksi=create"
            class="inline-block bg-blue-600 text-white font-semibold px-4 py-2 rounded mb-4">
            + Tambah Produk
        </a>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 p-3 font-semibold">No</th>
                        <th class="border border-gray-200 p-3 font-semibold">Nama Produk</th>
                        <th class="border border-gray-200 p-3 font-semibold">Harga</th>
                        <th class="border border-gray-200 p-3 font-semibold">Stok</th>
                        <th class="border border-gray-200 p-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produk)) { ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data produk.</td>
                        </tr>
                    <?php } ?>

                    <?php foreach ($produk as $no => $p) { ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-200 p-3"><?= $no + 1 ?></td>
                            <td class="border border-gray-200 p-3"><?= h($p['nama_produk']) ?></td>
                            <td class="border border-gray-200 p-3">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            <td class="border border-gray-200 p-3"><?= h($p['stok']) ?></td>
                            <td class="border border-gray-200 p-3 text-center">
                                <a href="index.php?aksi=edit&id=<?= (int) $p['id'] ?>"
                                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                    Edit
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