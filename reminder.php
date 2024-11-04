<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'owner') {
    header("Location: login.php");
    exit;
}

// Kirim pesan ke pelanggan yang sering menggunakan layanan
$query = "SELECT pelanggan.id, pelanggan.nama, pelanggan.email, COUNT(transaksi.id) as total_transaksi 
          FROM pelanggan 
          JOIN transaksi ON transaksi.pelanggan_id = pelanggan.id 
          GROUP BY pelanggan.id HAVING total_transaksi > 5"; // Pelanggan yang lebih dari 5 kali transaksi
$pelanggan_setia = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($pelanggan_setia)) {
    $pesan = "Terima kasih, {$row['nama']}! Anda telah melakukan lebih dari 5 transaksi. Dapatkan diskon 10% untuk layanan berikutnya.";
    // Kirim email atau SMS (Integrasi API layanan pengiriman pesan dapat ditambahkan di sini)
    echo "Reminder untuk {$row['nama']} telah dikirim: $pesan<br>";
}
?>
