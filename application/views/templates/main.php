<div id="wrapper">
  <?php $this->load->view('components/left_nav'); ?>
  <div id="page-wrapper" class="gray-bg">
    <?php $this->load->view('components/head_nav'); ?>

    <!-- Mainly scripts -->
    <script src="<?php echo THEME ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo THEME ?>js/bootstrap.min.js"></script>
    <script src="<?php echo THEME ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo THEME ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo THEME ?>js/inspinia.js"></script>
    <?php echo $content; ?>

  </div>
</div>
