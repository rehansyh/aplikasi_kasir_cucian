<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'kasir') {
    header("Location: login.php");
    exit;
}

// Tambah produk baru
if (isset($_POST['add_product'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    mysqli_query($conn, "INSERT INTO produk (nama, harga) VALUES ('$nama', '$harga')");
}

// Tampilkan daftar produk
$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<h3>Daftar Produk</h3>
<table border="1">
    <tr>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
        <tr>
            <td><?= $row['nama']; ?></td>
            <td>Rp <?= $row['harga']; ?></td>
            <td><a href="hapus_produk.php?id=<?= $row['id']; ?>">Hapus</a></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Tambah Produk Baru</h3>
<form method="POST" action="">
    <input type="text" name="nama" placeholder="Nama Produk" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <button type="submit" name="add_product">Tambah Produk</button>
</form>
