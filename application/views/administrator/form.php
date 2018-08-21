
<div class="m-sm alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    A wonderful serenity has taken possession. <a class="alert-link" href="#">Alert Link</a>.
</div>



<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" name="save" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?php echo ucfirst($action) ?> Administrator</h5>
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
              <form id="main-form" method="POST" class="form-horizontal" action="?">
                  <div class="form-group">
                      <label class="col-sm-12">First Name, Middle Name, Last Name, Name Extension</label>
                      <div class="col-sm-3"><input type="text" name="first-name" class="form-control" placeholder="First Name"></div>
                      <div class="col-sm-3"><input type="text" name="middle-name" class="form-control" placeholder="Middle Name"></div>
                      <div class="col-sm-3"><input type="text" name="last-name" class="form-control" placeholder="Last Name"></div>
                      <div class="col-sm-3"><input type="text" name="name-ext" class="form-control" placeholder="Name Extension"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-12">Gender</label>
                    <div class="col-sm-12">
                      <label class="checkbox-inline i-checks"> <input type="radio" value="male" name="gender" checked> <i></i> Male </label>
                      <label class="checkbox-inline i-checks"> <input type="radio" value="female" name="gender"> <i></i> Female</label>
                    </div>
                  </div>
                  <div class="hr-line-dashed"></div>
                  <div class="form-group">
                      <label class="col-sm-12">Email</label>
                      <div class="col-lg-12">
                        <input type="email" name="user-email" placeholder="Email" class="form-control">
                        <span class="help-block m-b-none hidden">Example block-level help text here.</span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-lg-12">User ID</label>
                      <div class="col-lg-12">
                        <input type="text" name="user-id" placeholder="User ID" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Password</label>
                    <div class="col-lg-12">
                      <input type="password" name="user-password" placeholder="Password" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Retype Password</label>
                    <div class="col-lg-12">
                      <input type="password" name="user-repassword" placeholder="Retype Password" class="form-control">
                    </div>
                  </div>

                  <div class="hr-line-dashed"></div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
