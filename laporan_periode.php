<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'kasir' && $_SESSION['role'] !== 'owner')) {
    header("Location: login.php");
    exit;
}
?>

if (isset($_POST['periode'])) {
    $periode = $_POST['periode'];
    $query = "SELECT * FROM transaksi WHERE ";

    if ($periode == 'mingguan') {
        $query .= "tanggal >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    } elseif ($periode == 'bulanan') {
        $query .= "tanggal >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
    } elseif ($periode == 'tahunan') {
        $query .= "tanggal >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
    }

    $result = mysqli_query($conn, $query);
}

?>

<form method="POST" action="">
    <select name="periode">
        <option value="mingguan">Mingguan</option>
        <option value="bulanan">Bulanan</option>
        <option value="tahunan">Tahunan</option>
    </select>
    <button type="submit">Lihat Laporan</button>
</form>

<?php if (isset($result)) : ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['pelanggan_id']; ?></td>
                <td>Rp <?= $row['total']; ?></td>
                <td><?= $row['tanggal']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
