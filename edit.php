<?php
session_start();
include "koneksi.php";
if ($_SESSION['level'] != 'admin') die("Akses Ditolak!");

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM news WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $img_old = $_POST['img_old'];

    if ($_FILES['image']['name'] != "") {
        // Jika ganti gambar
        $image_baru = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/" . $image_baru);
        unlink("upload/" . $img_old); // hapus foto lama
    } else {
        $image_baru = $img_old;
    }

    mysqli_query($conn, "UPDATE news SET title='$title', content='$content', author='$author', image='$image_baru' WHERE id='$id'");
    header("location:tampil.php");
}
?>