
<!-- jQuery -->
<script src="<?=base_url()?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS --
<script src="<?=base_url()?>/plugins/chart.js/Chart.min.js"></script>
-->
<!-- Sparkline --
<script src="<?=base_url()?>/plugins/sparklines/sparkline.js"></script>
-->
<!-- JQVMap --
<script src="<?=base_url()?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url()?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
-->
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>/plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- daterangepicker -->
<script src="<?=base_url()?>/plugins/moment/moment.min.js"></script>
<script src="<?=base_url()?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url()?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url()?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url()?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>/plugins/alertifyjs/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script> <!-- for alerts in the system - required-->
<!-- AdminLTE App -->
<script src="<?=base_url()?>/dist/js/adminlte.js"></script>
<script src="<?=base_url()?>/dist/js/common.js"></script>
<script src="<?=base_url()?>/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Searchable select - Jquery -- Required -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!--<script src="<?=base_url()?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) --
<script src="<?=base_url()?>/dist/js/pages/dashboard.js"></script>
-->
<!-- AdminLTE for demo purposes --
<script src="<?=base_url()?>/dist/js/demo.js"></script>
-->
 <script type="text/javascript">
 var BASE_URL = "<?=base_url()?>/index.php/";
//  var BASE_URL = "<?=base_url()?>/";
</script> 
<script>
$(function(){
  var current_page_URL = location.href;
  $( "a" ).each(function() {
     if ($(this).attr("href") !== "#") {
       var target_URL = $(this).prop("href");
       if (target_URL == current_page_URL) {
          $('nav a').parents('li, ul').removeClass('active');
          $(this).parent('li').addClass('active');
          return false;
       }
     }
  });
});
</script>