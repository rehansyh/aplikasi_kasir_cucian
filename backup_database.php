<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'kasir' && $_SESSION['role'] !== 'owner')) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['backup'])) {
    $backup_file = 'backup_' . date("Y-m-d_H-i-s") . '.sql';
    $command = "mysqldump -u root tp94_carwash > $backup_file";
    system($command, $output);
    echo $output == 0 ? "Backup berhasil!" : "Backup gagal!";
}
?>

<form method="POST" action="">
    <button type="submit" name="backup">Backup Database</button>
</form>
