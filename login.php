<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    // Menggunakan MD5 sesuai standar dasar modul 17
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        header("location:tampil.php");
    } else {
        $error = "Username atau Password Salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Berita</title>
    <style>
        /* CSS Reset & Base */
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f6e56 0%, #1d9e75 100%);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Login Card */
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            margin: 0 0 10px 0;
            color: #0f6e56;
            text-align: center;
        }

        .login-card p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #1d9e75;
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.2);
        }

        /* Button Styling */
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #0f6e56;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #085041;
            transform: translateY(-2px);
        }

        /* Error Message */
        .error-msg {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Selamat Datang</h2>
    <p>Silakan login untuk mengelola berita</p>

    <?php if (isset($error)) : ?>
        <div class="error-msg"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" name="login" class="btn-login">Login Sekarang</button>
        <div style="text-align: center; margin-top: 15px; font-size: 14px;"> Belum punya akun? <a href="registrasi.php" style="color: #0f6e56; text-decoration: none; font-weight: bold;">Daftar Sekarang</a>
        </div>
    </form>
</div>

</body>
</html>