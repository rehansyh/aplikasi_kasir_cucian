<?php
include 'koneksi.php'; // Koneksi ke database

if (isset($_GET['kategori'])) {
    $kategori = mysqli_real_escape_string($conn, $_GET['kategori']);
    $query = "SELECT id, nama_layanan, harga FROM layanan WHERE kategori = '$kategori'";
    $result = mysqli_query($conn, $query);

    $layanan = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $layanan[] = $row;
    }

    // Mengembalikan data layanan dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($layanan);
}
?>
