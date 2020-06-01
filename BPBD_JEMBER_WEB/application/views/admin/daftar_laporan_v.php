<!DOCTYPE html>
<html lang="en">

<head>
    <!-- HEAD MEMANGGIL HEAD YANG ADA DI admin/includes/head.php -->
    <?php $this->load->view("admin/includes/head.php") ?>
</head>

<body id="">
    <!-- SIDEBAR MEMANGGIL SIDEBAR YANG ADA DI admin/includes/sidebar.php -->
    <?php $this->load->view("admin/includes/sidebar.php") ?>

    <!-- SIDEBAR MEMANGGIL NAVBAR YANG ADA DI admin/includes/sidebar.php -->
    <?php $this->load->view("admin/includes/navbar.php") ?>

    <!-- ISI KONTEN HALAMAN -->

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <?php $this->load->view("admin/includes/breadcrumb.php") ?>
                </div>
                <div class="card card-stats">
                    <div class="card-header col-md-12">
                        <!-- PENCARIAN -->
                        <div class="col-md-4 pt-2 float-right">
                            <form action="" method="post">
                                <div class="input-group no-border">
                                    <input type="text" name="cari" class="form-control" placeholder="Pencarian..." autocomplete="off" autofocus>
                                    <div class="input-group-append">
                                        <input class="btn btn-primary" type="submit" name="submit" hidden>
                                        <div class="input-group-text">
                                            <i class="nc-icon nc-zoom-split"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- TABEL LIST -->
                    <div class="card-body mb-3">
                        <h6 class="col-md">Jumlah data laporan : <?php echo $total_rows; ?></h6>
                        <div class="table-responsive" id="data">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Pelapor</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi Bencana</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- MENGAMBIL DATA DARI DATABASE -->
                                <tbody>
                                    <?php foreach ($tb_laporan as $berita) : ?>
                                        <tr>
                                            <td><?php echo $berita['NAMA'] ?></td>
                                            <td><?php echo $berita['KATEGORI'] ?></td>
                                            <td><?php echo $berita['TANGGAL'] ?></td>
                                            <td><?php echo $berita['LOKASI'] ?></td>
                                            <td><img src="<?php echo base_url('assets/img/berita_gambar/' . $berita['GAMBAR']) ?>" width="64"></td>
                                            <!-- merubah status agar mudah dipahami -->
                                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/daftar_laporan/status/<?php echo $berita['ID_LPR']; ?>/<?php echo $berita['STATUS_BRT']; ?>">
                                                    <?php if ($berita['STATUS'] == 1) : ?>
                                                        <span href="" class="btn btn-success btn-circle btn-sm">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                    <?php else : ?>
                                                        <span href="" class="btn btn-danger btn-circle btn-sm">
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                </a></td>
                                            <td class="text-center" width="130">
                                                <a href="<?php echo base_url(); ?>admin/daftar_laporan/hapus/<?php echo $berita['ID_LPR']; ?>" class="btn btn-danger btn-sm rounded-pill m-1 tombol-hapus" onclick="return confirm('yakin?');"><i class="fas fa-trash"></i></a>
                                                <button class="badge badge-primary" data-toggle="modal" data-target="#modal_detail<?= $id_laporan; ?>">Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- menampilkan peringatan jika data tidak ada -->
                            <?php if (empty($tb_laporan)) : ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span>Laporan yang anda cari tidak ditemukan</span>
                                </div>
                            <?php endif ?>
                        </div>
                        <?php echo $this->pagination->create_links(); ?>
                        <!-- bagian keterangan -->
                        <div class="col-md small">
                            <h6>Keterangan :</h6>
                            <table>
                                <tr>
                                    <td><a href="" class="btn btn-light btn-sm rounded-pill"><i class="nc-icon nc-zoom-split"></i></a></td>
                                    <td class="pt-3 pl-3">
                                        <p> : Untuk melakukan pencarian, masukkan keyword yang ingin dicari lalu tekan "Enter"</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span href="" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </span></td>
                                    <td class="pt-3 pl-3">
                                        <p> : Laporan telah diverifikasi</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span href="" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-times"></i>
                                        </span></td>
                                    <td class="pt-3 pl-3">
                                        <p> : Laporan belum terverifikasi</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="" class="btn btn-danger btn-sm rounded-pill"><i class="fas fa-trash"></i></a></td>
                                    <td class="pt-3 pl-3">
                                        <p> : Action untuk menghapus data Laporan</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- batas bagian keterangan -->
                    </div>
                </div>
            </div>
        </div>

        <!-- BATAS ISI KONTEN HALAMAN -->

        <!-- FOOTER MEMANGGIL FOOTER YANG ADA DI admin/includes/footer.php -->
        <?php $this->load->view("admin/includes/footer.php") ?>

        <!-- JS MEMANGGIL JS YANG ADA DI admin/includes/js.php -->
        <?php $this->load->view("admin/includes/js.php") ?>

</body>

</html>

<!-- Modal Detail -->

<?php
foreach ($tb_laporan as $i) :
    $id_laporan = $i['ID_LPR'];
    $NAMA = $i['NAMA'];
    $ALAMAT = $i['ALAMAT'];
    $EMAIL = $i['EMAIL'];
    $KATEGORI = $i['KATEGORI'];
    $TANGGAL = $i['TANGGAL'];
    $DESKRIPSI = $i['DESKRIPSI'];
?>
    <div class="modal fade" id="modal_detail<?= $id_koleksi; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Detail Data Laporan Bencana</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">NAMA PELAPOR</label>
                        <div class="col-xs-8">
                            <input name="id" value="<?php echo $NAMA; ?>" class="form-control" type="text" placeholder="ID role" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">ALAMAT PELAPOR</label>
                        <div class="col-xs-8">
                            <input name="role" value="<?php echo $ALAMAT; ?>" class="form-control" type="text" placeholder="Nama role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">EMAIL PELAPOR</label>
                        <div class="col-xs-8">
                            <input name="role" value="<?php echo $EMAIL; ?>" class="form-control" type="email" placeholder="Nama role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">KATEGORI BENCANA</label>
                        <div class="col-xs-8">
                            <input name="role" value="<?php echo $KATEGORI; ?>" class="form-control" type="text" placeholder="Nama role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">TANGGAL</label>
                        <div class="col-xs-8">
                            <input name="role" value="<?php echo $TANGGAL; ?>" class="form-control" type="text" placeholder="Nama role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">DESKRIPSI BENCANA</label>
                        <div class="col-xs-8">
                            <textarea name="role" value="<?php echo $DESKRIPSI; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    </div>
                </div>
                <br>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>