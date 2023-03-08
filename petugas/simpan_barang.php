<?php 
include '../koneksi.php';

$nama_barang = $_POST['nama_barang'];
$tgl = $_POST['tgl'];
$harga_awal = $_POST['harga_awal'];
$deskripsi_barang = $_POST['deskripsi_barang'];

mysqli_query($koneksi, "INSERT INTO tb_barang VALUES('', '$nama_barang', '$tgl', '$harga_awal', '$deskripsi_barang')");

header("location:barang.php?info=simpan");

?>
