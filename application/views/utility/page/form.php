
<div class="wrapper wrapper-content animated fadeInLeft">
        <div class="row">
          <div class="col-lg-12 text-right">
            <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
          </div>
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $form_data['page_name'] ?></h5>
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
                          <textarea name="page-content" class="form-control text-editor"><?php echo $form_data['page_context']?></textarea>
                        </div>

                      </div>

                  </form>
                </div>
              </div>


            </div>

        </div>



</div>
