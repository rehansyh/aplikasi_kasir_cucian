<?php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    header("Location: login.php");
    exit;
}
// // Menghitung total transaksi hari ini
// $date_today = date('Y-m-d');
// $query = $pdo->prepare("SELECT SUM(amount) AS total_harian FROM transaksi WHERE DATE(transaction_date) = :today");
// $query->execute(['today' => $date_today]);
// $result = $query->fetch(PDO::FETCH_ASSOC);
// $total_harian = $result['total_harian'] ?? 0; // Jika tidak ada transaksi, tampilkan 0
// ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo Usaha" width="40" height="40" class="d-inline-block align-top" style="margin-right: 10px;">
            TP94 Carwash & Bike
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard_owner.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Dashboard Owner</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Transaksi Hari Ini</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp 1,200,000</h5>
                        <p class="card-text">Total pemasukan dari transaksi hari ini.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Jumlah Pelanggan</div>
                    <div class="card-body">
                        <h5 class="card-title">50</h5>
                        <p class="card-text">Total pelanggan yang terdaftar.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Laporan Pendapatan</div>
                    <div class="card-body">
                        <p>Pilih jenis laporan yang ingin ditampilkan:</p>
                        <div class="btn-group" role="group" aria-label="Laporan Pendapatan">
                            <a href="laporan_harian.php" class="btn btn-primary">Harian</a>
                            <a href="laporan_mingguan.php" class="btn btn-info">Mingguan</a>
                            <a href="laporan_bulanan.php" class="btn btn-secondary">Bulanan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Data Pegawai</div>
                    <div class="card-body">
                        <p>Kelola data pegawai yang terdaftar di sistem.</p>
                        <a href="data_pegawai.php" class="btn btn-dark">Kelola Pegawai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
