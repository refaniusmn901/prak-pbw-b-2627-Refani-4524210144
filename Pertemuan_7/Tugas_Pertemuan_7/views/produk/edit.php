<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Ubah Produk <?= h($data['nama_produk']) ?></title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <form action="index.php?aksi=update" method="POST"
        class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md flex flex-col">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Ubah Produk</h2>

        <input type="hidden" name="id" value="<?= (int) $data['id'] ?>">

        <label for="nama_produk" class="text-sm font-semibold mb-1">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk"
            value="<?= h($data['nama_produk']) ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="harga" class="text-sm font-semibold mb-1">Harga (Rp):</label>
        <input type="number" id="harga" name="harga" min="0"
            value="<?= h($data['harga']) ?>" required
            class="mb-4 p-2 border border-gray-300 rounded">

        <label for="stok" class="text-sm font-semibold mb-1">Stok:</label>
        <input type="number" id="stok" name="stok" min="0"
            value="<?= h($data['stok']) ?>" required
            class="mb-6 p-2 border border-gray-300 rounded">

        <button type="submit" class="bg-blue-600 text-white font-bold py-2 rounded">
            Simpan Perubahan
        </button>
        <a href="index.php" class="text-center text-sm text-gray-500 mt-3 hover:underline">
            &larr; Kembali ke daftar
        </a>
    </form>
</body>
</html>