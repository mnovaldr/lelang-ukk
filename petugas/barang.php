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
                    <h1 class="m-0"> Pendataan Barang </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Data Barang</h3>

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
                                        <th>Tanggal Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Deskripsi Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    include '../koneksi.php';
                                    $barang = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                                    while ($data = mysqli_fetch_array($barang)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['nama_barang']; ?></td>
                                            <td><?= $data['tgl']; ?></td>
                                            <td>Rp. <?= number_format($data['harga_awal']); ?></td>
                                            <td><?= $data['deskripsi_barang']; ?></td>
                                            <td>
                                                <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $data['id_barang']; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $data['id_barang']; ?>">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
    
    
                                        <!-- Modal Edit Barang -->
                                        <div class="modal fade" id="modal-edit<?php echo $data['id_barang']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="update_barang.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Barang</label>
                                                                <input type="text" value="<?= $data['id_barang']; ?>" name="id_barang" class="form-control" hidden>
                                                                <input type="text" value="<?php echo $data['nama_barang']; ?>" class="form-control" name="nama_barang">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Barang</label>
                                                                <input type="date" value="<?= $data['tgl']; ?>" class="form-control" name="tgl">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Harga Barang</label>
                                                                <input type="number" value="<?php echo $data['harga_awal']; ?>" class="form-control" name="harga_awal">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Deskripsi Barang</label>
                                                                <textarea name="deskripsi_barang" class="form-control" rows="3"><?php echo $data['deskripsi_barang']; ?></textarea>
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
                                        <!-- .Modal Edit Barang -->
    
                                        <!-- Modal Hapus Barang -->
                                        <div class="modal fade" id="modal-hapus<?php echo $data['id_barang']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda Menghapus Data Barang <b><?php echo $data['nama_barang']; ?></b> ini?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <a href="hapus_barang.php?id_barang=<?php echo $data['id_barang']; ?>" class="btn btn-primary">Hapus</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .Modal Hapus Barang -->
                                    <?php } ?>
                                </tbody>
                            </table>
    
                            <!-- Modal Tambah Barang -->
                            <div class="modal fade" id="modal-tambah">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="simpan_barang.php" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input type="text" class="form-control" name="nama_barang" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Barang</label>
                                                    <input type="date" class="form-control" name="tgl" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga Barang</label>
                                                    <input type="number" class="form-control" name="harga_awal" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi Barang</label>
                                                    <textarea name="deskripsi_barang" class="form-control" rows="3" required></textarea>
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include '../layout/footer.php';
?>