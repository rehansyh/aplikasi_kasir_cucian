<?php
session_start();
$error = '';

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'koneksi.php'; // Menghubungkan ke database

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Cek jika username sudah ada
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        // Insert user baru ke database
        $password_md5 = md5($password); // Enkripsi password
        $query = "INSERT INTO users (username, password, nama_lengkap, role) VALUES ('$username', '$password_md5', '$nama_lengkap', '$role')";
        
        if (mysqli_query($conn, $query)) {
            header("Location: login.php"); // Redirect ke halaman login setelah berhasil registrasi
            exit;
        } else {
            $error = "Terjadi kesalahan saat registrasi. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TP94 Carwash & Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Register Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="kasir">Kasir</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>© 2024 TP94 Carwash & Bike</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
