<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] != 'owner') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
}
?>

<h2>Tambah Pengguna Baru</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role">
        <option value="owner">Owner</option>
        <option value="kasir">Kasir</option>
    </select>
    <button type="submit" name="add_user">Tambah Pengguna</button>
</form>
