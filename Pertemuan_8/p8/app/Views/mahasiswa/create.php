
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h2>Tambah Mahasiswa</h2>

    <form action="/mahasiswa/simpan" method="post">
        NIM:
        <input type="text" name="nim" required>
        <br><br>

        Nama:
        <input type="text" name="nama" required>
        <br><br>

        Program Studi:
        <input type="text" name="prodi" required>
        <br><br>

        IPK:
        <input type="number" name="ipk"
               step="0.01" min="0" max="4" required>
        <br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
