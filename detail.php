<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['username'])) header("location:login.php");

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM news WHERE id='$id'");
$row = mysqli_fetch_assoc($query);
?>
<h2>Detail Berita: <?= $row['title'] ?></h2>
<p>Oleh: <?= $row['author'] ?> | <?= $row['date'] ?></p>
<img src="upload/<?= $row['image'] ?>" width="400">
<p><?= nl2br($row['content']) ?></p>
<a href="tampil.php">Kembali</a>