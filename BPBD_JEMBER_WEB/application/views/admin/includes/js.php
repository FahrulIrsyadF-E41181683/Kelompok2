<!--   Core JS Files   -->
  <script src="<?php echo base_url('assets/js/core/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/core/popper.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/core/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js')?>"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="<?php echo base_url('assets/js/plugins/chartjs.min.js')?>"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/plugins/bootstrap-notify.js')?>"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url('assets/js/paper-dashboard.min.js?v=2.0.0')?>" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url ('assets/demo/demo.js')?>"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  <!-- Ckeditor -->
  <script src="<?php echo base_url('assets/ckeditor/ckeditor.js')?>"></script>
	<script type="text/javascript">
	  $(function () {
	    CKEDITOR.replace('ckeditor');
	  });
  </script>
  <!-- datepicker -->
  <script src="<?php echo base_url ('assets/datepicker/js/bootstrap-datepicker.js')?>"></script>
  <script>
    $(function () {
    $('#datepicker').datepicker({
    autoclose: true
  });
  });
  </script>
<!-- Sweetalert -->
<script src="<?php echo base_url ('assets/js/sweetalert2.all.min.js')?>"></script>
<!-- scrip js -->
<script src="<?php echo base_url('assets/js/scrip.js')?>"></script>