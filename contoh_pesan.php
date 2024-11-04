<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == "success") {
        echo "<div class='alert alert-success'>Operasi berhasil!</div>";
    } elseif ($_GET['status'] == "error") {
        echo "<div class='alert alert-danger'>Terjadi kesalahan, coba lagi!</div>";
    }
}
?>
