<!DOCTYPE html>
<html lang="en">
<!-- HEAD MEMANGGIL HEAD YANG ADA DI includes/head.php -->
<?php $this->load->view("includes/head.php") ?>

<body>
    <!-- NAV MEMANGGIL NAVBAR YANG ADA DI includes/navbar.php -->
    <?php $this->load->view("includes/navbar2.php") ?>
    <!-- END nav -->
    <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0"><div class="row">
<div class="col-lg-6">
<?= $this->session->flashdata('message');?>
</div>
</div>

<div class="card mb-3" style="max-width: 540px;">
  <!-- <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= base_url('assets/img/Profile/default.jpg')?>" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Username :</h5>
        <p class="card-text">Password :</p>
        <p class="card-text">Nama :</p>
        <p class="card-text">Alamat :</p>
        <p class="card-text">No Telepon :</p>
        <p class="card-text">Email :</p> -->
      <img src="<?= base_url('assets/img/Profile/').$tb_user['GAMBAR'];?>" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Username :<?= $tb_user['USERNAME']; ?></h5>
        <p class="card-text">Password :<?= $tb_user['PASSWORD']; ?></p>
        <p class="card-text">Nama :<?= $tb_user['NAMA']; ?></p>
        <p class="card-text">Alamat :<?= $tb_user['ALAMAT']; ?></p>
        <p class="card-text">No Telepon :<?= $tb_user['NOMER']; ?></p>
        <p class="card-text">Email :<?= $tb_user['EMAIL']; ?></p>
        
        
      </div>
    </div>
  </div>
</div>

    <!-- FOOTER MEMANGGIL FOOTER YANG ADA DI includes/footer.php -->
    <!-- <?php $this->load->view("includes/footer.php") ?> -->

    <!-- JS MEMANGGIL JS YANG ADA DI includes/js.php -->
    <?php $this->load->view("includes/js.php") ?>

</body>

</html>
  