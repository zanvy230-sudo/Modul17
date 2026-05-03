<?php
include "koneksi.php";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // Menggunakan MD5 agar sinkron dengan sistem login modul 17
    $password = md5($_POST['password']);
    $level    = $_POST['level'];

    // Cek apakah username sudah ada
    $cek_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        $error = "Username sudah terdaftar! Gunakan nama lain.";
    } else {
        // Simpan ke database
        $query = mysqli_query($conn, "INSERT INTO users (username, password, level) VALUES ('$username', '$password', '$level')");
        if ($query) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            $error = "Gagal melakukan registrasi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Portal Berita</title>
    <style>
        /* Base Styling */
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #04342c 0%, #085041 100%);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Registration Card */
        .reg-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 400px;
        }

        .reg-card h2 {
            margin: 0 0 10px 0;
            color: #085041;
            text-align: center;
            font-size: 24px;
        }

        .reg-card p {
            text-align: center;
            color: #5DCAA5;
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #085041;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #9FE1CB;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
            outline: none;
        }

        input:focus, select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Button Styling */
        .btn-reg {
            width: 100%;
            padding: 12px;
            background-color: #1d9e75;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-reg:hover {
            background-color: #085041;
            transform: translateY(-1px);
        }

        /* Messages */
        .error {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 13px;
            border: 1px solid #fecaca;
        }

        .footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #5DCAA5;
        }

        .footer-link a {
            color: #1d9e75;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="reg-card">
    <h2>Daftar Akun</h2>
    <p>Buat akun untuk mengakses dashboard berita</p>
    
    <?php if (isset($error)) : ?>
        <div class="error"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Buat username baru" required autocomplete="off">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Buat password minimal 6 karakter" required>
        </div>

        <div class="form-group">
            <label>Level Akses</label>
            <select name="level" required>
                <option value="" disabled selected>Pilih hak akses...</option>
                <option value="user">User (Hanya Lihat)</option>
                <option value="admin">Admin (Kelola Data)</option>
            </select>
        </div>

        <button type="submit" name="register" class="btn-reg">Daftar Sekarang</button>
    </form>
    
    <div class="footer-link">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
</div>

</body>
</html>