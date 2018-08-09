<div id="wrapper">
  <?php $this->load->view('components/left_nav_admin'); ?>
  <div id="page-wrapper" class="gray-bg">
    <?php $this->load->view('components/head_nav'); ?>
    <script>var global = {site_name:<?php echo DOMAIN; ?>}</script>
    <!-- Mainly scripts -->
    <script src="<?php echo THEME ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo THEME ?>js/bootstrap.min.js"></script>
    <script src="<?php echo THEME ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo THEME ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo THEME ?>js/inspinia.js"></script>
    <?php echo $content; ?>

  </div>
</div>
