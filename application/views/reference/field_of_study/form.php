
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
                <h5><?php echo ucfirst($action) ?> Field of Study</h5>
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
                  <h5>Field of Study</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="fos_name" class="form-control" placeholder="Field of Study" value="<?php echo $form_data['fos_name']?>"></div>
                  </div>
                  <h5>Parent Field Of Study</h5>
                  <div class="form-group">
                      <div class="col-sm-12">
                          <select class="select2-basic form-control" name="fos_parent_fos_id" data-placeholder="Field of Study">
                                <option></option>
                              <?php foreach($fos_parent_list as $fos_parent){?>
                                <option value="<?php echo $fos_parent['fos_id'] ?>" <?php echo ($fos_parent['fos_id'] == $form_data['fos_parent_fos_id']) ? 'selected' : '' ?>><?php echo $fos_parent['fos_name'] ?></option>
                              <?php }?>
                          </select>
                      </div>
                  </div>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
