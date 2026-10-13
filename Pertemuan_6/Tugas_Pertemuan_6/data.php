<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

while ($data = mysqli_fetch_assoc($query)) {
    echo h($data['nim']);
    echo " - ";
    echo h($data['nama']);
    echo "<br>";
}
?>