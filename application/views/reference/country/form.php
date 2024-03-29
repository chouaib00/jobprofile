<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?php echo ucfirst($action) ?> Country</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="fullscreen-link">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
              <form id="main-form" action="" method="POST" class="form-horizontal">
                  <h5>Country Code</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="country_code" class="form-control" placeholder="Country Code" value="<?php echo $form_data['country_code']?>"></div>
                  </div>
                  <h5>Country Name</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="country_name" class="form-control" placeholder="Country Name" value="<?php echo $form_data['country_name']?>"></div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
