<?php
session_start();
include 'koneksi.php'; // Menghubungkan ke database

// Query untuk mengambil data riwayat transaksi dengan join ke tabel pelanggan dan layanan
$query = "SELECT t.*, p.nama AS nama_pelanggan, l.nama_layanan, t.tanggal_transaksi 
          FROM transaksi t 
          JOIN pelanggan p ON t.id_pelanggan = p.id 
          JOIN layanan l ON t.layanan_id = l.id 
          ORDER BY t.id DESC";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Tampilkan pesan error jika query gagal
if (!$result) {
    echo "Query Error: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
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

    <div class="container mt-5">
        <h2 class="text-center">Riwayat Transaksi Lengkap</h2>

        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <!-- <th>Nama Pelanggan</th> -->
                    <th>Layanan</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <!-- <td><?= $row['id']; ?></td> -->
                    <td><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['nama_layanan']; ?></td>
                    <td><?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= $row['tanggal_transaksi']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
