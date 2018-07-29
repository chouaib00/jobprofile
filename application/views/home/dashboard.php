          <div class="row wrapper border-bottom white-bg page-heading">
              <div class="col-lg-10">
                  <h2>Wizard</h2>
                  <ol class="breadcrumb">
                      <li>
                          <a href="index.html">Home</a>
                      </li>
                      <li>
                          <a>Forms</a>
                      </li>
                      <li class="active">
                          <strong>Wizard</strong>
                      </li>
                  </ol>
              </div>
              <div class="col-lg-2">

              </div>
          </div>
          <div class="wrapper wrapper-content animated fadeInRight">


          </div>
          <div class="footer">
              <div class="pull-right">
                  10GB of <strong>250GB</strong> Free.
              </div>
              <div>
                  <strong>Copyright</strong> Example Company &copy; 2014-2017
              </div>
          </div>







    <!-- Custom and plugin javascript -->
    <script src="<?php echo THEME ?>js/inspinia.js"></script>
    <script src="<?php echo THEME ?>js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="<?php echo THEME ?>js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?php echo THEME ?>js/plugins/validate/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function(){
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>
