
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
                <h5><?php echo ucfirst($action) ?> Province</h5>
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
                  <h5>Region</h5>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <select class="select2-basic form-control" name="province_region_id" data-placeholder="Region">
                                <option></option>
                              <?php foreach($region_list as $region){?>
                                <option value="<?php echo $region['region_id'] ?>" <?php echo ($region['region_id'] == $form_data['province_region_id']) ? 'selected' : '' ?>><?php echo $region['region_desc'].' - '.$region['region_code'] ?></option>
                              <?php }?>
                          </select>
                      </div>
                  </div>
                  <h5>Province Code</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="province_code" class="form-control" placeholder="Province Code" value="<?php echo $form_data['province_code']?>"></div>
                  </div>
                  <h5>Province Name</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="province_name" class="form-control" placeholder="Province Name" value="<?php echo $form_data['province_name']?>"></div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
