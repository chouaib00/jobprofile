<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">

    <div class="col-lg-10">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form method="POST" action="?" id="main-form" enctype="multipart/form-data">
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
                    <h5>Employer Name</h5>
                    <input type="text" name="employer-name" placeholder="Enter Employer Name" class="form-control" value="<?php echo $form_data['employer_name'] ?>">
                  </div>
                  <div class="col-sm-12">
                    <label>Employer Address</label>
                    <input type="text" name="employer-address" placeholder="Enter Employer Address" class="form-control" value="<?php echo $form_data['employer_address'] ?>">
                  </div>
                  <div class="form-group col-sm-12">
                    <div class="col-sm-4">
                      <h5>Main Contact Number</h5>
                      <input name="phone-number-1" type="text" class="form-control" placeholder="Enter Main Contact Number" value="<?php echo $form_data['bc_phone_num1'] ?>">
                    </div>
                    <div class="col-sm-4">
                      <h5>Mobile Number</h5>
                      <input name="phone-number-2" type="text" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $form_data['bc_phone_num2'] ?>">
                    </div>
                    <div class="col-sm-4">
                      <h5>Home Number</h5>
                      <input name="phone-number-3" type="text" class="form-control" placeholder="Enter Home Number" value="<?php echo $form_data['bc_phone_num3'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <h5>About</h5>
                    <textarea name="employer-summary" class="form-control"><?php echo $form_data['employer_about'] ?></textarea>

                  </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button id="update-profile" data-form="main-form" class="btn btn-primary col-sm-12 btn-outline form-submit" type="button">
                  <h3 class="font-bold"><i class="fa fa-building"></i> Update Company Profile</h3>
                </button>
              </div>
          </div>
        </form>
    </div>
  </div>
</div>
