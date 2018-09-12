<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Attach File</h5>
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
              <form id="main-form" action="" enctype="multipart/form-data" method="POST" class="form-horizontal">
                  <h5>File Tag</h5>
                  <div class="form-group">
                      <div class="col-sm-3">
                        <input type="text" name="file-tag" class="form-control" placeholder="Enter File Tag Name" >
                      </div>
                      <div class="col-sm-3">
                        <input type="file" id="file" name="file" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                      </div>
                      <div class="col-sm-3">
                        <label class="checkbox-inline i-checks"> <input type="checkbox" value="1" name="file-visible" value="1"> <i></i> Make file visible to employer </label>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
