<link href="<?php echo THEME ?>css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo THEME ?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">



<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12 text-right">
      <button class="btn btn-primary has-tooltip form-submit" title="Save" data-form="main-form"><i class="fa fa-file"></i></button>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?php echo ucfirst($action) ?> Announcement</h5>
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
                  <h5>Announcement Title</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" name="announcement-title" class="form-control" placeholder="Announcement Title" value="<?php echo $form_data['announcement_title']?>"></div>
                  </div>
                  <h5>Content</h5>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea name="announcement-content" class="text-editor">
                        <?php echo $form_data['announcement_content']?>
                      </textarea>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>


</div>
<script src="<?php echo THEME; ?>js/plugins/summernote/summernote.min.js"></script>

<script src="<?php echo JS_DIR ?>components/utility/add_announcement.js"></script>
