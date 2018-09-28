<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">

    <div class="col-lg-10">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form method="POST" action="?" id="main-form" enctype="multipart/form-data">
        <div class="ibox">
            <div class="ibox-title">
              <h5>About <?php echo $form_data['employer_name'] ?></h5>
              <div class="ibox-tools">
                  <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="fullscreen-link">
                      <i class="fa fa-expand"></i>
                  </a>
              </div>
            </div>
            <div class="ibox-content form-horizontal">
              <div class="form-group">
                  <div class="col-sm-12">
                    <textarea name="employer-summary" class="form-control"><?php echo $form_data['employer_about'] ?></textarea>

                  </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button id="update-profile" data-form="main-form" class="btn btn-primary col-sm-12 btn-outline form-submit" type="button">
                  <h3 class="font-bold"><i class="fa fa-building"></i> Update Company Profile</h3>
                </button>
              </div>
          </div>
        </form>
    </div>
  </div>
</div>
