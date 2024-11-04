<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'kasir') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; // Menghubungkan ke database

// Cek apakah ID pelanggan ada di URL
if (isset($_GET['id'])) {
    $id_pelanggan = mysqli_real_escape_string($conn, $_GET['id']);

    // Ambil data pelanggan dari database untuk konfirmasi
    $query_pelanggan = "SELECT * FROM pelanggan WHERE id = '$id_pelanggan'";
    $pelanggan_result = mysqli_query($conn, $query_pelanggan);
    
    // Pastikan pelanggan ditemukan
    if (mysqli_num_rows($pelanggan_result) == 1) {
        $pelanggan = mysqli_fetch_assoc($pelanggan_result);
    } else {
        header("Location: data_pelanggan.php"); // Jika tidak ditemukan, kembali ke daftar pelanggan
        exit;
    }

    // Menangani penghapusan pelanggan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Hapus transaksi terkait
        $query_delete_transaksi = "DELETE FROM transaksi WHERE id_pelanggan = '$id_pelanggan'";
        mysqli_query($conn, $query_delete_transaksi);

        // Hapus pelanggan
        $query_delete = "DELETE FROM pelanggan WHERE id = '$id_pelanggan'";
        if (mysqli_query($conn, $query_delete)) {
            header("Location: data_pelanggan.php"); // Redirect ke daftar pelanggan setelah berhasil dihapus
            exit;
        } else {
            $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: data_pelanggan.php"); // Jika tidak ada ID, kembali ke daftar pelanggan
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Pelanggan - TP94 Carwash & Bike</title>
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
        <h2 class="text-center">Hapus Pelanggan</h2>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message; ?></div>
        <?php endif; ?>

        <div class="alert alert-warning">
            <strong>Perhatian!</strong> Anda akan menghapus pelanggan berikut:
            <p><strong>Nama Pelanggan:</strong> <?= $pelanggan['nama']; ?></p>
            <p><strong>Kontak HP:</strong> <?= $pelanggan['kontak_hp']; ?></p>
            <form method="POST" action="">
                <button type="submit" class="btn btn-danger">Hapus Pelanggan</button>
                <a href="data_pelanggan.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
