# Tugas 1 Praktikum PBW

## 1. Hasil Pengerjaan

Pada tugas ini, program kalkulator sederhana dari materi Pertemuan 1 berhasil dijalankan tanpa error kritis.

Program dapat melakukan operasi:
- Penjumlahan (+)
- Pengurangan (-)
- Perkalian (*)
- Pembagian (/)
- Perpangkatan (^)

Program juga memiliki validasi untuk mencegah pembagian dengan nol.

---

## 2. Modifikasi Program

### Modifikasi 1 — Menambahkan Operasi Pangkat

Program awal hanya menyediakan operasi penjumlahan, pengurangan, perkalian, dan pembagian.

Modifikasi pertama adalah menambahkan operator perpangkatan (`^`).

Contoh:

2 ^ 3 = 8

Penambahan ini dilakukan pada bagian `switch` dan pilihan operator pada form.

### Modifikasi 2 — Menampilkan Perhitungan Lengkap

Program awal hanya menampilkan hasil perhitungan.

Setelah dimodifikasi, program menampilkan proses perhitungannya secara lengkap.

Contoh:

10 + 5 = 15

Dengan demikian pengguna dapat melihat operasi yang dilakukan sekaligus hasilnya.

---

## 3. Screenshot Sebelum Modifikasi

![Kode Awal](screenshot/1.%20kode%20awal.png)
![Output Awal Berhasil](screenshot/2.\%20output%20awal%20berhasil.png)
---

## 4. Screenshot Sesudah Modifikasi

![Modifikasi 1](screenshot/3.%20modifikasi%201.png)

![Hasil Modifikasi 1](screenshot/4.%20hasil%20modifikasi%201.png)

![Modifikasi 2](screenshot/5.%20modifikasi%202.png)

![Hasil Modifikasi 2](screenshot/6.%20hasil%20modifikasi%202.png)
---

## 5. Penjelasan 5 Bagian Kode Penting

### 1. Variabel

Variabel `$hasil` digunakan untuk menyimpan hasil perhitungan, sedangkan `$pesan` digunakan untuk menyimpan pesan kesalahan.

### 2. Method POST

`$_SERVER['REQUEST_METHOD'] === 'POST'` digunakan untuk memastikan proses kalkulator dijalankan ketika form dikirim menggunakan method POST.

### 3. Pengambilan Input

`$_POST` digunakan untuk mengambil nilai angka pertama, angka kedua, dan operator yang dipilih oleh pengguna.

### 4. Switch Case

`switch` digunakan untuk menentukan operasi matematika berdasarkan operator yang dipilih, seperti penjumlahan, pengurangan, perkalian, pembagian, dan perpangkatan.

### 5. Output

Bagian output digunakan untuk menampilkan pesan kesalahan atau hasil perhitungan kepada pengguna. Setelah modifikasi, program juga menampilkan bentuk perhitungan lengkap.

---

## 6. Error yang Pernah Muncul

### Error

Perubahan kode yang sudah dilakukan tidak muncul pada hasil program setelah dijalankan.

### Penyebab

File PHP yang diedit berbeda dengan file PHP yang sedang dijalankan pada browser. Akibatnya, perubahan pada kode tidak terlihat pada halaman program.

### Perbaikan

Memeriksa kembali nama dan lokasi file PHP yang sedang dibuka di VS Code dan memastikan file tersebut sama dengan file yang dijalankan melalui browser. Setelah membuka file yang benar dan menyimpan perubahan, program dijalankan kembali dan hasil modifikasi berhasil ditampilkan.

---

## 7. Kesimpulan

Program kalkulator sederhana berhasil dijalankan dan dimodifikasi dengan menambahkan operasi perpangkatan serta menampilkan perhitungan secara lengkap. Modifikasi tersebut membuat program memiliki fungsi tambahan dibandingkan program awal.