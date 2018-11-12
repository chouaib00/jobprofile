<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="wrapper wrapper-content">
    <div class="container white-bg">
        <div class="row">
            <div class="col-lg-12">
                <h2>Register</h2>
                <hr class="hr-line-solid">
                <form id="main-form" action="" method="POST">
                    <div class="form-group col-md-12">
                        <label>Email</label>
                        <input type="email" name="reg-email" placeholder="Enter Email" class="form-control">
                        <small>Ex. applicant@gmail.com, applicant@outlook.com, applicant@yahoo.com </small>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Username</label>
                        <input type="username" name="reg-username" placeholder="Enter Username" class="form-control">
                        <small>Alphanumeric 6-30 characters , no space. Ex. jdelacruz, juandelacruz </small>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Password</label>
                        <input type="password" name="reg-password" placeholder="Enter Password" class="form-control">
                        <small>Alphanumeric 6-30 characters </small>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Retype Password</label>
                        <input type="password" name="reg-re-password" placeholder="Reenter Password" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                      <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LcAc3EUAAAAAFH489r8o8RhDeQ_xRCfR8IHeD0F"></div>
                    </div>
                </form>

            </div>
            <div class="col-lg-12">
              <div class="form-group">
                  <div class="col-sm-4 col-sm-offset-4">
                      <button disabled class="btn btn-primary form-submit col-sm-12 btn-outline" data-form="main-form">
                        <h3 class="font-bold"><i class="fa fa-user-o"></i> Submit</h3>
                      </button>
                  </div>
              </div>
            </div>

        </div>

    </div>

</div>

<script>
function recaptchaCallback() {
    $('.form-submit').removeAttr('disabled');
};
$(document).ready(function(){



  $("#main-form").validate({
    rules :{
      'reg-email': {
        required : true,
        email : true
      },
      'reg-username':{
        required : true,
        username : true,
        minlength: 6,
        maxlength: 30
      },
      'reg-password':{
        required : true,
        username : true,
        minlength: 6,
        maxlength: 30
      },
      'reg-re-password':{
        required : true,
        equalTo : "[name=reg-password]"
      }

    }

  });
});
</script>
