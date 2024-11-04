<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'kasir' && $_SESSION['role'] !== 'owner')) {
    header("Location: login.php");
    exit;
}
?>


// Ambil data pegawai dan transaksi mereka
$query = "SELECT pegawai.nama, SUM(transaksi.total) AS total_penjualan 
          FROM transaksi 
          JOIN pegawai ON transaksi.pegawai_id = pegawai.id 
          GROUP BY pegawai.id";
$result = mysqli_query($conn, $query);

echo "<h3>Laporan Pendapatan per Pegawai</h3>";
echo "<table border='1'>
        <tr>
            <th>Nama Pegawai</th>
            <th>Total Pendapatan</th>
        </tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['nama']}</td>
            <td>Rp {$row['total_penjualan']}</td>
          </tr>";
}
echo "</table>";
?>
