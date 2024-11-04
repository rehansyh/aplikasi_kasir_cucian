<?php
session_start();
include 'koneksi.php'; // Menghubungkan ke database

// Ambil data layanan berdasarkan kategori
$query_layanan = "SELECT * FROM layanan ORDER BY kategori";
$layanan_result = mysqli_query($conn, $query_layanan);

// Cek apakah form transaksi sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses penambahan transaksi sama seperti sebelumnya
    if (!empty($_POST['nama_pelanggan']) && !empty($_POST['kontak_hp'])) {
        $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
        $kontak_hp = mysqli_real_escape_string($conn, $_POST['kontak_hp']);
        
        $query_pelanggan = "INSERT INTO pelanggan (nama, kontak_hp) VALUES ('$nama_pelanggan', '$kontak_hp')";
        mysqli_query($conn, $query_pelanggan);
        
        $id_pelanggan = mysqli_insert_id($conn);
    } else {
        $id_pelanggan = mysqli_real_escape_string($conn, $_POST['id_pelanggan']);
    }
    
    $layanan_ids = $_POST['layanan_ids'];
    $total_harga = 0;
    
    foreach ($layanan_ids as $layanan_id) {
        $layanan_id = mysqli_real_escape_string($conn, $layanan_id);
        $query_harga = "SELECT harga FROM layanan WHERE id = '$layanan_id'";
        $result_harga = mysqli_query($conn, $query_harga);
        $harga_layanan = mysqli_fetch_assoc($result_harga)['harga'];
        $total_harga += $harga_layanan;
        
        $query_transaksi = "INSERT INTO transaksi (id_pelanggan, layanan_id, total_harga) VALUES ('$id_pelanggan', '$layanan_id', '$harga_layanan')";
        mysqli_query($conn, $query_transaksi);
    }
    
    $message = "Transaksi berhasil! Total Harga: Rp " . number_format($total_harga, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - TP94 Carwash & Bike</title>
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

<div class="container mt-2">
    <h2 class="text-center">Transaksi Cuci Mobil & Motor</h2>
    
    <?php if (isset($message)): ?>
        <div class="alert alert-info text-center"><?= $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="id_pelanggan">Pelanggan</label>
            <select class="form-control" id="id_pelanggan" name="id_pelanggan">
                <option value="">Pilih Pelanggan</option>
                <?php
                $query_pelanggan = "SELECT * FROM pelanggan";
                $pelanggan_result = mysqli_query($conn, $query_pelanggan);
                while ($pelanggan = mysqli_fetch_assoc($pelanggan_result)) {
                    echo "<option value='{$pelanggan['id']}'>{$pelanggan['nama']} - {$pelanggan['kontak_hp']}</option>";
                }
                ?>
            </select>
            <small class="form-text text-muted">Atau, tambahkan pelanggan baru di bawah.</small>
        </div>

        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Pelanggan">
        </div>

        <div class="form-group">
            <label for="kontak_hp">Kontak HP</label>
            <input type="text" class="form-control" id="kontak_hp" name="kontak_hp" placeholder="Kontak HP">
        </div>

        <!-- <div class="container mt-2">
    <h2 class="text-center">Transaksi Cuci Mobil & Motor</h2> -->
    
    <?php if (isset($message)): ?>
        <div class="alert alert-info text-center"><?= $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <!-- Form untuk memilih pelanggan atau menambah pelanggan baru seperti sebelumnya -->
        
        <!-- Dropdown kategori layanan -->
        <div class="form-group">
            <label for="kategori">Kategori Layanan</label>
            <select class="form-control" id="kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                <?php
                // Ambil daftar kategori unik dari layanan
                $query_kategori = "SELECT DISTINCT kategori FROM layanan";
                $kategori_result = mysqli_query($conn, $query_kategori);
                while ($kategori = mysqli_fetch_assoc($kategori_result)) {
                    echo "<option value='{$kategori['kategori']}'>{$kategori['kategori']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Dropdown layanan yang akan diisi berdasarkan kategori -->
        <div class="form-group">
            <label for="layanan_id">Layanan</label>
            <select class="form-control" id="layanan_id" name="layanan_ids[]" required>
                <option value="">Pilih Layanan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-3">Simpan Transaksi</button>
    </form>
</div>

<script>
document.getElementById('kategori').addEventListener('change', function() {
    const kategori = this.value;
    const layananDropdown = document.getElementById('layanan_id');

    // Hapus opsi layanan yang ada sebelumnya
    layananDropdown.innerHTML = '<option value="">Pilih Layanan</option>';

    if (kategori) {
        // Lakukan permintaan AJAX ke server untuk mendapatkan layanan berdasarkan kategori
        fetch(`get_layanan.php?kategori=${kategori}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(layanan => {
                    let option = document.createElement('option');
                    option.value = layanan.id;
                    option.textContent = `${layanan.nama_layanan} - Rp ${layanan.harga}`;
                    layananDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>

</body>
</html>
