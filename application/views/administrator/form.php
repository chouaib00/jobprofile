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
              <form id="main-form" method="POST" data-action="<?php echo $action ?>" class="form-horizontal" action="?">
                  <div class="form-group">
                      <label class="col-sm-12">First Name, Middle Name, Last Name, Name Extension</label>
                      <div class="col-sm-3"><input name="admin-first-name" type="text" class="form-control" placeholder="First Name" value="<?php echo $form_data['admin_first_name'] ?>"></div>
                      <div class="col-sm-3"><input name="admin-middle-name" type="text" class="form-control" placeholder="Middle Name" value="<?php echo $form_data['admin_middle_name'] ?>"></div>
                      <div class="col-sm-3"><input name="admin-last-name" type="text" class="form-control" placeholder="Last Name" value="<?php echo $form_data['admin_last_name'] ?>"></div>
                      <div class="col-sm-3"><input name="admin-name-ext" type="text" class="form-control" placeholder="Name Extension" value="<?php echo $form_data['admin_name_ext'] ?>"></div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-12">Gender</label>
                    <div class="col-sm-12">
                      <label class="checkbox-inline i-checks"> <input type="radio" value="male" name="gender" <?php echo $form_data['admin_gender'] == 'male'? 'checked': '' ?>> <i></i> Male </label>
                      <label class="checkbox-inline i-checks"> <input type="radio" value="female" name="gender" <?php echo $form_data['admin_gender'] == 'female'? 'checked': '' ?>> <i></i> Female</label>
                    </div>
                  </div>
                  <div class="hr-line-dashed"></div>
                  <div class="form-group">
                      <label class="col-sm-12">Email</label>
                      <div class="col-lg-12">
                        <input type="email" name="user-email" placeholder="Email" class="form-control" value="<?php echo $form_data['admin_email'] ?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-lg-12">Username</label>
                      <div class="col-lg-12">
                        <input type="text" name="user-name" placeholder="User name" class="form-control" value="<?php echo $form_data['user_name'] ?>">
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Password</label>
                    <div class="col-lg-12">
                      <input type="password" name="user-password" placeholder="Password" class="form-control" >
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


<script>

$(document).ready(function(){

  if($("#main-form").data('action') == 'add'){
    $("#main-form").validate({
      rules :{
        'admin-first-name': {
          required : true
        },
        'user-email': {
          required : true,
          email : true
        },
        'user-name':{
          required : true,
          minlength: 6
        },
        'user-password':{
          required : true,
          minlength: 6
        },
        'user-re-password':{
          required : true,
          equalTo : "[name=user-password]"
        }

      }

    });
  }
  else{
    $("#main-form").validate({
      rules :{
        'first-name': {
          required : true
        },
        'user-email': {
          required : true,
          email : true
        },
        'user-name':{
          required : true,
          minlength: 6
        }

      }

    });
  }


});
</script>
