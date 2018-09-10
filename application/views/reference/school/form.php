
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
                <h5><?php echo ucfirst($action) ?> School</h5>
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
                  <h5>School</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="school_name" class="form-control" placeholder="School" value="<?php echo $form_data['school_name']?>"></div>
                  </div>
                  <h5>Address</h5>
                  <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" name="address_desc" class="form-control" value="<?php echo $form_data['address_desc'] ?>" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)">
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-country" data-placeholder="Select Country">
                            <option></option>
                            <?php if($action == 'edit'){ ?>
                            <option value="<?php echo $form_data['country_id'] ?>" selected><?php echo $form_data['country_name'] ?></option>
                            <?php }?>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-region" data-placeholder="Select Region">
                            <option></option>
                            <?php if($action == 'edit'){ ?>
                            <option value="<?php echo $form_data['region_id'] ?>" selected><?php echo $form_data['region_code'].' - '.$form_data['region_desc'] ?></option>
                            <?php }?>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-province" name="province_id" data-placeholder="Select Province">
                            <option></option>
                            <?php if($action == 'edit'){ ?>
                            <option value="<?php echo $form_data['province_id'] ?>" selected><?php echo $form_data['province_name'] ?></option>
                            <?php }?>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-city" name="city_id" data-placeholder="Select City">
                            <option></option>
                            <?php if($action == 'edit'){ ?>
                            <option value="<?php echo $form_data['city_id'] ?>" selected><?php echo $form_data['city_name'] ?></option>
                            <?php }?>
                        </select>
                      </div>
                  </div>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/reference/school_form.js"></script>
