<!DOCTYPE html>
<html lang="en">
<!-- HEAD MEMANGGIL HEAD YANG ADA DI includes/head.php -->
<?php $this->load->view("includes/head.php") ?>

<body>
    <!-- NAV MEMANGGIL NAVBAR YANG ADA DI includes/navbar.php -->
    <?php $this->load->view("includes/navbar2.php") ?>
    <!-- END nav -->

    <!-- BAGIAN BERITA -->
    <section class="pt-5 ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <input type="text" name="id_brt" class="form-control" id="id_brt" value="<?php echo $tb_berita['ID_BRT'] ?>" hidden>
                    <h3 class="pb-2"><?php echo $tb_berita['JUDUL'] ?></h3>
                    <div class="col-12  pb-5">
                        <p>
                            <?php foreach ($tb_kategori as $kategori) : ?>
                                <?php if ($kategori['ID_KTR'] == $tb_berita['ID_KTR']) : ?>
                                    <i class="icon-tag"> <?php echo $kategori['KATEGORI'] ?></i>
                                <?php endif; ?>
                            <?php endforeach ?> /
                            <i class="icon-calendar"> <?php echo $tb_berita['TANGGAL'] ?></i> /
                            <?php foreach ($tb_user as $user) : ?>
                                <?php if ($user['ID_USR'] == $tb_berita['ID_USR']) : ?>
                                    <i class="icon-user"> <?php echo $user['NAMA'] ?></i>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </p>
                        <div class="pb-5" style="overflow: hidden; padding: 0; max-width: 800px;">
                            <img src="<?php echo base_url('assets/img/berita_gambar/' . $tb_berita['GAMBAR_BRT']) ?>" style="width:100%;">
                        </div>
                        <div class="text-dark" style="max-width: 800px;">
                            <?php echo $tb_berita['ISI_BERITA'] ?>
                        </div>
                    </div>

                    <span><i>Komentar</i></span>
                    <div class="card-footer card-comments">
                        <?php foreach ($tb_komentar as $komen) : ?>
                            <div class="card-comment">
                                <div class="comment-parent">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="<?= base_url('assets/img/') ?>profile.png" alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                            <?= $komen['NAMA']; ?>
                                            <span class="text-muted float-right"><?= time_elapsed_string('@' . $komen['TIMESTAMP']) ?></span>
                                        </span><!-- /.username -->
                                    </div>
                                    <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#modalbalaskomen" class="badge badge-warning" style="margin-left: 40px"><i class="fa fa-reply"></i> Reply</a> -->
                                    <!-- /.comment-text -->
                                    <p style="margin-left: 40px; margin-bottom: 0px;"><?= $komen['KOMENTAR']; ?></p>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalbalaskomen<?= $komen['ID_KMR'] ?>" class="badge badge-warning" style="margin-left: 40px"><i class="fa fa-reply"></i> Reply</a>
                                </div>
                            </div>
                            <?php
                            $id_brt = $komen['ID_BRT'];
                            $id_kmn = $komen['ID_KMR'];
                            $sql = $this->db->query("select * from tb_komentar inner join tb_user ON tb_komentar.ID_USR = tb_user.ID_USR WHERE ID_BRT = '$id_brt' and PARENT = '$id_kmn'")->result();
                            foreach ($sql as $km) :
                            ?>
                                <div class="card-comment">
                                    <div class="comment-child">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="<?= base_url('assets/img/') ?>profile.png" alt="User Image">

                                        <div class="comment-text">
                                            <span class="username">
                                                <?= $km->NAMA; ?>
                                                <span class="text-muted float-right"><?= time_elapsed_string('@' . $km->TIMESTAMP) ?></span>
                                            </span><!-- /.username -->
                                            <p style="margin-bottom: 0px;"><?= $km->KOMENTAR; ?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer d-flex flex-row-reverse mb-4">
                        <?php if ($this->session->userdata('ID_USR')) : ?>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaltambahkomen"><i class="fas fa-plus"></i> Add a Comment</button>
                        <?php else : ?>
                            <a href="<?= base_url('auth') ?>" class="btn btn-primary btn-sm"><i class="fas fa-lock"></i> Login to post</a>
                        <?php endif; ?>
                    </div>
                </div>


                <!-- SIDEBAR MEMANGGIL SIDEBAR YANG ADA DI includes/sidebar.php -->
                <?php $this->load->view("includes/sidebar.php") ?>
                <!-- <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-2">
                        </div>
                    </div>
                </div> -->

    </section>
    <!-- BATAS BERITA -->

    <!-- FOOTER MEMANGGIL FOOTER YANG ADA DI includes/footer.php -->
    <?php $this->load->view("includes/footer.php") ?>

    <!-- JS MEMANGGIL JS YANG ADA DI includes/js.php -->
    <?php $this->load->view("includes/js.php") ?>

</body>

<!-- Modal Tambah Komentar -->
<div class="modal fade" id="modaltambahkomen" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('beranda/addKomen') ?>" method="post">
                    <input type="hidden" name="id_brt" value="<?= $tb_berita['ID_BRT'] ?>">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Komentar Anda</label>
                        <textarea class="form-control" name="komentar" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm kuning" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary btn-sm coklat" value="Post">
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Balas Komentar -->
<?php foreach ($tb_komentar as $k) : ?>
	<?php
	$id_brt = $k['ID_BRT'];
    $id_kmr = $k['ID_KMR']; ?>
	<div class="modal fade" id="modalbalaskomen<?= $id_kmr ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Balas Komentar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('beranda/replyKomen'); ?>" method="post">
						<input hidden type="text" name="parent" value="<?= $id_kmr ?>">
						<input hidden type="text" name="id_brt" value="<?= $id_brt ?>">
						<input hidden type="text" name="id_usr" value="<?= $this->session->userdata('ID_USR'); ?>">

                        <div class="form-group">
							<label for="exampleFormControlTextarea1">Komentar Anda</label>
							<textarea class="form-control" name="isikomen" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm kuning" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary btn-sm coklat" value="Post">
				</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

</html>