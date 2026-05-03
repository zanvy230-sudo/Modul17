<?php
session_start();
if (!isset($_SESSION['username'])) header("location:login.php");
include "koneksi.php";

$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Berita</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .user-info h2 {
            margin: 0;
            font-size: 22px;
            color: #085041;
        }

        .user-info span {
            color: #7f8c8d;
            font-size: 14px;
        }

        /* Action Buttons */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
            font-size: 14px;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
        }

        .btn-logout:hover { background-color: #c0392b; }

        .btn-add {
            background-color: #0f6e56;
            color: white;
            margin-bottom: 15px;
        }

        .btn-add:hover { background-color: #085041; }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background-color: #085041;
            color: #fff;
            text-align: left;
            padding: 12px;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        /* Image Table Cell */
        .img-cell img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* Action Links */
        .actions a {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            text-decoration: none;
            margin-right: 5px;
        }

        .link-detail { background: #1d9e75; color: white; }
        .link-edit { background: #f1c40f; color: #333; }
        .link-hapus { background: #e74c3c; color: white; }

        /* Role Badge */
        .badge {
            background: #E1F5EE;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="user-info">
            <h2>Halo, <?= $_SESSION['username'] ?></h2>
            <span>Status: <span class="badge"><?= $_SESSION['level'] ?></span></span>
        </div>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>

    <?php if ($_SESSION['level'] == 'admin') : ?>
        <a href="form_upload.php" class="btn btn-add">+ Tambah Berita</a>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while($row = $result->fetch_assoc()) : 
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td class="img-cell">
                    <img src="upload/<?= $row['image'] ?>" alt="Gambar">
                </td>
                <td><strong><?= $row['title'] ?></strong></td>
                <td><?= $row['author'] ?></td>
                <td class="actions">
                    <a href="detail.php?id=<?= $row['id'] ?>" class="link-detail">Detail</a>
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="link-edit">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="link-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>