<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        
        if ($user['role'] === 'owner') {
            header("Location: dashboard_owner.php");
        } elseif ($user['role'] === 'kasir') {
            header("Location: dashboard_kasir.php");
        } else {
            echo "Role tidak dikenali.";
        }
        exit();
    } else {
        $error = "Username atau password salah";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login TP94 Carwash & Bike</title>
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
                        <h4>Login TP94 Carwash & Bike</h4>
                    </div>
                    <div class="card-body">
                        <!-- <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?> -->
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <div class="card-footer text-center">
                                <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
                            </div>

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
