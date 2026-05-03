<?php
session_start();
include "koneksi.php";

if ($_SESSION['level'] != 'admin') {
    die("Akses Ditolak! Anda bukan Admin.");
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT image FROM news WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// Hapus file fisik
unlink("upload/" . $row['image']);

// Hapus data database
mysqli_query($conn, "DELETE FROM news WHERE id='$id'");
header("location:tampil.php");
?>