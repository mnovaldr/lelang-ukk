<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id_history = $_POST['id_history'];
$penawaran_barang = $_POST['penawaran_barang'];
// update data ke database
mysqli_query($koneksi,"update history_lelang set penawaran_barang='$penawaran_barang' where id_history='$id_history'");

// mengalihkan halaman kembali ke index.php
header("location:penawaran.php?info=update");

?>