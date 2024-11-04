<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'kasir')) {
    header("Location: login.php");
    exit;
}

// Ambil data pelanggan dari database
$query_pelanggan = "SELECT * FROM pelanggan";
$pelanggan_result = mysqli_query($conn, $query_pelanggan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Data Pelanggan</h2>
        
        <a href="tambah_pelanggan.php" class="btn btn-primary mb-3">Tambah Pelanggan</a>
        
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Kontak HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pelanggan = mysqli_fetch_assoc($pelanggan_result)): ?>
                    <tr>
                        <td><?= $pelanggan['id'] ?></td>
                        <td><?= htmlspecialchars($pelanggan['nama']) ?></td>
                        <td><?= htmlspecialchars($pelanggan['kontak_hp']) ?></td>
                        <td>
                            <a href="edit_pelanggan.php?id=<?= $pelanggan['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_pelanggan.php?id=<?= $pelanggan['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="dashboard_kasir.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
