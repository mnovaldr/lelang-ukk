<?php 
include '../koneksi.php';

$id_petugas = $_POST['id_petugas'];
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_level = $_POST['id_level'];

mysqli_query($koneksi, "UPDATE tb_petugas SET nama_petugas='$nama_petugas', username='$username', password='$password', id_level='$id_level' WHERE id_petugas='$id_petugas' ");

header("location:petugas.php?info=update");
?>