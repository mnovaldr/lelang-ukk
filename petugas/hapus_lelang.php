<?php
include '../koneksi.php';

$id_lelang = $_GET['id_lelang'];

mysqli_query($koneksi, "DELETE FROM tb_lelang WHERE id_lelang='$id_lelang'");

header("location:aktivasi.php?info=hapus");


?>