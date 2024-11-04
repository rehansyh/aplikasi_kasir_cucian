<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'kasir') {
    header("Location: login.php");
    exit;
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="pendapatanChart" width="400" height="200"></canvas>
<script>
<?php
include 'koneksi.php';
$dataPendapatan = [];
$bulan = [];

// Mengambil data pendapatan per bulan
for ($i = 1; $i <= 12; $i++) {
    $query = "SELECT SUM(total) AS pendapatan FROM transaksi WHERE MONTH(tanggal) = $i";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $dataPendapatan[] = $row['pendapatan'] ? $row['pendapatan'] : 0;
    $bulan[] = date("F", mktime(0, 0, 0, $i, 10)); // Nama bulan
}
?>

const ctx = document.getElementById('pendapatanChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($bulan); ?>,
        datasets: [{
            label: 'Pendapatan Bulanan',
            data: <?= json_encode($dataPendapatan); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
