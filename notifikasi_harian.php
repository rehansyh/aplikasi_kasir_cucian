<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'owner') {
    header("Location: login.php");
    exit;
}

// Laporan harian
$today = date("Y-m-d");
$query = "SELECT COUNT(*) as total_transaksi, SUM(total) as total_pendapatan 
          FROM transaksi WHERE DATE(tanggal) = '$today'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<h3>Laporan Harian (<?= $today; ?>)</h3>
<p>Total Transaksi Hari Ini: <?= $row['total_transaksi']; ?></p>
<p>Total Pendapatan Hari Ini: Rp <?= $row['total_pendapatan']; ?></p>
