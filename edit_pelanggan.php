<?php
session_start();
include 'koneksi.php';

// Pastikan hanya pengguna dengan role 'kasir' atau 'owner' yang bisa mengedit data
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'kasir' && $_SESSION['role'] !== 'owner')) {
    header("Location: login.php");
    exit;
}

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Ambil data pelanggan berdasarkan ID
    $query = "SELECT * FROM pelanggan WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $pelanggan = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['message'] = "Pelanggan tidak ditemukan.";
        header("Location: data_pelanggan.php");
        exit;
    }
} else {
    $_SESSION['message'] = "ID pelanggan tidak valid.";
    header("Location: data_pelanggan.php");
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kontak_hp = mysqli_real_escape_string($conn, $_POST['kontak_hp']);
    
    // Update data pelanggan
    $query_update = "UPDATE pelanggan SET nama = '$nama', kontak_hp = '$kontak_hp' WHERE id = '$id'";
    if (mysqli_query($conn, $query_update)) {
        $_SESSION['message'] = "Data pelanggan berhasil diperbarui.";
        header("Location: data_pelanggan.php");
        exit;
    } else {
        $error = "Terjadi kesalahan saat memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Pelanggan</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($pelanggan['nama']) ?>" required>
            </div>

            <div class="form-group">
                <label for="kontak_hp">Kontak HP</label>
                <input type="text" class="form-control" id="kontak_hp" name="kontak_hp" value="<?= htmlspecialchars($pelanggan['kontak_hp']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
            <a href="data_pelanggan.php" class="btn btn-secondary btn-block">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
