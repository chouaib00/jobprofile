
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
                      <div class="col-sm-12"><input type="text" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)"></div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-country" data-placeholder="Select Country">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-region" data-placeholder="Select Region">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-province" data-placeholder="Select Province">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-city" data-placeholder="Select City">
                            <option></option>
                        </select>
                      </div>
                  </div>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/reference/school_form.js"></script>
