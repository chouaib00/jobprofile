
<div class="wrapper wrapper-content animated fadeInLeft">
        <div class="row">
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Employer</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                  <form id="main-form" class="form-horizontal" action="" method="POST">
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>Email</label>
                          <input type="email" name="reg-email" placeholder="Enter Email" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label>Username</label>
                          <input type="username" name="reg-username" placeholder="Enter Username" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label>Password</label>
                          <input type="password" name="reg-password" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label>Retype Password</label>
                          <input type="password" name="reg-re-password" placeholder="Reenter Password" class="form-control">
                        </div>
                      </div>

                  </form>
                </div>
              </div>


            </div>
            <div class="col-lg-12">
              <div class="form-group">
                  <div class="col-sm-4 col-sm-offset-4">
                      <button class="btn btn-primary form-submit col-sm-12" data-form="main-form">
                        <h3 class="font-bold"><i class="fa fa-user-o"></i> Register</h3>
                      </button>
                  </div>
              </div>
            </div>

        </div>



</div>

<script>

$(document).ready(function(){



  $("#main-form").validate({
    rules :{
      'reg-email': {
        required : true,
        email : true
      },
      'reg-username':{
        required : true,
        minlength: 6
      },
      'reg-password':{
        required : true,
        minlength: 6
      },
      'reg-re-password':{
        required : true,
        equalTo : "[name=reg-password]"
      }

    }

  });
});
</script>
