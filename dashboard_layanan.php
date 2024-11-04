<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'kasir') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; // Menghubungkan ke database

// Menangani penambahan layanan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_layanan'])) {
    $nama_layanan = mysqli_real_escape_string($conn, $_POST['nama_layanan']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);

    $query_tambah = "INSERT INTO layanan (nama_layanan, harga) VALUES ('$nama_layanan', '$harga')";
    mysqli_query($conn, $query_tambah);
}

// Menangani penghapusan layanan
if (isset($_GET['hapus'])) {
    $id_layanan = mysqli_real_escape_string($conn, $_GET['hapus']);
    $query_hapus = "DELETE FROM layanan WHERE id = '$id_layanan'";
    mysqli_query($conn, $query_hapus);
}

// Ambil data layanan dari database
$query_layanan = "SELECT * FROM layanan";
$layanan_result = mysqli_query($conn, $query_layanan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TP94 Carwash & Bike</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_kasir.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Kelola Layanan dan Produk</h2>
        <br>
        
        <div class="card mb-4">
    <div class="card-header">Tambah Layanan</div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Produk">Mobil</option>
                    <option value="Produk">Motor</option>
                    <option value="Produk">Kursi Pijat</option>
                    <option value="Produk">Karpet</option>
                    <!-- Tambahkan kategori lain sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <button type="submit" name="tambah_layanan" class="btn btn-primary">Tambah Layanan</button>
        </form>
    </div>
</div>

        <div class="card">
            <div class="card-header">Daftar Layanan</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Layanan</th>
                            <th>Harga (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($layanan = mysqli_fetch_assoc($layanan_result)): ?>
                        <tr>
                            <td><?= $layanan['id']; ?></td>
                            <td><?= $layanan['nama_layanan']; ?></td>
                            <td><?= number_format($layanan['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="edit_layanan.php?id=<?= $layanan['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?hapus=<?= $layanan['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
