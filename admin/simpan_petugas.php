<?php
include '../koneksi.php';

$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_level = $_POST['id_level'];

mysqli_query($koneksi,"insert into tb_petugas values('','$nama_petugas','$username','$password','$id_level')");

header("location:petugas.php?info=simpan");

?>