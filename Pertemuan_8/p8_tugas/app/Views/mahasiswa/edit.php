<!DOCTYPE html>
<html>
<head>
    <title>Ubah Mahasiswa</title>
</head>
<body>
    <h2>Ubah Mahasiswa</h2>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if ($errors): ?>
        <div style="color:#b00020; border:1px solid #b00020; padding:10px; margin-bottom:15px;">
            <strong>Data belum valid:</strong>
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= esc($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('mahasiswa/update/' . $mhs['id']) ?>" method="post" novalidate>
        <?= csrf_field() ?>

        NIM:
        <input type="text" name="nim" value="<?= esc(old('nim', $mhs['nim'])) ?>">
        <?php if (isset($errors['nim'])): ?><small style="color:#b00020"><?= esc($errors['nim']) ?></small><?php endif; ?>
        <br><br>
        Nama:
        <input type="text" name="nama" value="<?= esc(old('nama', $mhs['nama'])) ?>">
        <?php if (isset($errors['nama'])): ?><small style="color:#b00020"><?= esc($errors['nama']) ?></small><?php endif; ?>
        <br><br>
        Email:
        <input type="email" name="email" value="<?= esc(old('email', $mhs['email'])) ?>">
        <?php if (isset($errors['email'])): ?><small style="color:#b00020"><?= esc($errors['email']) ?></small><?php endif; ?>
        <br><br>
        Prodi:
        <input type="text" name="prodi" value="<?= esc(old('prodi', $mhs['prodi'])) ?>">
        <?php if (isset($errors['prodi'])): ?><small style="color:#b00020"><?= esc($errors['prodi']) ?></small><?php endif; ?>
        <br><br>
        Angkatan:
        <input type="text" name="angkatan" value="<?= esc(old('angkatan', $mhs['angkatan'])) ?>">
        <?php if (isset($errors['angkatan'])): ?><small style="color:#b00020"><?= esc($errors['angkatan']) ?></small><?php endif; ?>
        <br><br>
        IPK:
        <input type="number" name="ipk" step="0.01" value="<?= esc(old('ipk', $mhs['ipk'])) ?>">
        <?php if (isset($errors['ipk'])): ?><small style="color:#b00020"><?= esc($errors['ipk']) ?></small><?php endif; ?>
        <br><br>
        <button type="submit">Perbarui</button>
        <a href="<?= base_url('mahasiswa') ?>">Batal</a>
    </form>
</body>
</html>
