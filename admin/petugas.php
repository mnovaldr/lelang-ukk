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
                    <h1 class="m-0"> Petugas </h1>
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
                            <h3 class="card-title">Data Petugas</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                                            <i class="fas fa-plus"></i> Tambah Petugas
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
                                        <th>Nama Petugas</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                $no = 1;
                                include '../koneksi.php';
                                $petugas = mysqli_query($koneksi, "SELECT * FROM tb_petugas INNER JOIN tb_level ON tb_petugas.id_level=tb_level.id_level");
                                while ($data = mysqli_fetch_array($petugas)) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['nama_petugas'] ?></td>
                                            <td><?= $data['username'] ?></td>
                                            <td><?= $data['level'] ?></td>
                                            <td>
                                                <?php if ($_SESSION['username'] == $data['username']) { ?>
                                                    <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $data['id_petugas']; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $data['id_petugas']; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $data['id_petugas']; ?>">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Barang -->
                                        <div class="modal fade" id="modal-edit<?php echo $data['id_petugas']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Petugas</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="update_petugas.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Petugas</label>
                                                                <input type="text" value="<?php echo $data['id_petugas']; ?>" name="id_petugas" hidden>
                                                                <input type="text" value="<?php echo $data['nama_petugas']; ?>" class="form-control" name="nama_petugas">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" value="<?php echo $data['username']; ?>" class="form-control" name="username">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" value="<?php echo $data['password']; ?>" class="form-control" name="password">
                                                                <i><font color="red">Abaikan jika password tidak diubah*</font></i>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Level</label>
                                                                <select name="id_level" class="form-control">
                                                                    <option value="">Pilih Level</option>
                                                                    <?php
                                                                    include "../koneksi.php";
                                                                    $tb_level    = mysqli_query($koneksi, "SELECT * FROM tb_level");
                                                                    while ($data_level = mysqli_fetch_array($tb_level)) { ?>
                                                                        <option value="<?= $data_level['id_level'] ?>" <?php if ($data_level['id_level'] == $data['id_level']) { echo 'selected'; } ?>><?= $data_level['level'] ?></option>
                                                                    <?php } ?>
                                                                </select>
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
                                        <div class="modal fade" id="modal-hapus<?php echo $data['id_petugas']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah Anda Menghapus Data Petugas <b><?= $data['nama_petugas'] ?></b> ini?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <a href="hapus_petugas.php?id_petugas=<?php echo $data['id_petugas'] ?>" class="btn btn-danger">Hapus</a>
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
                                            <h4 class="modal-title">Tambah Petugas</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="simpan_petugas.php" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Petugas</label>
                                                    <input type="text" class="form-control" name="nama_petugas">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Level</label>
                                                    <select name="id_level" class="form-control">
                                                        <option value="">Pilih Level</option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">Petugas</option>
                                                    </select>
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