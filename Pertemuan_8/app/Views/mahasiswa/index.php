
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>

    <a href="/mahasiswa/tambah">Tambah Mahasiswa</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>IPK</th>
        </tr>

        <?php foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= esc($mhs['nim']); ?></td>
            <td><?= esc($mhs['nama']); ?></td>
            <td><?= esc($mhs['prodi']); ?></td>
            <td><?= esc($mhs['ipk']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
