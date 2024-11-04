<?php
session_start();
include 'koneksi.php';

// Cek apakah form laporan harian sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    
    // Query untuk mendapatkan transaksi pada tanggal yang dipilih
    $query = "SELECT t.*, p.nama AS nama_pelanggan, l.nama_layanan 
              FROM transaksi t 
              JOIN pelanggan p ON t.id_pelanggan = p.id 
              JOIN layanan l ON t.layanan_id = l.id 
              WHERE DATE(t.tanggal_transaksi) = '$tanggal' 
              ORDER BY t.id DESC";

    $result = mysqli_query($conn, $query);

    // Cek apakah query berhasil
    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }
    
    $transaksi_count = mysqli_num_rows($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table-custom th {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
        }
        .table-custom tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table-custom {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
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
        <h2 class="text-center">Laporan Harian</h2>

        <form method="POST" action="" class="form-inline justify-content-center mb-4">
            <div class="form-group mr-2">
                <label for="tanggal" class="sr-only">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
        </form>

        <?php if (isset($transaksi_count) && $transaksi_count > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-custom mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Layanan</th>
                            <th>Total Harga</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($transaksi = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($transaksi['id']); ?></td>
                                <td><?= htmlspecialchars($transaksi['nama_pelanggan']); ?></td>
                                <td><?= htmlspecialchars($transaksi['nama_layanan']); ?></td>
                                <td>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.'); ?></td>
                                <td><?= date("d-m-Y", strtotime($transaksi['tanggal_transaksi'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif (isset($transaksi_count)): ?>
            <div class="alert alert-warning text-center">Tidak ada transaksi untuk tanggal tersebut.</div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
