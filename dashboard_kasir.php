<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'kasir') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - TP94 Carwash & Bike</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard_kasir.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Dashboard Kasir</h2>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Input Transaksi</div>
                    <div class="card-body">
                        <p class="card-text">Mulai transaksi baru untuk layanan cuci atau pembelian produk.</p>
                        <a href="transaksi.php" class="btn btn-light btn-block">Tambah Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Riwayat Transaksi</div>
                    <div class="card-body">
                        <p class="card-text">Lihat riwayat transaksi yang telah dilakukan hari ini.</p>
                        <a href="riwayat_transaksi.php" class="btn btn-light btn-block">Lihat Riwayat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Data Pelanggan</div>
                    <div class="card-body">
                        <p class="card-text">Lihat atau tambahkan<br> data pelanggan baru.</p>
                        <a href="data_pelanggan.php" class="btn btn-light btn-block">Kelola Pelanggan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info text-white">Kelola Layanan</div>
                    <div class="card-body">
                        <p>Tambahkan, edit, atau hapus layanan dan produk.</p>

                        <a href="dashboard_layanan.php" class="btn btn-dark">Kelola Layanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">Laporan Harian</div>
                    <div class="card-body">
                        <p>Lihat laporan transaksi dan pemasukan harian.</p>
                        <a href="laporan_harian.php" class="btn btn-dark">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">Profil Kasir</div>
                    <div class="card-body">
                        <p>Update informasi profil kasir atau ubah password.</p>
                        <a href="profil_kasir.php" class="btn btn-dark">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
