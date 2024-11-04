<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'kasir') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; // Menghubungkan ke database

// Cek apakah ID layanan ada di URL
if (isset($_GET['id'])) {
    $id_layanan = mysqli_real_escape_string($conn, $_GET['id']);

    // Ambil data layanan dari database
    $query_layanan = "SELECT * FROM layanan WHERE id = '$id_layanan'";
    $layanan_result = mysqli_query($conn, $query_layanan);
    
    // Pastikan layanan ditemukan
    if (mysqli_num_rows($layanan_result) == 1) {
        $layanan = mysqli_fetch_assoc($layanan_result);
    } else {
        header("Location: dashboard_layanan.php"); // Jika tidak ditemukan, kembali ke daftar layanan
        exit;
    }
} else {
    header("Location: dashboard_layanan.php"); // Jika tidak ada ID, kembali ke daftar layanan
    exit;
}

// Menangani pembaruan layanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_layanan = mysqli_real_escape_string($conn, $_POST['nama_layanan']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);

    // Update data layanan
    $query_update = "UPDATE layanan SET nama_layanan = '$nama_layanan', harga = '$harga' WHERE id = '$id_layanan'";
    if (mysqli_query($conn, $query_update)) {
        header("Location: dashboard_layanan.php"); // Redirect ke daftar layanan setelah berhasil
        exit;
    } else {
        $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layanan - TP94 Carwash & Bike</title>
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
        <h2 class="text-center">Edit Layanan</h2>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="<?= $layanan['nama_layanan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= $layanan['harga']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Layanan</button>
            <a href="dashboard_layanan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
