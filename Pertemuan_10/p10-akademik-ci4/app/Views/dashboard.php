<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Akademik</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
      <a 
        class="navbar-brand"
        href="<?= base_url('/') ?>"
      >
        Sistem Akademik
      </a>
      <button 
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#menu"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div
        class="collapse navbar-collapse"
        id="menu"
      >
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a 
              class="nav-link"
              href="<?= base_url('mahasiswa') ?>"
            >
              Mahasiswa
            </a>
          </li>
          <li class="nav-item">
            <a 
              class="nav-link"
              href="#"
            >
              Dosen
            </a>
          </li>
          <li class="nav-item">
            <a 
              class="nav-link"
              href="#"
            >
              Mata Kuliah
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-4">
    <h1>
      Sistem Akademik
    </h1>
    <div class="container mt-4">
      <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card shadow-md">
            <div class="card-body">
              <h5 class="card-title">Mahasiswa</h5>
              <h2>
                <?= $jumlahMahasiswa; ?>
              </h2>
              <p class="card-text">Total Mahasiswa</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card shadow-md">
            <div class="card-body">
              <h5 class="card-title">Dosen</h5>
              <h2>
                <?= $jumlahDosen; ?>
              </h2>
              <p class="card-text">Total Dosen</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card shadow-md">
            <div class="card-body">
              <h5 class="card-title">Mata Kuliah</h5>
              <h2>
                <?= $jumlahMK; ?>
              </h2>
              <p class="card-text">Total Mata Kuliah</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card shadow-md">
            <div class="card-body">
              <h5 class="card-title">KRS</h5>
              <h2>
                <?= $jumlahKRS; ?>
              </h2>
              <p class="card-text">Total KRS</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
  </script>
</body>
</html>
