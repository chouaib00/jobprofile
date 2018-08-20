
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
                <h5><?php echo ucfirst($action) ?> City</h5>
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
                  <h5>Province</h5>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <select class="select2-basic form-control" name="city_province_id" data-placeholder="Province">
                                <option></option>
                              <?php foreach($province_list as $province){?>
                                <option value="<?php echo $province['province_id'] ?>" <?php echo ($province['province_id'] == $form_data['city_province_id']) ? 'selected' : '' ?>><?php echo $province['province_name'].' - '.$province['province_code'] ?></option>
                              <?php }?>
                          </select>
                      </div>
                  </div>
                  <h5>City Name</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="city_name" class="form-control" placeholder="City Name" value="<?php echo $form_data['city_name']?>"></div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
