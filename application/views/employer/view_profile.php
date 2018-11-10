<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">

    <div class="col-lg-10">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
              <h5>About <?php echo $form_data['employer_name'] ?></h5>
              <div class="ibox-tools">
                  <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="fullscreen-link">
                      <i class="fa fa-expand"></i>
                  </a>
              </div>
            </div>
            <div class="ibox-content form-horizontal">
              <div class="form-group">
                  <div class="col-sm-12">
                    <h5 class="text-muted">Employer Name</h5>
                    <h4><?php echo $form_data['employer_name'] ?></h4>
                  </div>
                  <div class="col-sm-12">
                    <h5 class="text-muted">Employer Address</h5>
                    <h4><?php echo $form_data['employer_address'] ?></h4>
                  </div>
                  <div class="form-group col-sm-12">
                    <div class="col-sm-4">
                      <h5 class="text-muted">Main Contact Number</h5>
                      <h4><?php echo $form_data['bc_phone_num1'] ?></h4>
                    </div>
                    <div class="col-sm-4">
                      <h5 class="text-muted">Mobile Number</h5>
                      <h4><?php echo $form_data['bc_phone_num2'] ?></h4>
                    </div>
                    <div class="col-sm-4">
                      <h5 class="text-muted">Home Number</h5>
                      <h4><?php echo $form_data['bc_phone_num3'] ?></h4>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <h5 class="text-muted">About</h5>
                    <div class="well"><?php echo $form_data['employer_about'] ?></div>
                  </div>
              </div>
          </div>
    </div>
  </div>
</div>
