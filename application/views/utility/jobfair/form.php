<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?php echo ucfirst($action) ?> Job Fair</h5>
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
                  <div class="form-group">
                    <div class="col-sm-9">
                      <h5>Job Fair Title</h5>
                      <input type="text" name="job-fair-title" class="form-control" placeholder="Job Fair Title" value="<?php echo $form_data['js_title']?>">
                    </div>
                    <div class="col-sm-3">
                      <h5>&nbsp;</h5>
                      <label class="checkbox-inline i-checks"> <input type="checkbox" value="active" name="job-fair-active" <?php echo ($form_data['js_is_current'])? 'checked' : '' ?>> <i></i> Active </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6">
                      <h5>Start Date</h5>
                      <input type="text" name="job-fair-start-date" class="datepicker form-control" autocomplete="off" placeholder="mm/dd/yyyy" value="<?php echo ($form_data['js_date_from'])? date('m/d/Y', strtotime($form_data['js_date_from'])) : '' ?>"/>
                    </div>
                    <div class="col-md-6">
                      <h5>End Date</h5>
                      <input type="text" name="job-fair-end-date" class="datepicker form-control" autocomplete="off" placeholder="mm/dd/yyyy" value="<?php echo ($form_data['js_date_to'])? date('m/d/Y', strtotime($form_data['js_date_to'])) : ''  ?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <h5>Status</h5>
                      <input type="text" name="job-fair-status" class="form-control" maxlength="15" placeholder="Job Fair Status" value="<?php echo $form_data['jf_is_status']?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <h5>Summary</h5>
                      <textarea name="job-fair-summary" class="text-editor"><?php echo $form_data['js_summary']?></textarea>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="col-sm-12">
                      <label class="checkbox-inline i-checks"> <input type="checkbox" value="active" name="job-fair-announcement"> <i></i> Click Here to send email notification on all registered </label>
                    </div>
                  </div> -->

                </form>

            </div>
        </div>
    </div>
  </div>


</div>

<script src="<?php echo JS_DIR ?>components/utility/add_jobfair.js"></script>
