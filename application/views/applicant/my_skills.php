<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Skills</h5>
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
                  <h5>Skills</h5>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <select class="select2-basic form-control" name="city_province_id" data-placeholder="Select Skills" multiple="multiple">
                          <option></option>
                        <?php foreach($skill_list as $skill){?>
                          <option value="<?php echo $skill['st_id'] ?>"><?php echo $skill['st_name']?></option>
                        <?php }?>
                          </select>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
