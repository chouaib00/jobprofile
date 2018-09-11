<body class="skin-1">
  <div id="wrapper">
    <?php $this->load->view('components/left_nav_applicant'); ?>
    <div id="page-wrapper" class="gray-bg">
      <?php $this->load->view('components/head_nav_admin'); ?>
      <?php $this->load->view('components/alert'); ?>

      <?php echo $content; ?>

    </div>
  </div>
  <?php $this->load->view('components/javascript'); ?>
</body>
