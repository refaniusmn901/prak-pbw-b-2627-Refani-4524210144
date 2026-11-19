<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h3>Tambah Mahasiswa</h3>
    <form 
      action="<?= base_url('mahasiswa/simpan') ?>"
      method="post"
    >
      <?= csrf_field(); ?>
      <div mb-3>
        <label class="form-label">
          NIM
        </label>
        <input 
          type="text"
          name="nim"
          class="form-control"
          required
        >
      </div>
      <div mb-3>
        <label class="form-label">
          Nama
        </label>
        <input 
          type="text"
          name="nama"
          class="form-control"
          required
        >
      </div>
      <div mb-3>
        <label class="form-label">
          Prodi
        </label>
        <input 
          type="text"
          name="prodi"
          class="form-control"
          required
        >
      </div>
      <div mb-3>
        <label class="form-label">
          IPK
        </label>
        <input 
          type="text"
          name="ipk"
          class="form-control"
          required
        >
      </div>
      <button
        type="submit"
        class="btn btn-primary"
      >
        Simpan
      </button>
      <a 
        class="btn btn-secondary"
        href="<?= base_url('mahasiswa') ?>"
      >
        Kembali
      </a>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
  </script>
</body>
</html>