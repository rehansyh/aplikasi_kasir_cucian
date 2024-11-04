<?php
session_start();
include 'koneksi.php';

// Pastikan hanya pengguna dengan role 'kasir' yang bisa mengakses halaman ini
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'kasir') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data kasir berdasarkan ID
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) === 1) {
    $kasir = mysqli_fetch_assoc($result);
} else {
    $_SESSION['message'] = "Data kasir tidak ditemukan.";
    header("Location: dashboard_kasir.php");
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kontak_hp = mysqli_real_escape_string($conn, $_POST['kontak_hp']);
    
    // Update data kasir
    $query_update = "UPDATE users SET nama = '$nama', kontak_hp = '$kontak_hp' WHERE id = '$user_id'";
    if (mysqli_query($conn, $query_update)) {
        $_SESSION['message'] = "Profil berhasil diperbarui.";
        header("Location: profil_kasir.php");
        exit;
    } else {
        $error = "Terjadi kesalahan saat memperbarui profil: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kasir - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Profil Kasir</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($kasir['nama']) ?>" required>
            </div>

            <div class="form-group">
                <label for="kontak_hp">Kontak HP</label>
                <input type="text" class="form-control" id="kontak_hp" name="kontak_hp" value="<?= htmlspecialchars($kasir['kontak_hp']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
            <a href="dashboard_kasir.php" class="btn btn-secondary btn-block">Kembali ke Dashboard</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
