
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
                      <input type="hidden" name="add-again" value="0">
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>Employer Name</label>
                          <input type="text" name="employer-name" placeholder="Enter Employer Name" class="form-control">
                        </div>
                        <div class="form-group col-sm-12">
                          <div class="col-sm-4">
                            <h5>Main Contact Number</h5>
                            <input name="phone-number-1" type="text" class="form-control" placeholder="Enter Main Contact Number">
                          </div>
                          <div class="col-sm-4">
                            <h5>Mobile Number</h5>
                            <input name="phone-number-2" type="text" class="form-control" placeholder="Enter Mobile Number">
                          </div>
                          <div class="col-sm-4">
                            <h5>Home Number</h5>
                            <input name="phone-number-3" type="text" class="form-control" placeholder="Enter Home Number">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <label>Email</label>
                          <input type="email" name="reg-email" placeholder="Enter Email" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label>Employer Address</label>
                          <input type="text" name="employer-address" placeholder="Enter Employer Address" class="form-control">
                        </div>
                        <div class="col-md-12">
                          <label>Employer About</label>
                          <textarea name="employer-about" class="form-control"></textarea>
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
                  <div class="col-sm-4 col-sm-offset-2">
                      <button class="btn btn-primary form-submit col-sm-12" data-form="main-form">
                        <h3 class="font-bold"><i class="fa fa-user-o"></i> Register</h3>
                      </button>
                  </div>
                  <div class="col-sm-4 ">
                      <button class="btn btn-primary form-submit-add-new col-sm-12" data-form="main-form">
                        <h3 class="font-bold"><i class="fa fa-user-plus"></i> Register & Add New</h3>
                      </button>
                  </div>
              </div>
            </div>

        </div>



</div>

<script>

$(document).ready(function(){

  $('.form-submit-add-new').click(function(){
    $('[name=add-again]').val('1');
    $("#"+$(this).data('form')).submit();
  });

  $("#main-form").validate({
    rules :{
      'employer-name':{
        required : true
      },
      'reg-email': {
        required : true,
        email : true
      },
      'reg-username':{
        required : true,
        username : true,
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
