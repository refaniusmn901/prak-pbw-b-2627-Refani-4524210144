
Form · PHP
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            padding: 40px 16px;
        }
        .card {
            background: #fff;
            padding: 28px 32px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            width: 100%;
            max-width: 420px;
        }
        h2 { margin-top: 0; text-align: center; color: #1f3a5f; }
        label { display: block; margin: 14px 0 4px; font-weight: bold; font-size: 14px; }
        input, select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #b8c2cc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input:focus, select:focus { outline: none; border-color: #2d6cdf; }
        button {
            margin-top: 22px;
            width: 100%;
            padding: 10px;
            background: #2d6cdf;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover { background: #1f55b8; }
        small { color: #6b7785; }
    </style>
</head>
<body>
<div class="card">
    <h2>Form Data Mahasiswa</h2>
 
    <form action="simpan.php" method="post">
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" required>
 
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
 
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
 
        <label for="prodi">Prodi</label>
    
        <select id="prodi" name="prodi" required>
            <option value="">-- Pilih Prodi --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Elektro">Teknik Elektro</option>
            <option value="Manajemen">Manajemen</option>
            <option value="Akuntansi">Akuntansi</option>
        </select>
 
        <label for="angkatan">Angkatan</label>
        
        <input type="number" id="angkatan" name="angkatan" min="2000" max="2100" required>
 
        <label for="ipk">IPK <small>(0.00 - 4.00)</small></label>

        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4" required>
 
        <button type="submit">Simpan</button>
    </form>
</div>
</body>
</html>
