<?php
include '../layout/header.php';
include '../layout/navbar_admin.php';
?>

<!-- /.navbar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Laporan Lelang Online</h1>
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
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Hasil Lelang Online</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <div class="input-group-append">
                    <a href="print.php" target="blank_" class="btn btn-primary"><i class="fas fa-print"></i> Print Laporan</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Lelang</th>
                    <th>Pemenang Lelang</th>
                    <th>Harga Tertinggi</th>
                    <th>Status Lelang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  include "../koneksi.php";
                  $tb_lelang    = mysqli_query($koneksi, "SELECT * FROM tb_lelang INNER JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang INNER JOIN tb_petugas ON tb_lelang.id_petugas=tb_petugas.id_petugas ");
                  while ($d_tb_lelang = mysqli_fetch_array($tb_lelang)) {
                    $harga_tertinggi = mysqli_query($koneksi, "select max(harga_akhir) as harga_akhir FROM tb_lelang where id_lelang='$d_tb_lelang[id_lelang]'");
                    $harga_tertinggi = mysqli_fetch_array($harga_tertinggi);
                    $d_harga_tertinggi = $harga_tertinggi['harga_akhir'];
                    // $pemenang = mysqli_query($koneksi, "SELECT * FROM history_lelang where id_lelang='$d_tb_lelang[id_lelang]'");
                    // $d_pemenang = mysqli_fetch_array($pemenang);
                    $tb_masyarakat = mysqli_query($koneksi, "SELECT * FROM tb_masyarakat where id_user='$d_tb_lelang[id_user]'");
                    $d_tb_masyarakat = mysqli_fetch_array($tb_masyarakat);
                  ?>
                    <?php
                    if ($d_tb_lelang['status'] == 'dibuka') { ?>
                    <?php } elseif ($d_tb_lelang['status'] == '') { ?>
                    <?php } else if ($d_tb_lelang['status'] == 'ditutup' && $d_tb_lelang['id_user'] == '0' && $d_tb_lelang['harga_akhir'] == '0') { ?>
                    <?php } else { ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?= $d_tb_lelang['nama_barang'] ?></td>
                        <td><?= $d_tb_lelang['tgl_lelang'] ?></td>
                        <td><?= $d_tb_masyarakat['nama_lengkap'] ?></td>
                        <td>Rp. <?= number_format($d_harga_tertinggi) ?></td>
                        <td>
                          <?php if ($d_tb_lelang['status'] == '') { ?>
                            <div class="btn btn-warning btn-sm">Lelang Belum Aktif</div>
                          <?php } else if ($d_tb_lelang['status'] == 'dibuka') { ?>
                            <div class="btn btn-success btn-sm">Lelang Dibuka</div>
                          <?php } else { ?>
                            <div class="btn btn-success btn-sm">Lelang Selesai</div>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>

                  <?php } ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
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