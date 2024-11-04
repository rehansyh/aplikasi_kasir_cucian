<?php
// Ambil data transaksi dari DB sesuai dengan ID transaksi
$transaksi_id = $_GET['id'];
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $transaksi_id");
$data = mysqli_fetch_assoc($transaksi);

// Menampilkan struk
echo "<h3>TP94 Carwash & Bike</h3>";
echo "<p>Alamat: Jl. Raya No. 123</p>";
echo "<p>No Transaksi: " . $data['id'] . "</p>";
echo "<p>Pelanggan: " . $data['pelanggan_nama'] . "</p>";
echo "<p>Items:</p>";

// Menampilkan layanan/item
$items = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE transaksi_id = $transaksi_id");
while ($item = mysqli_fetch_assoc($items)) {
    echo $item['nama_item'] . " - " . $item['harga'] . "<br>";
}

echo "<p>Footnote: Terima kasih atas kunjungan Anda!</p>";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<button onclick="generatePDF()">Download Struk PDF</button>

<script>
function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text("TP94 Carwash & Bike", 10, 10);
    doc.text("Alamat: Jl. Raya No. 123", 10, 20);
    doc.text("Nomor Transaksi: <?= $data['id']; ?>", 10, 30);
    doc.text("Pelanggan: <?= $data['pelanggan_nama']; ?>", 10, 40);

    <?php while ($item = mysqli_fetch_assoc($items)): ?>
        doc.text("<?= $item['nama_item']; ?> - Rp <?= $item['harga']; ?>", 10, doc.lastAutoTable.finalY + 10);
    <?php endwhile; ?>

    doc.text("Total: Rp <?= $data['total']; ?>", 10, 80);
    doc.text("Terima kasih atas kunjungan Anda!", 10, 90);
    doc.save("Struk_<?= $data['id']; ?>.pdf");
}
</script>


