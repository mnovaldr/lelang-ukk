<?php 
include '../koneksi.php';

$id_lelang = $_GET['id_lelang'];
$id_barang = $_POST['id_barang'];
$id_user = $_POST['id_user'];
$id_lelang = $_POST['id_lelang'];
$penawaran_barang = $_POST['penawaran_barang'];

// mysqli_query($koneksi,"insert into history_lelang values('','$id_lelang','$id_barang','$id_user','$penawaran_barang')");
$sql = "UPDATE history_lelang SET penawaran_barang='$penawaran_barang' WHERE id_lelang='$id_lelang' ; UPDATE tb_lelang SET id_user='$id_user', harga_akhir='$penawaran_barang' WHERE id_lelang='$id_lelang' ";

$query = mysqli_multi_query($koneksi, $sql);

header("location:penawaran.php?info=simpan");

?>