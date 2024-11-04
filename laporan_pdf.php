<button onclick="generatePDF()">Download Laporan PDF</button>
<script>
function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text("Laporan Omzet TP94 Carwash & Bike", 10, 10);

    <?php
    $omzet = mysqli_query($conn, "SELECT * FROM transaksi");
    $y = 20;
    while ($data = mysqli_fetch_assoc($omzet)) : ?>
        doc.text("Tanggal: <?= $data['tanggal']; ?> - Total: Rp <?= $data['total']; ?>", 10, <?= $y; ?>);
        $y += 10;
    <?php endwhile; ?>

    doc.save("Laporan_Omzet.pdf");
}
</script>
