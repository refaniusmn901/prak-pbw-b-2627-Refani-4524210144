<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h3>Data Mahasiswa</h3>
        <a 
          href="<?= base_url('mahasiswa/tambah'); ?>"
          class="btn btn-primary"
        >
          Tambah Mahasiswa
        </a>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>NO</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>IPK</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($mahasiswa as $mhs):
          ?>
          <tr>
            <td>
              <?= $no++; ?>
            </td>
            <td>
              <?= esc($mhs['nim']); ?>
            </td>
            <td>
              <?= esc($mhs['nama']); ?>
            </td>
            <td>
              <?= esc($mhs['prodi']); ?>
            </td>
            <td>
              <?= esc($mhs['ipk']); ?>
            </td>
            <td>
              <a class="btn btn-warning btn-sm" href="<?= base_url('mahasiswa/edit/'.$mhs['id']); ?>">Edit</a>
              <a class="btn btn-danger btn-sm" href="<?= base_url('mahasiswa/delete/'.$mhs['id']); ?>">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>