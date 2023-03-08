<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Realtime Lelang Online</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                        <!--<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                      <i class="fas fa-plus"></i> Tambah Lelang
                    </button>-->
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
                        <th>Peserta Lelang Tertinggi</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    include "../koneksi.php";
                    $tb_lelang    = mysqli_query($koneksi, "SELECT * FROM tb_lelang INNER JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang INNER JOIN tb_petugas ON tb_lelang.id_petugas=tb_petugas.id_petugas INNER JOIN history_lelang ON tb_lelang.id_lelang=history_lelang.id_lelang");
                    while ($d_tb_lelang = mysqli_fetch_array($tb_lelang)) {
                        $harga_tertinggi = mysqli_query($koneksi, "select max(penawaran_barang) as penawaran_barang FROM history_lelang where id_lelang='$d_tb_lelang[id_lelang]'");
                        $harga_tertinggi = mysqli_fetch_array($harga_tertinggi);
                        $d_harga_tertinggi = $harga_tertinggi['penawaran_barang'];
                        // $pemenang = mysqli_query($koneksi, "SELECT * FROM history_lelang where penawaran_barang='$harga_tertinggi[penawaran_barang]'");
                        // $d_pemenang = mysqli_fetch_array($pemenang);
                        $tb_masyarakat = mysqli_query($koneksi, "SELECT * FROM tb_masyarakat where id_user='$d_tb_lelang[id_user]'");
                        $d_tb_masyarakat = mysqli_fetch_array($tb_masyarakat);

                    ?>
                        <tr>
                            <?php if ($d_tb_lelang['status'] == '') { ?>
                            <?php } else if ($d_tb_lelang['id_user'] == '0') { ?>
                                Belum Ada Penawar Barang
                            <?php } else if ($d_tb_lelang['status'] == 'dibuka') { ?>
                                <td><?php echo $no++; ?></td>
                                <td><?= $d_tb_lelang['nama_barang'] ?></td>
                                <td><?= $d_tb_masyarakat['nama_lengkap'] ?></td>
                                <td>Rp. <?= number_format($d_tb_lelang['penawaran_barang']) ?></td>
                            <?php } else { ?>
                            <?php } ?>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>