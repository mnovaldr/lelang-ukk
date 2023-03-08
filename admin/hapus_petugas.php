<?php 

include '../koneksi.php';

$id_petugas = $_GET['id_petugas'];

mysqli_query($koneksi, "DELETE FROM tb_petugas WHERE id_petugas='$id_petugas'");

header("location:petugas.php?info=hapus");