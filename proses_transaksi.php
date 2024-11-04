<?php
include 'koneksi.php';

if (isset($_POST['transaksi'])) {
    $pelanggan_id = $_POST['pelanggan_id'];
    $layanan = $_POST['layanan'];

    // Insert transaksi ke tabel transaksi
    $query_transaksi = "INSERT INTO transaksi (pelanggan_id, tanggal, total) VALUES ('$pelanggan_id', NOW(), 0)";
    mysqli_query($conn, $query_transaksi);
    $transaksi_id = mysqli_insert_id($conn);

    $total = 0;

    // Insert layanan/item ke detail transaksi
    foreach ($layanan as $layanan_id) {
        $result = mysqli_query($conn, "SELECT * FROM layanan WHERE id = $layanan_id");
        $data = mysqli_fetch_assoc($result);
        $harga = $data['harga'];

        $query_detail = "INSERT INTO detail_transaksi (transaksi_id, layanan_id, harga) VALUES ('$transaksi_id', '$layanan_id', '$harga')";
        mysqli_query($conn, $query_detail);
        $total += $harga;
    }

    // Update total transaksi
    mysqli_query($conn, "UPDATE transaksi SET total = $total WHERE id = $transaksi_id");

    header("Location: struk.php?id=$transaksi_id");
}
?>
