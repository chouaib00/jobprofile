<body class="top-navigation">
  <div id="wrapper">
      <div id="page-wrapper" class="gray-bg">
          <div class="row border-bottom white-bg">
          <nav class="navbar navbar-static-top" role="navigation">
              <div class="navbar-header">
                  <button aria-controls="navbar" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                      <i class="fa fa-reorder"></i>
                  </button>
                  <a href="<?php echo DOMAIN; ?>" class="navbar-brand">PESO Batangas City</a>
              </div>

                  <ul class="nav navbar-top-links navbar-right">
                      <li>
                          <a href="<?php echo DOMAIN?>login">
                              <i class="fa fa-sign-in"></i> Log in
                          </a>
                      </li>
                  </ul>
          </nav>
          </div>
          <?php echo $content; ?>
      </div>
  </div>
  <?php $this->load->view('components/javascript'); ?>
</body>
