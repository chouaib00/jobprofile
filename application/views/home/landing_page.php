<div class="wrapper wrapper-content">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <?php foreach($announcement_list as $announcement){ ?>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $announcement['announcement_title'] ?> <small>~</small> </h5>

                        <div class="ibox-tools">
                            <label class="label label-primary"><?php echo date('F j, Y - h:i:s A', strtotime($announcement['announcement_date'])) ?></label>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                      <div class="row">
                          <div class="col-md-12">
                            <?php echo $announcement['announcement_content'] ?>
                          </div>
                      </div>
                    </div>
                </div>
                <?php }?>

            </div>

        </div>

    </div>

</div>
