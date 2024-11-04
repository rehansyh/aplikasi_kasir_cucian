<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'owner') {
    header("Location: login.php");
    exit;
}

// Tambah promo baru
if (isset($_POST['add_promo'])) {
    $nama_promo = mysqli_real_escape_string($conn, $_POST['nama_promo']);
    $diskon = mysqli_real_escape_string($conn, $_POST['diskon']);
    $tgl_mulai = mysqli_real_escape_string($conn, $_POST['tgl_mulai']);
    $tgl_selesai = mysqli_real_escape_string($conn, $_POST['tgl_selesai']);
    mysqli_query($conn, "INSERT INTO promo (nama_promo, diskon, tgl_mulai, tgl_selesai) 
                         VALUES ('$nama_promo', '$diskon', '$tgl_mulai', '$tgl_selesai')");
}

// Tampilkan daftar promo
$promo = mysqli_query($conn, "SELECT * FROM promo WHERE NOW() BETWEEN tgl_mulai AND tgl_selesai");

echo "<h3>Promo Saat Ini</h3><table border='1'>
        <tr><th>Nama Promo</th><th>Diskon</th><th>Periode</th></tr>";
while ($row = mysqli_fetch_assoc($promo)) {
    echo "<tr><td>{$row['nama_promo']}</td><td>{$row['diskon']}%</td><td>{$row['tgl_mulai']} - {$row['tgl_selesai']}</td></tr>";
}
echo "</table>";
?>

<h3>Tambah Promo Baru</h3>
<form method="POST" action="">
    <input type="text" name="nama_promo" placeholder="Nama Promo" required>
    <input type="number" name="diskon" placeholder="Diskon (%)" required>
    <input type="date" name="tgl_mulai" required>
    <input type="date" name="tgl_selesai" required>
    <button type="submit" name="add_promo">Tambah Promo</button>
</form>
