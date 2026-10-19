<?php
require_once __DIR__ . '/../models/ProdukModel.php';

class ProdukController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new ProdukModel($koneksi);
    }

    public function index()
    {
        $produk = $this->model->getAll();
        $pesan  = $_GET['pesan'] ?? '';
        include __DIR__ . '/../views/produk/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/produk/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit;
        }

        $nama  = trim($_POST['nama_produk'] ?? '');
        $harga = trim($_POST['harga'] ?? '');
        $stok  = trim($_POST['stok'] ?? '');

        $this->validasi($nama, $harga, $stok);

        if ($this->model->insert($nama, (int) $harga, (int) $stok)) {
            header("Location: index.php?pesan=tambah");
        } else {
            $this->notif("Data gagal disimpan");
        }
        exit;
    }

    public function edit()
    {
        $id   = (int) ($_GET['id'] ?? 0);
        $data = $this->model->getById($id);

        if (!$data) {
            $this->notif("Data produk tidak ditemukan", "index.php");
        }

        include __DIR__ . '/../views/produk/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit;
        }

        $id    = (int) ($_POST['id'] ?? 0);
        $nama  = trim($_POST['nama_produk'] ?? '');
        $harga = trim($_POST['harga'] ?? '');
        $stok  = trim($_POST['stok'] ?? '');

        $this->validasi($nama, $harga, $stok);

        if ($this->model->update($id, $nama, (int) $harga, (int) $stok)) {
            header("Location: index.php?pesan=ubah");
        } else {
            $this->notif("Data gagal diupdate");
        }
        exit;
    }

    private function validasi($nama, $harga, $stok)
    {
        $error = [];
        if ($nama === '') {
            $error[] = "Nama produk tidak boleh kosong.";
        }
        if (!ctype_digit($harga)) {
            $error[] = "Harga harus berupa angka (tidak negatif).";
        }
        if (!ctype_digit($stok)) {
            $error[] = "Stok harus berupa angka (tidak negatif).";
        }
        if (!empty($error)) {
            $this->notif("Data tidak valid:\n- " . implode("\n- ", $error));
        }
    }

    private function notif($pesan, $tujuan = null)
    {
        $js = json_encode($pesan);
        if ($tujuan) {
            echo "<script>alert($js); window.location.href = '$tujuan';</script>";
        } else {
            echo "<script>alert($js); window.history.back();</script>";
        }
        exit;
    }
}
?>