
<div class="m-sm alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    A wonderful serenity has taken possession. <a class="alert-link" href="#">Alert Link</a>.
</div>



<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?php echo ucfirst($action) ?> Region</h5>
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
                  <h5>Country</h5>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <select class="select2-basic form-control" name="region_country_id" data-placeholder="Field of Study">
                                <option></option>
                              <?php foreach($country_list as $country){?>
                                <option value="<?php echo $country['country_id'] ?>" <?php echo ($country['country_id'] == $form_data['region_country_id']) ? 'selected' : '' ?>><?php echo $country['country_name'].' - '.$country['country_code'] ?></option>
                              <?php }?>
                          </select>
                      </div>
                  </div>
                  <h5>Region Code</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="region_code" class="form-control" placeholder="Region Code" value="<?php echo $form_data['region_code']?>"></div>
                  </div>
                  <h5>Region Description</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="region_desc" class="form-control" placeholder="Region Description" value="<?php echo $form_data['region_desc']?>"></div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
