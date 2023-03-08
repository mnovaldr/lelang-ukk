<?php
include '../layout/header.php';
include '../layout/navbar_admin.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Aktivasi Lelang Online</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Aktivasi Lelang Online</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                                            <i class="fas fa-plus"></i> Tambah Barang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <?php
                            if (isset($_GET['info'])) {
                                if ($_GET['info'] == "hapus") { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                                        Data berhasil di hapus
                                    </div>
                                <?php } else if ($_GET['info'] == "simpan") { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-check"></i> Sukses</h5>
                                        Data berhasil di simpan
                                    </div>
                                <?php } else if ($_GET['info'] == "update") { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                                        Data berhasil di update
                                    </div>
                            <?php }
                            } ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Lelang</th>
                                        <th>Pemenang Lelang</th>
                                        <th>Harga Tertinggi</th>
                                        <th>Status Lelang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    include '../koneksi.php';
                                    $lelang = mysqli_query($koneksi, "SELECT * FROM tb_lelang INNER JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang INNER JOIN tb_petugas ON tb_lelang.id_petugas=tb_petugas.id_petugas ");
                                    while ($data_lelang = mysqli_fetch_array($lelang)) {
                                        $harga_tertinggi = mysqli_query($koneksi, "SELECT MAX(harga_akhir) AS harga_akhir FROM tb_lelang WHERE id_lelang='$data_lelang[id_lelang]'");
                                        $harga_tertinggi = mysqli_fetch_array($harga_tertinggi);
                                        $d_harga_tertinggi = $harga_tertinggi['harga_akhir'];
                                        // $pemenang = mysqli_query($koneksi, "SELECT * FROM history_lelang where id_lelang='$data_lelang[id_lelang]'");
                                        // $d_pemenang = mysqli_fetch_array($pemenang);
                                        $masyarakat = mysqli_query($koneksi, "SELECT * FROM tb_masyarakat where id_user='$data_lelang[id_user]'");
                                        $d_tb_masyarakat = mysqli_fetch_array($masyarakat);
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data_lelang['nama_barang'] ?></td>
                                            <td><?= $data_lelang['tgl_lelang'] ?></td>
                                            <td>
                                                <?php if ($data_lelang['status'] == '') { ?>
                                                    -
                                                <?php } else if ($data_lelang['status'] == 'dibuka') { ?>
                                                    <div class="btn btn-info btn-sm">Lelang Sedang Berjalan</div>

                                                <?php } else if ($data_lelang['status'] == 'ditutup' && $data_lelang['id_user'] == '0' && $data_lelang['harga_akhir'] == '0') { ?>
                                                    <div class="btn btn-warning btn-sm">Lelang Ditutup Sementara</div>
                                                <?php } else { ?>
                                                    <?= $d_tb_masyarakat['nama_lengkap'] ?>
                                                <?php } ?>
                                                
                                                <!-- <?php if ($data_lelang['status'] == 'dibuka') { ?>
                                                    -
                                                <?php } else { ?>
                                                    <?= $d_tb_masyarakat['nama_lengkap'] ?>
                                                <?php } ?> -->
                                            </td>
                                            <td>
                                                <?php if ($data_lelang['status'] == '') { ?>
                                                    -
                                                <?php } else if ($data_lelang['status'] == 'dibuka') { ?>
                                                    <div class="btn btn-info btn-sm">Lelang Sedang Berjalan</div>
                                                <?php } else if ($data_lelang['status'] == 'ditutup' && $data_lelang['id_user'] == '0' && $data_lelang['harga_akhir'] == '0') { ?>
                                                    <div class="btn btn-warning btn-sm">Lelang Ditutup Sementara</div>
                                                <?php } else { ?>
                                                    Rp. <?= number_format($data_lelang['harga_akhir']) ?>
                                                <?php } ?>
                                                <!-- <?php if ($data_lelang['status'] == 'dibuka') { ?>
                                                    -
                                                <?php } else { ?>
                                                    Rp. <?= number_format($d_harga_tertinggi) ?>
                                                <?php } ?> -->
                                            </td>
                                            <td>
                                                <?php if ($data_lelang['status'] == '') { ?>
                                                    <div class="btn btn-warning btn-sm">Lelang Belum Aktif</div>
                                                <?php } else if ($data_lelang['status'] == 'dibuka') { ?>
                                                    <div class="btn btn-success btn-sm">Lelang Dibuka</div>
                                                <?php } else { ?>
                                                    <div class="btn btn-danger btn-sm">Lelang Ditutup</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-buka<?php echo $data_lelang['id_lelang']; ?>">Buka Lelang</div>
                                                <div class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-tutup<?php echo $data_lelang['id_lelang']; ?>">Tutup Lelang</div>
                                                <!-- <div class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $data_lelang['id_lelang']; ?>"><i class="fas fa-trash"></i></div> -->
                                            </td>
                                        </tr>

                                        <!-- Modal  -->
                                        <div class="modal fade" id="modal-buka<?php echo $data_lelang['id_lelang']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Buka Lelang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="update_lelang_buka.php" method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah Anda Yakin Membuka Lelang ini?</p>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" value="dibuka" name="status" hidden="">
                                                                <input type="text" class="form-control" value="" name="id_user" hidden="">
                                                                <input type="text" class="form-control" value="" name="harga_akhir" hidden="">
                                                                <input type="text" class="form-control" value="<?php echo $data_lelang['id_lelang']; ?>" name="id_lelang" hidden="">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Tutup Lelang -->
                                        <div class="modal fade" id="modal-tutup<?php echo $data_lelang['id_lelang']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Tutup Lelang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="update_lelang_tutup.php" method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah Anda Yakin Menutup Lelang ini?</p>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" value="ditutup" name="status" hidden="">
                                                                <input type="text" class="form-control" value="<?php echo $d_tb_masyarakat['id_user']; ?>" name="id_user" hidden="">
                                                                <input type="text" class="form-control" value="<?php echo $d_harga_tertinggi; ?>" name="harga_akhir" hidden="">
                                                                <input type="text" class="form-control" value="<?php echo $data_lelang['id_lelang']; ?>" name="id_lelang" hidden="">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .Modal Tutup Lelang -->
                                        <!-- Modal Hapus Lelang -->
                                        <!-- <div class="modal fade" id="modal-hapus<?php echo $data['id_lelang']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Lelang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda Yakin Menghapus Data ini?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <a href="hapus_lelang.php?id_lelang=<?php echo $data['id_lelang']; ?>" class="btn btn-primary">Hapus</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- .Modal Hapus Lelang -->
                                    <?php } ?>
                                    <!-- .Modal  -->
                                </tbody>
                            </table>
                            <!-- Modal Tambah Barang -->
                            <div class="modal fade" id="modal-tambah">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data Lelang</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="simpan_lelang.php">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <select name="id_barang" class="form-control select2" style="width: 100%;">
                                                        <option disabled selected>--- Pilih Barang ---</option>
                                                        <?php
                                                        include "../koneksi.php";
                                                        $tb_barang    = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                                                        while ($data_barang = mysqli_fetch_array($tb_barang)) {
                                                        ?>
                                                            <option value="<?php echo $data_barang['id_barang']; ?>"><?php echo $data_barang['nama_barang']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    include "../koneksi.php";
                                                    $tb_petugas    = mysqli_query($koneksi, "SELECT * FROM tb_petugas where username='$_SESSION[username]'");
                                                    while ($d_tb_petugas = mysqli_fetch_array($tb_petugas)) {
                                                    ?>
                                                        <input type="text" class="form-control" value="<?php echo $d_tb_petugas['id_petugas']; ?>" name="id_petugas" hidden>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- .Modal Tambah Barang -->

                        </div>
                        <!-- .Card Body -->


                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div id="div" class="col-lg-12"><?php include "isi.php"; ?></div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include '../layout/footer.php';
?>